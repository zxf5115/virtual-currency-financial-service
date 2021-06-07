<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Member\Course\Unit\UnlockEvent;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-04
 *
 * 会员课程单元控制器类
 */
class Unit2Controller extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Relevance\Unit';

  protected $_where = [];

  protected $_params = [
    'is_finish',
    'course_id',
    'courseware_id',
    'level_id',
  ];

  protected $_addition = [
    'unit' => [
      'status'
    ]
  ];

  protected $_order = [];

  protected $_relevance = [
    'list' => [
      'unit',
    ],
    'select' => [
      'unit',
    ],
    'view' => [
      'unit',
    ]
  ];


  /**
   * @api {get} /api/member/course/unit/list?page={page} 01. 会员课程单元列表(分页)
   * @apiDescription 获取当前会员订阅的课程单元列表(分页)
   * @apiGroup 34. 会员课程单元模块
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
   * @apiSuccess (basic params) {Number} id 学员课程单元编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (unit params) {Number} id 课程编号
   * @apiSuccess (unit params) {Number} courseware_id 课件编号
   * @apiSuccess (unit params) {Number} level_id 课件级别编号
   * @apiSuccess (unit params) {Number} title 课件单元名称
   * @apiSuccess (unit params) {Number} description 课程单元描述
   * @apiSuccess (unit params) {String} sort 排序
   * @apiSuccess (unit params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/unit/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 解锁课程单元知识点
      event(new UnlockEvent($request->all()));

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
   * @api {get} /api/member/course/unit/select 02. 会员课程单元列表(不分页)
   * @apiDescription 获取当前会员订阅的课程单元列表(不分页)
   * @apiGroup 34. 会员课程单元模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 学员课程单元编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (unit params) {Number} id 课程编号
   * @apiSuccess (unit params) {Number} courseware_id 课件编号
   * @apiSuccess (unit params) {Number} level_id 课件级别编号
   * @apiSuccess (unit params) {Number} title 课件单元名称
   * @apiSuccess (unit params) {Number} description 课程单元描述
   * @apiSuccess (unit params) {String} sort 排序
   * @apiSuccess (unit params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/unit/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $request['unit_status'] = 1;

      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 解锁课程单元知识点
      event(new UnlockEvent($request->all()));

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
   * @api {get} /api/member/course/view/unit/{id} 03. 当前会员课程单元详情
   * @apiDescription 获取当前会员课程单元详情
   * @apiGroup 34. 会员课程单元模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 课程编号
   *
   * @apiSuccess (basic params) {Number} id 学员课程单元编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (unit params) {Number} id 课程编号
   * @apiSuccess (unit params) {Number} courseware_id 课件编号
   * @apiSuccess (unit params) {Number} level_id 课件级别编号
   * @apiSuccess (unit params) {Number} title 课件单元名称
   * @apiSuccess (unit params) {Number} description 课程单元描述
   * @apiSuccess (unit params) {String} sort 排序
   * @apiSuccess (unit params) {Number} create_time 添加时间
   *
   *
   * @apiSampleRequest /api/member/course/unit/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData();

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
}
