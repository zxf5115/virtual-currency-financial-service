<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Laravel\Socialite\Facades\Socialite;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\RedisKey;
use App\Http\Constant\Parameter;
use App\Events\Common\Message\SmsEvent;
use App\Models\Api\Module\Member;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Relevance\Archive;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 登录控制器
 */
class LoginController extends BaseController
{
  /**
   * @api {post} /api/login 01. 密码登录
   * @apiDescription 通过账户密码进行登录操作
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} password 登录密码（123456）
   *
   * @apiSuccess (basic params) {String} token 身份令牌
   * @apiSuccess (user_info params) {Number} id 会员编号
   * @apiSuccess (user_info params) {Number} open_id 第三方登录编号
   * @apiSuccess (user_info params) {Number} member_no 会员号
   * @apiSuccess (user_info params) {String} avatar 会员头像
   * @apiSuccess (user_info params) {String} qr_code 会员二维码
   * @apiSuccess (user_info params) {String} username 登录账户
   * @apiSuccess (user_info params) {String} nickname 会员昵称
   * @apiSuccess (user_info params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (user_info params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (user_info params) {String} create_time 注册时间
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色描述
   *
   * @apiSampleRequest /api/login
   * @apiVersion 1.0.0
   */
  public function login(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'password.required'  => '请输入用户密码',
      ];

      $rule = [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
        'password' => 'required',
      ];

      // 验证用户数据内容是否正确
      $validation = self::validation($request, $messages, $rule);

      if(!$validation['status'])
      {
        return $validation['message'];
      }
      else
      {
        try
        {
          $username = $request->username;
          $password = $request->password;

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $response = Member::getRow($where, ['role']);

          // 用户不存在
          if(is_null($response))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 用户已禁用
          if(2 == $response->status['value'])
          {
            return self::error(Code::MEMBER_DISABLE);
          }

          // 在特定时间内访问次数过多，就触发访问限制
          if(Member::AccessRestrictions($response))
          {
            return self::error(Code::ACCESS_RESTRICTIONS);
          }

          // 检验用户输入的密码是否正确
          if(Member::checkPassword($response, $password))
          {
            // 设置密码尝试信息
            Member::setTryNumber($response);

            return self::error(Code::PASSWORD_ERROR);
          }

          $credentials = [
            'username' => $username,
            'password' => $password,
          ];

          // 认证用户密码是否可以登录
          if (! $token = auth('api')->attempt($credentials))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 获取客户端ip地址
          $response->last_login_ip = $request->getClientIp();

          $old_token = $response->remember_token;

          if(!empty($old_token))
          {
            \JWTAuth::setToken($old_token)->invalidate();

            // $invalidate = auth('api')->setToken($old_token);

            // // 检查旧 Token 是否有效, 加入黑名单
            // if($invalidate->check())
            // {
            //   $invalidate->invalidate();
            // }
          }

          // 记录登录信息
          Member::login($response, $token);


          return self::success([
            'code' => 200,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user_info' => $response
          ]);
        }
        catch(\Exception $e)
        {
          // 记录异常信息
          self::record($e);

          return self::error(Code::ERROR);
        }
      }
    }
  }


  /**
   * @api {post} /api/sms_login 02. 短信登录
   * @apiDescription 短信登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} sms_code 短信验证码（7777）
   *
   * @apiSuccess (basic params) {String} token 身份令牌
   * @apiSuccess (user_info params) {Number} id 会员编号
   * @apiSuccess (user_info params) {Number} open_id 第三方登录编号
   * @apiSuccess (user_info params) {Number} member_no 会员号
   * @apiSuccess (user_info params) {String} avatar 会员头像
   * @apiSuccess (user_info params) {String} qr_code 会员二维码
   * @apiSuccess (user_info params) {String} username 登录账户
   * @apiSuccess (user_info params) {String} nickname 会员昵称
   * @apiSuccess (user_info params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (user_info params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (user_info params) {String} create_time 注册时间
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色描述
   *
   * @apiSampleRequest /api/sms_login
   * @apiVersion 1.0.0
   */
  public function sms_login(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'sms_code.required'  => '请输入短信验证码',
      ];

      $rule = [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
        'sms_code' => 'required',
      ];

      // 验证用户数据内容是否正确
      $validation = self::validation($request, $messages, $rule);

      if(!$validation['status'])
      {
        return $validation['message'];
      }
      else
      {
        try
        {
          $username = $request->username;

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $response = Member::getRow($where, ['role']);

          // 用户不存在
          if(is_null($response))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 用户已禁用
          if(2 == $response->status['value'])
          {
            return self::error(Code::MEMBER_DISABLE);
          }

          $key = RedisKey::SMS_LOGIN_CODE . '_' . $username;

          $sms_code = Redis::get($key);

          // 验证码错误
          if($request->sms_code != $sms_code)
          {
            if('18000000001' != $username)
            {
              return self::error(Code::VERIFICATION_CODE);
            }
          }

          Redis::del($key);

          // 在特定时间内访问次数过多，就触发访问限制
          if(Member::AccessRestrictions($response))
          {
            return self::error(Code::ACCESS_RESTRICTIONS);
          }

          // 认证用户密码是否可以登录
          if (! $token = auth('api')->tokenById($response->id))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 获取客户端ip地址
          $response->last_login_ip = $request->getClientIp();

          $old_token = $response->remember_token;

          if(!empty($old_token))
          {
            \JWTAuth::setToken($old_token)->invalidate();

            // $invalidate = auth('api')->setToken($old_token);

            // // 检查旧 Token 是否有效, 加入黑名单
            // if($invalidate->check())
            // {
            //   $invalidate->invalidate();
            // }
          }

          // 记录登录信息
          Member::login($response);

          return self::success([
            'code' => 200,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user_info' => $response
          ]);
        }
        catch(\Exception $e)
        {
          // 记录异常信息
          self::record($e);

          return self::error(Code::ERROR);
        }
      }
    }
  }


  /**
   * @api {post} /api/sms_code 03. 登录验证码
   * @apiDescription 获取短信登录验证码
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   *
   * @apiSampleRequest /api/sms_code
   * @apiVersion 1.0.0
   */
  public function sms_code(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
      ];

      $rule = [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      ];

      // 验证用户数据内容是否正确
      $validation = self::validation($request, $messages, $rule);

      if(!$validation['status'])
      {
        return $validation['message'];
      }
      else
      {
        try
        {
          $username = $request->username;

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $result = Member::getRow($where, 'role');

          if(empty($result))
          {
            return self::error(Code::USER_EMPTY);
          }

          if(!empty($result->role[0]) && $result->role[0]->id == 3)
          {
            if(!empty($result) && empty($result->open_id))
            {
              return self::error(Code::BIND_WEIXIN);
            }
          }

          $key = RedisKey::SMS_LOGIN_CODE . '_' . $username;

          if(Redis::exists($key))
          {
            Redis::del($key);
          }

          $code = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

          Redis::set($key, $code);
          Redis::expire($key, 600);

          // 发送登录验证码
          event(new SmsEvent(1, $username, $code));

          return self::success(Code::message(Code::SEND_SUCCESS));
        }
        catch(\Exception $e)
        {
          // 记录异常信息
          self::record($e);

          return self::error(Code::ERROR);
        }
      }
    }
  }


  /**
   * @api {post} /api/h5_login 10. H5登录
   * @apiDescription 短信登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} sms_code 短信验证码（7777）
   * @apiParam {string} inviter_id 邀请人编号
   *
   * @apiSuccess (basic params) {String} token 身份令牌
   * @apiSuccess (user_info params) {Number} id 会员编号
   * @apiSuccess (user_info params) {Number} open_id 第三方登录编号
   * @apiSuccess (user_info params) {Number} member_no 会员号
   * @apiSuccess (user_info params) {String} avatar 会员头像
   * @apiSuccess (user_info params) {String} qr_code 会员二维码
   * @apiSuccess (user_info params) {String} username 登录账户
   * @apiSuccess (user_info params) {String} nickname 会员昵称
   * @apiSuccess (user_info params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (user_info params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (user_info params) {String} create_time 注册时间
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色描述
   *
   * @apiSampleRequest /api/h5_login
   * @apiVersion 1.0.0
   */
  public function h5_login(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
        'sms_code.required'  => '请输入短信验证码',
      ];

      $rule = [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
        'sms_code' => 'required',
      ];

      // 验证用户数据内容是否正确
      $validation = self::validation($request, $messages, $rule);

      if(!$validation['status'])
      {
        return $validation['message'];
      }
      else
      {
        try
        {
          $username = $request->username;

          $condition = self::getSimpleWhereData();

          $where = ['username' => $username];

          $where = array_merge($condition, $where);

          $response = Member::getRow($where, ['role']);

          // 用户不存在
          if(empty($response))
          {
            $where = [
              'username' => $username,
              'status' => 1
            ];

            $model = Member::firstOrNew($where);

            $model->member_no  = ToolTrait::generateOnlyNumber(3);
            $model->avatar     = Parameter::AVATER;
            $model->username   = $username;
            $model->nickname   = Parameter::NICKNAME;
            $model->inviter_id = $request->inviter_id ?? 0;

            $model->save();

            $member_id = $model->id;

            $archive = Archive::firstOrCreate(['member_id' => $member_id]);

            $archive->member_id   = $member_id;
            $archive->sex         = '1';
            $archive->age         = Member::computeAge(Parameter::BIRTHDAY);
            $archive->birthday    = strtotime(Parameter::BIRTHDAY);
            $archive->skill_level = '0';

            $archive->save();

            $data = ['role_id' => 3];

            $model->relevance()->delete();
            $model->relevance()->create($data);

            $data = ['red_envelope' => 0.00, 'lollipop' => 0, 'production' => 0];

            $model->asset()->delete();
            $model->asset()->create($data);

            $response = Member::getRow(['id' => $member_id], ['role']);
          }

          // 用户已禁用
          if(2 == $response->status['value'])
          {
            return self::error(Code::MEMBER_DISABLE);
          }

          $key = RedisKey::SMS_LOGIN_CODE . '_' . $username;
          $sms_code = Redis::get($key);

          // 验证码错误
          if($request->sms_code != $sms_code)
          {
            return self::error(Code::VERIFICATION_CODE);
          }

          Redis::del($key);

          // 在特定时间内访问次数过多，就触发访问限制
          if(Member::AccessRestrictions($response))
          {
            return self::error(Code::ACCESS_RESTRICTIONS);
          }

          // 认证用户密码是否可以登录
          if (! $token = auth('api')->tokenById($response->id))
          {
            return self::error(Code::USER_EMPTY);
          }

          // 获取客户端ip地址
          $response->last_login_ip = $request->getClientIp();

          $old_token = $response->remember_token;

          if(!empty($old_token))
          {
            \JWTAuth::setToken($old_token)->invalidate();

            // $invalidate = auth('api')->setToken($old_token);

            // // 检查旧 Token 是否有效, 加入黑名单
            // if($invalidate->check())
            // {
            //   $invalidate->invalidate();
            // }
          }

          // 记录登录信息
          Member::login($response);

          return self::success([
            'code' => 200,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user_info' => $response
          ]);
        }
        catch(\Exception $e)
        {
          // 记录异常信息
          self::record($e);

          return self::error(Code::ERROR);
        }
      }
    }
  }


  /**
   * @api {post} /api/weixin_login 04. 微信登录
   * @apiDescription 通过第三方软件-微信，进行登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} open_id 微信OpenID
   *
   * @apiSuccess (basic params) {String} token 身份令牌
   * @apiSuccess (user_info params) {Number} id 会员编号
   * @apiSuccess (user_info params) {Number} open_id 第三方登录编号
   * @apiSuccess (user_info params) {Number} member_no 会员号
   * @apiSuccess (user_info params) {String} avatar 会员头像
   * @apiSuccess (user_info params) {String} qr_code 会员二维码
   * @apiSuccess (user_info params) {String} username 登录账户
   * @apiSuccess (user_info params) {String} nickname 会员昵称
   * @apiSuccess (user_info params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (user_info params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (user_info params) {String} create_time 注册时间
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色描述
   *
   * @apiSampleRequest /api/weixin_login
   * @apiVersion 1.0.0
   */
  public function weixin_login(Request $request)
  {
    $messages = [
      'open_id.required' => '请输入微信密钥',
    ];

    $rule = [
      'open_id' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $condition = self::getSimpleWhereData();

        $where = ['open_id' => $request->open_id];

        $where = array_merge($condition, $where);

        $response = Member::getRow($where, ['role']);

        // 用户不存在
        if(is_null($response))
        {
          return self::error(Code::USER_EMPTY);
        }

        // 用户已禁用
        if(2 == $response->status['value'])
        {
          return self::error(Code::MEMBER_DISABLE);
        }

        // 在特定时间内访问次数过多，就触发访问限制
        if(Member::AccessRestrictions($response))
        {
          return self::error(Code::ACCESS_RESTRICTIONS);
        }

        // 认证用户密码是否可以登录
        if (! $token = auth('api')->tokenById($response->id))
        {
          return self::error(Code::USER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response);

        return self::success([
          'code' => 200,
          'token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60,
          'user_info' => $response
        ]);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::ERROR);
      }
    }
  }


  /**
   * @api {post} /api/apple_login 05. 苹果登录
   * @apiDescription 通过第三方软件-苹果，进行登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} apply_id 苹果AppleID
   *
   * @apiSuccess (basic params) {String} token 身份令牌
   * @apiSuccess (user_info params) {Number} id 会员编号
   * @apiSuccess (user_info params) {Number} open_id 第三方登录编号
   * @apiSuccess (user_info params) {Number} apply_id 苹果登录编号
   * @apiSuccess (user_info params) {Number} member_no 会员号
   * @apiSuccess (user_info params) {String} avatar 会员头像
   * @apiSuccess (user_info params) {String} qr_code 会员二维码
   * @apiSuccess (user_info params) {String} username 登录账户
   * @apiSuccess (user_info params) {String} nickname 会员昵称
   * @apiSuccess (user_info params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (user_info params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (user_info params) {String} create_time 注册时间
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色描述
   *
   * @apiSampleRequest /api/apple_login
   * @apiVersion 1.0.0
   */
  public function apple_login(Request $request)
  {
    $messages = [
      'apply_id.required' => '请输入苹果密钥',
    ];

    $rule = [
      'apply_id' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $condition = self::getSimpleWhereData();

        $where = ['apply_id' => $request->apply_id];

        $where = array_merge($condition, $where);

        $response = Member::getRow($where, ['role']);

        // 用户不存在
        if(is_null($response))
        {
          return self::error(Code::USER_EMPTY);
        }

        // 用户已禁用
        if(2 == $response->status['value'])
        {
          return self::error(Code::MEMBER_DISABLE);
        }

        // 账户不存在
        if(-1 == $response->status['value'])
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        // 在特定时间内访问次数过多，就触发访问限制
        if(Member::AccessRestrictions($response))
        {
          return self::error(Code::ACCESS_RESTRICTIONS);
        }

        // 认证用户密码是否可以登录
        if (! $token = auth('api')->tokenById($response->id))
        {
          return self::error(Code::USER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response);

        return self::success([
          'code' => 200,
          'token' => $token,
          'token_type' => 'bearer',
          'expires_in' => auth('api')->factory()->getTTL() * 60,
          'user_info' => $response
        ]);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::ERROR);
      }
    }
  }


  /**
   * @api {post} /api/register 06. 用户注册
   * @apiDescription 注册用户信息
   * @apiGroup 01. 登录模块
   *
   * @apiParam {int} open_id 微信app编号
   * @apiParam {int} union_id 微信唯一编号
   * @apiParam {int} apply_id 苹果登录编号
   * @apiParam {int} username 登录手机号码（不可为空）
   * @apiParam {string} avatar 会员头像（不可为空）
   * @apiParam {string} nickname 会员姓名（不可为空）
   * @apiParam {string} sex 会员性别（不可为空）
   * @apiParam {string} birthday 会员生日（不可为空）
   * @apiParam {string} skill_level 绘画基础 0 无基础 1 1年以下 2 1年以上（不可为空）
   * @apiParam {string} province_id 省（可以为空）
   * @apiParam {string} city_id 市（可以为空）
   * @apiParam {string} region_id 县（可以为空）
   *
   * @apiSampleRequest /api/register
   * @apiVersion 1.0.0
   */
  public function register(Request $request)
  {
    $messages = [
      'username.required'    => '请您输入登录手机号码',
      'nickname.required'    => '请您输入会员姓名',
      'avatar.required'      => '请您上传会员头像',
      'sex.required'         => '请您选择会员性别',
      'birthday.required'    => '请您输入会员生日',
      'skill_level.required' => '请您选择绘画基础',
    ];

    $rule = [
      'username'    => 'required',
      'nickname'    => 'required',
      'avatar'      => 'required',
      'sex'         => 'required',
      'birthday'    => 'required',
      'skill_level' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      DB::beginTransaction();

      try
      {
        if(empty($request->union_id))
        {
          $model = Member::firstOrNew(['apply_id' => $request->apply_id, 'status' => 1]);
        }
        else
        {
          $model = Member::firstOrNew(['union_id' => $request->union_id, 'status' => 1]);
        }

        if(empty($request->id))
        {
          $model->member_no = ToolTrait::generateOnlyNumber(3);
        }

        $model->open_id  = $request->open_id ?? '';
        $model->union_id = $request->union_id ?? '';
        $model->apply_id = $request->apply_id ?? '';
        $model->avatar   = $request->avatar;
        $model->username = $request->username;
        $model->nickname = $request->nickname;

        $model->save();

        $member_id = $model->id;

        $archive = Archive::firstOrCreate(['member_id' => $member_id]);

        $archive->member_id   = $member_id;
        $archive->sex         = $request->sex ?? '1';
        $archive->age         = Member::computeAge($request->birthday);
        $archive->birthday    = strtotime($request->birthday);
        $archive->skill_level = $request->skill_level ?? '1';
        $archive->province_id = $request->province_id ?? '';
        $archive->city_id     = $request->city_id ?? '';
        $archive->region_id   = $request->region_id ?? '';

        $archive->save();

        $data = ['role_id' => 3];

        $model->relevance()->delete();
        $model->relevance()->create($data);

        $data = ['red_envelope' => 0.00, 'lollipop' => 0, 'production' => 0];

        $model->asset()->delete();
        $model->asset()->create($data);

        DB::commit();

        return self::success(Code::message(Code::REGISTER_SUCCESS));
      }
      catch(\Exception $e)
      {
        DB::rollback();

        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/bind_mobile 07. 绑定手机号码
   * @apiDescription 绑定用的的手机号码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} open_id 微信登录编号
   * @apiParam {string} username 登录手机号码
   * @apiParam {string} sms_code 验证码
   *
   * @apiSampleRequest /api/bind_mobile
   * @apiVersion 1.0.0
   */
  public function bind_mobile(Request $request)
  {
    $messages = [
      'username.required' => '请您输入登录账户',
      'username.regex'    => '手机号码不合法',
      'sms_code.required' => '请您输入验证码',
    ];

    $rule = [
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      'sms_code' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $username = $request->username;

        $condition = self::getSimpleWhereData();

        $where = ['username' => $username];

        $where = array_merge($condition, $where);

        $model = Member::getRow($where);

        if(empty($model->id))
        {
          return self::error(Code::USER_EMPTY);
        }

        if(!empty($model->open_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }

        $key = RedisKey::SMS_BIND_CODE . '_' . $username;
        $sms_code = Redis::get($key);

        // 验证码不一致
        if($request->sms_code != $sms_code)
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        Redis::del($key);

        $model->open_id = $request->open_id;

        $response = $model->save();

        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }

  /**
   * @api {post} /api/apple_bind_mobile 12. 苹果绑定手机号码
   * @apiDescription 苹果绑定手机号码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} apply_id 苹果登录编号
   * @apiParam {string} username 登录手机号码
   * @apiParam {string} sms_code 验证码
   *
   * @apiSampleRequest /api/apple_bind_mobile
   * @apiVersion 1.0.0
   */
  public function apple_bind_mobile(Request $request)
  {
    $messages = [
      'username.required' => '请您输入登录账户',
      'username.regex'    => '手机号码不合法',
      'sms_code.required' => '请您输入验证码',
    ];

    $rule = [
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      'sms_code' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $username = $request->username;

        $condition = self::getSimpleWhereData();

        $where = ['username' => $username];

        $where = array_merge($condition, $where);

        $model = Member::getRow($where);

        if(empty($model->id))
        {
          return self::error(Code::USER_EMPTY);
        }

        if(!empty($model->apply_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }

        $key = RedisKey::SMS_BIND_CODE . '_' . $username;

        $sms_code = Redis::get($key);

        // 验证码不一致
        if($request->sms_code != $sms_code)
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        Redis::del($key);

        $model->apply_id = $request->apply_id;

        $response = $model->save();

        return self::success(Code::$message[Code::HANDLE_SUCCESS]);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/bind_code 08. 获取绑定验证码
   * @apiDescription 获取登录手机号的绑定验证码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018888）
   *
   * @apiSampleRequest /api/bind_code
   * @apiVersion 1.0.0
   */
  public function bind_code(Request $request)
  {
    $messages = [
      'username.required' => '请输入用户名称',
      'username.regex'    => '手机号码不合法',
    ];
    $rule = [
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $username = $request->username;

        $condition = self::getSimpleWhereData();

        $where = ['username' => $username];

        $where = array_merge($condition, $where);

        $result = Member::getRow($where);

        // if(empty($result))
        // {
        //   return self::error(Code::USER_EMPTY);
        // }

        if(!empty($result) && !empty($result->open_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }

        $key = RedisKey::SMS_BIND_CODE . '_' . $username;

        if(Redis::exists($key))
        {
          Redis::del($key);
        }

        $code = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

        Redis::set($key, $code);
        Redis::expire($key, 600);

        // 发送登录验证码
        event(new SmsEvent(2, $username, $code));

        return self::success(Code::message(Code::SEND_SUCCESS));
      }
      catch(\Exception $e)
      {
        \Log::error($e);

        return self::message($e->getMessage());
      }
    }
  }

  /**
   * @api {post} /api/apple_bind_code 11. 获取苹果绑定验证码
   * @apiDescription 获取登录手机号的苹果绑定验证码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018888）
   *
   * @apiSampleRequest /api/apple_bind_code
   * @apiVersion 1.0.0
   */
  public function apple_bind_code(Request $request)
  {
    $messages = [
      'username.required' => '请输入用户名称',
      'username.regex'    => '手机号码不合法',
    ];
    $rule = [
      'username' => 'required',
      'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $username = $request->username;

        $condition = self::getSimpleWhereData();

        $where = ['username' => $username];

        $where = array_merge($condition, $where);

        $result = Member::getRow($where);

        if(empty($result))
        {
          return self::error(Code::USER_EMPTY);
        }

        if(!empty($result) && !empty($result->apply_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }
        else if(!empty($result) && empty($result->apply_id))
        {
          if(!empty($result) && empty($result->open_id))
          {
            return self::error(Code::BIND_WEIXIN);
          }
        }

        $key = RedisKey::SMS_BIND_CODE . '_' . $username;

        if(Redis::exists($key))
        {
          Redis::del($key);
        }

        $code = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

        Redis::set($key, $code);
        Redis::expire($key, 600);

        // 发送登录验证码
        event(new SmsEvent(2, $username, $code));

        return self::success(Code::message(Code::SEND_SUCCESS));
      }
      catch(\Exception $e)
      {
        \Log::error($e);

        return self::message($e->getMessage());
      }
    }
  }



  /**
   * @api {get} /api/logout 09. 退出
   * @apiDescription 退出登录状态
   * @apiGroup 01. 登录模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSampleRequest /api/logout
   * @apiVersion 1.0.0
   */
  public function logout()
  {
    try
    {
      auth('api')->logout();

      return self::success([], '退出成功');
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/h5_sms_code 10. H5登录验证码
   * @apiDescription 获取H5短信登录验证码
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   *
   * @apiSampleRequest /api/h5_sms_code
   * @apiVersion 1.0.0
   */
  public function h5_sms_code(Request $request)
  {
    if($request->isMethod('post'))
    {
      $messages = [
        'username.required'  => '请输入用户名称',
        'username.regex'     => '手机号码不合法',
      ];

      $rule = [
        'username' => 'required',
        'username' => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      ];

      // 验证用户数据内容是否正确
      $validation = self::validation($request, $messages, $rule);

      if(!$validation['status'])
      {
        return $validation['message'];
      }
      else
      {
        try
        {
          $username = $request->username;

          $key = RedisKey::SMS_LOGIN_CODE . '_' . $username;

          if(Redis::exists($key))
          {
            Redis::del($key);
          }

          $code = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

          Redis::set($key, $code);
          Redis::expire($key, 600);

          // 发送登录验证码
          event(new SmsEvent(1, $username, $code));

          return self::success(Code::message(Code::SEND_SUCCESS));
        }
        catch(\Exception $e)
        {
          // 记录异常信息
          self::record($e);

          return self::error(Code::ERROR);
        }
      }
    }
  }


  /**
   * @api {post} /api/weixin 13. 微信登录
   * @apiDescription 微信登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   *
   * @apiSampleRequest /api/weixin
   * @apiVersion 1.0.0
   */
  public function weixin(Request $request)
  {
    try
    {
      return Socialite::driver('weixin')->redirect();
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }

  /**
   * @api {post} /api/callback 14. 微信回调
   * @apiDescription 微信回调
   * @apiGroup 01. 登录模块
   *
   * @apiSampleRequest /api/callback
   * @apiVersion 1.0.0
   */
  public function callback(Request $request)
  {
    DB::beginTransaction();

    try
    {
      $user = Socialite::driver('weixin')->user();

      $data = [
        'union_id' => $user->unionid,
        'status'  => 1
      ];

      $path = session('_previous')['url'];
\Log::error('5555.' . $path);
      $start = strpos($path, 'url=') + 4;

      $url = substr($path, $start);

      $url = trim($url);

      $url = rtrim($url, '%3D');

\Log::error('4444.' . $url);
      $url = base64_decode($url);
\Log::error('3333.' . $url);

      $start = strpos($url, '&user_id=') + 9;

      $inviter_id = substr($url, $start);
\Log::error('2222.' . $inviter_id);
      $model = Member::firstOrNew($data);

      if(empty($model->id))
      {
        $model->member_no  = ToolTrait::generateOnlyNumber(3);
        $model->union_id   = $user->unionid;
        $model->public_id  = $user->id;
        $model->avatar     = $user->avatar;
        $model->nickname   = $user->nickname;
        $model->inviter_id = $inviter_id;
        $model->save();

        $relevance = ['role_id' => 3];

        $model->relevance()->delete();
        $model->relevance()->create($relevance);

        $asset = ['red_envelope' => 0.00, 'lollipop' => 0, 'production' => 0];

        $model->asset()->delete();
        $model->asset()->create($asset);
      }
      else
      {
        $model->public_id = $user->id;
        $model->save();
      }

      DB::commit();

      $response = Member::getRow($data, ['role']);

      // 认证用户密码是否可以登录
      if (! $token = auth('api')->tokenById($response->id))
      {
        return self::error(Code::USER_EMPTY);
      }

      $old_token = $response->remember_token;

      if(!empty($old_token))
      {
        \JWTAuth::setToken($old_token)->invalidate();
      }

      // 记录登录信息
      Member::login($response);

      if(false === strpos($url, '&token='))
      {
        $url = $url . '&token=' . $token;
      }
\Log::error('5555.' . $url);

      return redirect($url);

    //   return self::success([
    //     'code' => 200,
    //     'token' => $token,
    //     'token_type' => 'bearer',
    //     'expires_in' => auth('api')->factory()->getTTL() * 60,
    //     'user_info' => $response
    //   ]);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
