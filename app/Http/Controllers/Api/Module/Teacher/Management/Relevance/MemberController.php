<?php
namespace App\Http\Controllers\Api\Module\Teacher\Management\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Production\Production;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 管理老师的学员控制器类
 */
class MemberController extends BaseController
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
  protected $_params = [
    'course_id',
    'courseware_id',
    'level_id'
  ];

  /**
   * 关联查询字段
   */
  protected $_addition = [];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'apply_time', 'value' => 'desc'],
    ['key' => 'apply_status', 'value' => 'asc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [
    'list' => [
      'course',
      'courseware',
      'member.archive'
    ],
    'view' => [
      'course',
      'courseware',
      'level',
      'member.archive',
      'member.asset'
    ],
    'production' => [
      'member.archive',
    ]
  ];


  /**
   * @api {get} /api/teacher/management/member/list?page={page} 01. 学员列表(分页)
   * @apiDescription 获取当前管理老师的学员列表(分页)
   * @apiGroup 33. 管理老师学员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 会员编号
   * @apiSuccess (basic params) {String} open_id 第三方登录编号
   * @apiSuccess (basic params) {Number} member_no 会员号
   * @apiSuccess (basic params) {String} avatar 会员头像
   * @apiSuccess (basic params) {String} username 登录账户
   * @apiSuccess (basic params) {String} nickname 会员姓名
   * @apiSuccess (basic params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/teacher/management/member/list
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

      // 获取当前老师
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
   * @api {get} /api/teacher/management/member/production 02. 作品列表(分页)
   * @apiDescription 获取当前管理老师学员的作品列表(分页)
   * @apiGroup 33. 管理老师学员模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {Number} title 作品名称
   * @apiSuccess (basic params) {Number} picture 作品图片
   * @apiSuccess (basic params) {Number} description 作品描述
   * @apiSuccess (basic params) {Number} duration 作品描述时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {Number} is_recommend 是否推荐 0 为推荐 1 已推荐
   * @apiSuccess (basic params) {Number} is_approval 是否点赞
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/teacher/management/member/production
   * @apiVersion 1.0.0
   */
  public function production(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取当前老师的学员
      $result = $this->_model::getPluck('member_id', $condition, false, false, true);

      $condition = [
        [
          'member_id',
          $result
        ]
      ];


      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'production');

      // 获得当前老师学员的作品
      $response = Production::getPaging($condition, $relevance);

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
   * @api {get} /api/teacher/management/member/view/{id} 03. 学员课程详情
   * @apiDescription 获取当前管理老师的课程详情
   * @apiGroup 33. 管理老师学员模块
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
   * @apiSampleRequest /api/teacher/management/member/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      $where = ['member_id' => $id];

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
}
