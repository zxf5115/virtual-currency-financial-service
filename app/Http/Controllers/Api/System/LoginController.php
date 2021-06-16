<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\RedisKey;
use App\Http\Constant\Parameter;
use App\Models\Api\Module\Member;
use App\Events\Common\Sms\CodeEvent;
use App\Events\Common\Message\SmsEvent;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-09
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
   * @apiSuccess (字段说明|令牌) {String} token 身份令牌
   * @apiSuccess (字段说明|用户) {Number} id 会员编号
   * @apiSuccess (字段说明|用户) {Number} role_id 角色编号
   * @apiSuccess (字段说明|用户) {Number} open_id 微信编号
   * @apiSuccess (字段说明|用户) {Number} apply_id 苹果编号
   * @apiSuccess (字段说明|用户) {Number} inviter_id 邀请人编号
   * @apiSuccess (字段说明|用户) {Number} member_no 会员号
   * @apiSuccess (字段说明|用户) {String} avatar 会员头像
   * @apiSuccess (字段说明|用户) {String} username 登录账户
   * @apiSuccess (字段说明|用户) {String} nickname 会员昵称
   * @apiSuccess (字段说明|角色) {String} id 角色编号
   * @apiSuccess (字段说明|角色) {String} title 角色名称
   * @apiSuccess (字段说明|角色) {String} content 角色描述
   *
   * @apiSampleRequest /api/login
   * @apiVersion 1.0.0
   */
  public function login(Request $request)
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

        $condition = self::getSimpleWhereData($username, 'username');

        $response = Member::getRow($condition, ['role']);

        // 用户不存在
        if(is_null($response))
        {
          return self::error(Code::MEMBER_EMPTY);
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
          return self::error(Code::MEMBER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response, $request);

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
   * @api {post} /api/sms_login 02. 短信登录
   * @apiDescription 短信登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} username 登录账户（18201018926）
   * @apiParam {string} sms_code 短信验证码（7777）
   *
   * @apiSuccess (字段说明|令牌) {String} token 身份令牌
   * @apiSuccess (字段说明|用户) {Number} id 会员编号
   * @apiSuccess (字段说明|用户) {Number} role_id 角色编号
   * @apiSuccess (字段说明|用户) {Number} open_id 微信编号
   * @apiSuccess (字段说明|用户) {Number} apply_id 苹果编号
   * @apiSuccess (字段说明|用户) {Number} inviter_id 邀请人编号
   * @apiSuccess (字段说明|用户) {Number} member_no 会员号
   * @apiSuccess (字段说明|用户) {String} avatar 会员头像
   * @apiSuccess (字段说明|用户) {String} username 登录账户
   * @apiSuccess (字段说明|用户) {String} nickname 会员昵称
   * @apiSuccess (字段说明|角色) {String} id 角色编号
   * @apiSuccess (字段说明|角色) {String} title 角色名称
   * @apiSuccess (字段说明|角色) {String} content 角色描述
   *
   * @apiSampleRequest /api/sms_login
   * @apiVersion 1.0.0
   */
  public function sms_login(Request $request)
  {
    $messages = [
      'username.required' => '请输入用户名称',
      'username.regex'    => '手机号码不合法',
      'sms_code.required' => '请输入短信验证码',
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

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $condition = self::getSimpleWhereData($username, 'username');

        $response = Member::getRow($condition, ['role']);

        // 用户不存在
        if(is_null($response))
        {
          return self::error(Code::MEMBER_EMPTY);
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
          return self::error(Code::MEMBER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response, $request);

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

        $condition = self::getSimpleWhereData($username, 'username');

        $response = Member::getRow($condition);

        if(empty($response))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        // 发送登录验证码
        event(new SmsEvent($username, 1));

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


  /**
   * @api {post} /api/weixin_login 04. 微信登录
   * @apiDescription 通过第三方软件-微信，进行登录
   * @apiGroup 01. 登录模块
   * @apiParam {string} open_id 微信OpenID
   *
   * @apiSuccess (字段说明|令牌) {String} token 身份令牌
   * @apiSuccess (字段说明|用户) {Number} id 会员编号
   * @apiSuccess (字段说明|用户) {Number} role_id 角色编号
   * @apiSuccess (字段说明|用户) {Number} open_id 微信编号
   * @apiSuccess (字段说明|用户) {Number} apply_id 苹果编号
   * @apiSuccess (字段说明|用户) {Number} inviter_id 邀请人编号
   * @apiSuccess (字段说明|用户) {Number} member_no 会员号
   * @apiSuccess (字段说明|用户) {String} avatar 会员头像
   * @apiSuccess (字段说明|用户) {String} username 登录账户
   * @apiSuccess (字段说明|用户) {String} nickname 会员昵称
   * @apiSuccess (字段说明|角色) {String} id 角色编号
   * @apiSuccess (字段说明|角色) {String} title 角色名称
   * @apiSuccess (字段说明|角色) {String} content 角色描述
   *
   * @apiSampleRequest /api/weixin_login
   * @apiVersion 1.0.0
   */
  public function weixin_login(Request $request)
  {
    $messages = [
      'open_id.required' => '请输入微信编号',
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
        $condition = self::getSimpleWhereData($request->open_id, 'open_id');

        $response = Member::getRow($condition, ['role']);

        // 用户不存在
        if(is_null($response))
        {
          return self::error(Code::MEMBER_EMPTY);
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
          return self::error(Code::MEMBER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response, $request);

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
   * @apiSuccess (字段说明|令牌) {String} token 身份令牌
   * @apiSuccess (字段说明|用户) {Number} id 会员编号
   * @apiSuccess (字段说明|用户) {Number} role_id 角色编号
   * @apiSuccess (字段说明|用户) {Number} open_id 微信编号
   * @apiSuccess (字段说明|用户) {Number} apply_id 苹果编号
   * @apiSuccess (字段说明|用户) {Number} inviter_id 邀请人编号
   * @apiSuccess (字段说明|用户) {Number} member_no 会员号
   * @apiSuccess (字段说明|用户) {String} avatar 会员头像
   * @apiSuccess (字段说明|用户) {String} username 登录账户
   * @apiSuccess (字段说明|用户) {String} nickname 会员昵称
   * @apiSuccess (字段说明|角色) {String} id 角色编号
   * @apiSuccess (字段说明|角色) {String} title 角色名称
   * @apiSuccess (字段说明|角色) {String} content 角色描述
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
          return self::error(Code::MEMBER_EMPTY);
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
          return self::error(Code::MEMBER_EMPTY);
        }

        // 获取客户端ip地址
        $response->last_login_ip = $request->getClientIp();

        $old_token = $response->remember_token;

        if(!empty($old_token))
        {
          \JWTAuth::setToken($old_token)->invalidate();
        }

        // 记录登录信息
        Member::login($response, $request);

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
   * @apiParam {string} [open_id] 微信app编号
   * @apiParam {string} [apply_id] 苹果登录编号
   * @apiParam {string} username 登录手机号码
   * @apiParam {string} avatar 会员头像
   * @apiParam {string} nickname 会员姓名
   * @apiParam {string} [sex] 会员性别
   * @apiParam {string} [age] 会员性别
   * @apiParam {string} [province_id] 省
   * @apiParam {string} [city_id] 市
   * @apiParam {string} [region_id] 县
   * @apiParam {string} [address] 详细地址
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
    ];

    $rule = [
      'username'    => 'required',
      'nickname'    => 'required',
      'avatar'      => 'required',
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
        if(empty($request->open_id))
        {
          $model = Member::firstOrNew(['apply_id' => $request->apply_id, 'status' => 1]);
        }
        else
        {
          $model = Member::firstOrNew(['open_id' => $request->open_id, 'status' => 1]);
        }

        if(empty($request->id))
        {
          $model->member_no = ToolTrait::generateOnlyNumber(3);
        }

        $model->open_id  = $request->open_id ?? '';
        $model->apply_id = $request->apply_id ?? '';
        $model->role_id  = 1;
        $model->avatar   = $request->avatar;
        $model->username = $request->username;
        $model->nickname = $request->nickname;
        $model->save();

        $data = [
          'sex'         => $request->sex ?? '1',
          'age'         => $request->age ?? '1',
          'province_id' => $request->province_id ?? '',
          'city_id'     => $request->city_id ?? '',
          'region_id'   => $request->region_id ?? '',
          'address'     => $request->address ?? '',
        ];

        if(!empty($data))
        {
          $model->archive()->delete();
          $model->archive()->create($data);
        }

        $data = [
          'money' => 0.00,
        ];

        if(!empty($data))
        {
          $model->asset()->delete();
          $model->asset()->create($data);
        }

        $data = [
          'order_switch'    => 1,
          'activity_switch' => 1,
        ];

        if(!empty($data))
        {
          $model->setting()->delete();
          $model->setting()->create($data);
        }

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

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code, 5));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $condition = self::getSimpleWhereData($username, 'username');

        $model = Member::getRow($condition);

        if(empty($model->id))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        if(!empty($model->open_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }

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

        $condition = self::getSimpleWhereData($username, 'username');

        $result = Member::getRow($condition);

        if(!empty($result) && !empty($result->open_id))
        {
          return self::error(Code::CURRENT_MOBILE_BIND);
        }

        // 发送登录验证码
        event(new SmsEvent($username, 5));

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

  /**
   * @api {post} /api/reset_code 09. 重置验证码
   * @apiDescription 获取重置验证码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} username 登录账户（18201018888）
   *
   * @apiSuccess (响应) {String} data 验证码
   *
   * @apiSampleRequest /api/reset_code
   * @apiVersion 1.0.0
   */
  public function reset_code(Request $request)
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

        $condition = self::getSimpleWhereData($username, 'username');

        $response = $this->_model::getRow($condition);

        if(empty($response->id))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        // 发送重置验证码
        event(new SmsEvent($username, 3));

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        record($e);

        return self::error(Code::ERROR);
      }
    }
  }


  /**
   * @api {post} /api/back_mobile 10. 手机找回密码
   * @apiDescription 通过手机号码找回密码
   * @apiGroup 01. 登录模块
   *
   * @apiParam {string} username 登录手机号码
   * @apiParam {string} sms_code 验证码
   * @apiParam {string} password 新密码
   * @apiParam {string} password_confirmation 确认密码
   *
   * @apiSampleRequest /api/back_mobile
   * @apiVersion 1.0.0
   */
  public function back_mobile(Request $request)
  {
    $messages = [
      'username.required'  => '请您输入登录账户',
      'sms_code.required'  => '请您输入验证码',
      'password.required'  => '请您输入新密码',
      'password.between'   => '输入的密码必须是6-16位',
      'password.confirmed' => '您输入的两次密码信息不一致',
    ];

    $rule = [
      'username' => 'required',
      'sms_code' => 'required',
      'password' => 'required|between:6,16|confirmed',
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

        $sms_code = $request->sms_code;

        // 比对验证码
        $status = event(new CodeEvent($username, $sms_code, 3));

        // 验证码错误
        if(empty($status))
        {
          return self::error(Code::VERIFICATION_CODE);
        }

        $condition = self::getSimpleWhereData($username, 'username');

        $model = $this->_model::getRow($condition);

        if(empty($model->id))
        {
          return self::error(Code::MEMBER_EMPTY);
        }

        $password = $this->_model::generate($request->password);

        $model->password = $password;
        $model->save();

        return self::success(Code::HANDLE_SUCCESS);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }




  /**
   * @api {get} /api/logout 11. 退出
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
}
