<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Events\Common\Message\SmsEvent;
use App\Events\Common\Message\EmailEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Relevance\Archive;
use App\Models\Api\Module\Organization\Organization;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员控制器类
 */
class MemberController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Member';

  protected $_where = [];

  protected $_params = [];

  protected $_addition = [
    'relevance' => [
      'role_id'
    ]
  ];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'archive' => [
      'archive',
      'asset'
    ],
    'view' => [
      'archive'
    ],
    'status' => [
      'archive',
      'relevance'
    ]
  ];


  /**
   * @api {get} /api/member/archive 01. 获取当前会员档案
   * @apiDescription 获取当前会员的档案信息
   * @apiGroup 04. 会员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员编号
   * @apiSuccess (basic params) {Number} open_id 第三方登录编号
   * @apiSuccess (basic params) {Number} member_no 会员号
   * @apiSuccess (basic params) {String} avatar 会员头像
   * @apiSuccess (basic params) {String} username 登录账户
   * @apiSuccess (basic params) {String} nickname 会员姓名
   * @apiSuccess (basic params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (basic params) {Number} create_time 注册时间
   * @apiSuccess (archive params) {Number} member_id 会员编号
   * @apiSuccess (archive params) {Number} skill_level 绘画基础
   * @apiSuccess (archive params) {String} id_card_no 身份证号
   * @apiSuccess (archive params) {String} weixin 微信号
   * @apiSuccess (archive params) {String} sex 性别
   * @apiSuccess (archive params) {String} birthday 生日
   * @apiSuccess (archive params) {String} age 年龄
   * @apiSuccess (archive params) {String} province_id 省
   * @apiSuccess (archive params) {String} city_id 市
   * @apiSuccess (archive params) {String} region_id 县
   * @apiSuccess (archive params) {String} address 详细地址
   *
   * @apiSuccess (asset params) {String} red_envelope 红包金额
   * @apiSuccess (asset params) {String} lollipop 棒棒糖数
   * @apiSuccess (asset params) {String} production 作品数
   *
   * @apiSampleRequest /api/member/archive
   * @apiVersion 1.0.0
   */
  public function archive(Request $request)
  {
    try
    {
      // 获取当前会员基础查询条件
      $condition = self::getCurrentWhereData('id');

      $condition = array_merge($condition, $this->_where);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'archive');

      $response = $this->_model::getRow($condition, $relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/member/handle 02. 编辑会员信息
   * @apiDescription 编辑会员信息
   * @apiGroup 04. 会员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} avatar 会员头像（不可为空）
   * @apiParam {string} nickname 会员姓名（不可为空）
   * @apiParam {string} sex 会员性别（不可为空）
   * @apiParam {string} birthday 会员生日（不可为空）
   * @apiParam {string} skill_level 绘画基础 0 无基础 1 1年以下 2 1年以上（不可为空）
   * @apiParam {string} province_id 省（可以为空）
   * @apiParam {string} city_id 市（可以为空）
   * @apiParam {string} region_id 县（可以为空）
   *
   * @apiSampleRequest /api/member/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'nickname.required'    => '请您输入会员姓名',
      'avatar.required'      => '请您上传会员头像',
      'sex.required'         => '请您选择会员性别',
      'birthday.required'    => '请您输入会员生日',
      'skill_level.required' => '请您选择绘画基础',
    ];

    $rule = [
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
        // 获取当前会员编号
        $member_id = self::getCurrentId();

        $model = $this->_model::firstOrNew(['id' => $member_id]);

        $model->avatar   = $request->avatar;
        $model->nickname = $request->nickname;

        $model->save();

        $archive = Archive::firstOrCreate(['member_id' => $member_id]);


        $archive->member_id   = $member_id;
        $archive->sex         = $request->sex ?? '1';
        $archive->age         = $this->_model::computeAge($request->birthday);
        $archive->birthday    = strtotime($request->birthday);
        $archive->skill_level = $request->skill_level ?? '1';
        $archive->province_id = $request->province_id ?? '';
        $archive->city_id     = $request->city_id ?? '';
        $archive->region_id   = $request->region_id ?? '';

        $archive->save();

        DB::commit();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
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
   * @api {post} /api/member/teacher 03. 成为招聘老师
   * @apiDescription 将满足条件的当前会员的身份变成招聘老师
   * @apiGroup 04. 会员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSampleRequest /api/member/teacher
   * @apiVersion 1.0.0
   */
  public function teacher(Request $request)
  {
    DB::beginTransaction();

    try
    {
      // 获取当前会员编号
      $member_id = self::getCurrentId();

      $relevance = ['target'];

      $model = $this->_model::getRow(['id' => $member_id], $relevance);

      // 如果当前用户不存在任务指标
      if(empty($model->target))
      {
        return self::error(Code::MEMBER_TARGET_EMPTY);
      }

      $target = $model->target;

      if(!($target->course_total > 0))
      {
        return self::error(Code::MEMBER_TARGET_EMPTY);
      }

      $data = [[
        'organization_id' => self::getOrganizationId(),
        'role_id' => 1,
      ]];

      if(!empty($data))
      {
        $model->relevance()->delete();

        $model->relevance()->createMany($data);
      }

      DB::commit();

      return self::success(Code::message(Code::HANDLE_SUCCESS));
    }
    catch(\Exception $e)
    {
      DB::rollback();

      // 记录异常信息
      self::record($e);

      return self::error(Code::HANDLE_FAILURE);
    }
  }


  /**
   * @api {get} /api/member/view/{id} 04. 获取会员详情
   * @apiDescription 获取会员详情
   * @apiGroup 04. 会员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员编号
   * @apiSuccess (basic params) {Number} open_id 第三方登录编号
   * @apiSuccess (basic params) {Number} member_no 会员号
   * @apiSuccess (basic params) {String} avatar 会员头像
   * @apiSuccess (basic params) {String} username 登录账户
   * @apiSuccess (basic params) {String} nickname 会员姓名
   * @apiSuccess (basic params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (basic params) {Number} create_time 注册时间
   * @apiSuccess (archive params) {Number} member_id 会员编号
   * @apiSuccess (archive params) {Number} skill_level 绘画基础
   * @apiSuccess (archive params) {String} id_card_no 身份证号
   * @apiSuccess (archive params) {String} weixin 微信号
   * @apiSuccess (archive params) {String} sex 性别
   * @apiSuccess (archive params) {String} birthday 生日
   * @apiSuccess (archive params) {String} age 年龄
   * @apiSuccess (archive params) {String} province_id 省
   * @apiSuccess (archive params) {String} city_id 市
   * @apiSuccess (archive params) {String} region_id 县
   * @apiSuccess (archive params) {String} address 详细地址
   *
   * @apiSampleRequest /api/member/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = ['id' => $id];

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }

  /**
   * @api {get} /api/member/status 05. 当前会员是否填写资料
   * @apiDescription 获取当前会员是否填写资料信息
   * @apiGroup 04. 会员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} data true|false
   *
   * @apiSampleRequest /api/member/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    try
    {
      $response = false;

      // 获取当前会员基础查询条件
      $condition = self::getCurrentWhereData('id');

      $condition = array_merge($condition, $this->_where);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'status');

      $result = $this->_model::getRow($condition, $relevance);

      if(!empty($result->archive))
      {
        $response = true;
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
