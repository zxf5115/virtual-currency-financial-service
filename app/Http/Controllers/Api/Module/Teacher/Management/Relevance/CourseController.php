<?php
namespace App\Http\Controllers\Api\Module\Teacher\Management\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 管理老师课程控制器类
 */
class CourseController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Course';

  /**
   * 基本查询条件
   */
  protected $_where = [];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [];

  /**
   * 关联查询字段
   */
  protected $_addition = [];

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
    'list' => [
      'teacher',
      'member',
      'course'
    ],
    'select' => [
      'teacher',
      'member',
      'course'
    ],
    'view' => [
      'teacher',
      'member',
      'course'
    ],
  ];


  /**
   * @api {get} /api/teacher/management/course/list?page={page} 01. 课程列表(分页)
   * @apiDescription 获取当前管理老师的课程列表(分页)
   * @apiGroup 16. 管理老师课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/teacher/management/course/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      $response = $this->_model::getPaging($condition, $relevance, $this->_order);

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
   * @api {get} /api/teacher/management/course/select 02. 课程列表(不分页)
   * @apiDescription 获取当前管理老师的课程列表(不分页)
   * @apiGroup 16. 管理老师课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/teacher/management/course/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

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
   * @api {get} /api/teacher/management/course/view/{id} 03. 课程详情
   * @apiDescription 获取当前管理老师的课程详情
   * @apiGroup 16. 管理老师课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/teacher/management/course/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

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
   * @api {post} /api/teacher/management/course/confirm 04. 确认添加家长微信
   * @apiDescription 当前管理老师确认添加家长微信
   * @apiGroup 16. 管理老师课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} member_id 会员编号
   *
   * @apiSampleRequest /api/teacher/management/course/confirm
   * @apiVersion 1.0.0
   */
  public function confirm(Request $request)
  {
    $messages = [
      'member_id.required' => '请您输入会员编号',
    ];

    $rule = [
      'member_id' => 'required',
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
        $condition = self::getCurrentWhereData('teacher_id');

        $condition['member_id'] = $request->member_id;

        $model = $this->_model::getRow($condition);

        if(empty($model))
        {
          return self::error(Code::CURRENT_COURSE_EMPTY);
        }

        $model->is_add       = 1;
        $model->apply_status = 1;
        $model->confirm_time = time();

        $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
