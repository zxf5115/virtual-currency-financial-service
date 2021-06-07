<?php
namespace App\Http\Controllers\Api\Module\Teacher\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Teacher\Management\Relevance\Archive;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 管理老师控制器类
 */
class TeacherController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Teacher\Management\Member';

  /**
   * 基本查询条件
   */
  protected $_where = [
    'relevance' => [
      'role_id' => 2
    ]
  ];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [
    'username',
    'nickname'
  ];

  /**
   * 关联查询字段
   */
  protected $_addition = [
    'archive' => [
      'weixin',
    ]
  ];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [
   'archive' => [
      'role',
      'relevance',
      'archive',
      'course',
    ]
  ];



  /**
   * @api {get} /api/teacher/management/archive 01. 当前管理老师档案
   * @apiDescription 获取当前管理老师的档案信息
   * @apiGroup 15. 管理老师模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 老师编号
   * @apiSuccess (basic params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (basic params) {String} open_id 第三方登录编号
   * @apiSuccess (basic params) {Number} member_no 会员号
   * @apiSuccess (basic params) {String} avatar 老师头像
   * @apiSuccess (basic params) {String} qr_code 老师二维码
   * @apiSuccess (basic params) {String} username 登录账户
   * @apiSuccess (basic params) {String} nickname 老师姓名
   * @apiSuccess (basic params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (basic params) {Number} create_time 注册时间
   * @apiSuccess (archive params) {Number} member_id 会员编号
   * @apiSuccess (archive params) {String} id_card_no 身份证号
   * @apiSuccess (archive params) {String} weixin 微信号
   * @apiSuccess (archive params) {String} sex 性别
   * @apiSuccess (archive params) {String} province_id 省
   * @apiSuccess (archive params) {String} city_id 市
   * @apiSuccess (archive params) {String} region_id 县
   * @apiSuccess (archive params) {String} address 详细地址
   *
   * @apiSuccess (role params) {String} id 角色编号
   * @apiSuccess (role params) {String} title 角色名称
   * @apiSuccess (role params) {String} content 角色内容
   *
   * @apiSuccess (course params) {String} course_id 课程编号
   *
   * @apiSampleRequest /api/teacher/management/archive
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
   * @api {post} /api/teacher/management/handle 02. 编辑管理老师信息
   * @apiDescription 编辑管理老师的信息
   * @apiGroup 15. 管理老师模块
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
   * @apiParam {string} id_card_no 身份证号码（不可为空）
   * @apiParam {string} province_id 省（可以为空）
   * @apiParam {string} city_id 市（可以为空）
   * @apiParam {string} region_id 县（可以为空）
   * @apiParam {string} weixin 微信号码（可以为空）
   * @apiParam {string} address 详细地址（可以为空）
   * @apiParam {string} qr_code 二维码（可以为空）
   *
   * @apiSampleRequest /api/teacher/management/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'nickname.required'   => '请您输入会员姓名',
      'avatar.required'     => '请您上传会员头像',
      'sex.required'        => '请您选择会员性别',
      'id_card_no.required' => '请您输入身份证号码',
    ];

    $rule = [
      'nickname'   => 'required',
      'avatar'     => 'required',
      'sex'        => 'required',
      'id_card_no' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      // 获取当前会员编号
      $member_id = self::getCurrentId();

      $model = $this->_model::firstOrNew(['id' => $member_id]);

      DB::beginTransaction();

      try
      {
        $model->avatar   = $request->avatar;
        $model->nickname = $request->nickname;
        $model->qr_code  = $request->qr_code ?: '';

        $model->save();

        $archive = Archive::firstOrCreate(['member_id' => $member_id]);

        $archive->member_id   = $member_id;
        $archive->sex         = $request->sex ?? '1';
        $archive->id_card_no  = $request->id_card_no ?? '';
        $archive->weixin      = $request->weixin ?? '';
        $archive->province_id = $request->province_id ?? '';
        $archive->city_id     = $request->city_id ?? '';
        $archive->region_id   = $request->region_id ?? '';
        $archive->address     = $request->address ?? '';

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
}
