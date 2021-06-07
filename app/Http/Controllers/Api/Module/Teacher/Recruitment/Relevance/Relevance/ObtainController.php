<?php
namespace App\Http\Controllers\Api\Module\Teacher\Recruitment\Relevance\Relevance;

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
 * 招聘老师分红获取控制器类
 */
class ObtainController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Teacher\Recruitment\Relevance\Relevance\Obtain';

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
      'member.archive',
      'course',
      'courseware',
    ]
  ];


  /**
   * @api {get} /api/teacher/management/money/obtain/list?page={page} 02. 获取分红收益列表(分页)
   * @apiDescription 获取当前招聘老师的分红列表(分页)
   * @apiGroup 39. 招聘老师分红模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 分红获取编号
   * @apiSuccess (basic params) {Number} member_id 老师编号
   * @apiSuccess (basic params) {Number} money_id 分红编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {String} money 获取金额
   * @apiSuccess (basic params) {String} settlement_status 结算状态
   * @apiSuccess (basic params) {Number} create_time 获取时间
   *
   * @apiSuccess (member params) {Number} nickname 昵称
   * @apiSuccess (member params) {String} avatar 头像
   * @apiSuccess (archive params) {String} sex 性别
   * @apiSuccess (archive params) {String} age 年龄
   * @apiSuccess (archive params) {String} city_id 所在城市
   *
   * @apiSuccess (course params) {String} semester 课程周期
   *
   * @apiSuccess (courseware params) {String} title 课件名称
   *
   * @apiSampleRequest /api/teacher/management/money/obtain/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('member_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      // 获取当前老师的班级
      $response = $this->_model::getPaging($condition, $relevance);

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
