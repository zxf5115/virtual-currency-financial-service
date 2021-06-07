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
 * 招聘老师分红提取控制器类
 */
class ExtractController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Teacher\Recruitment\Relevance\Relevance\Extract';

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
  protected $_relevance = [];


  /**
   * @api {get} /api/teacher/management/money/extract/list?page={page} 03. 获取分红提取列表(分页)
   * @apiDescription 获取当前招聘老师的分红提取列表(分页)
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
   * @apiSuccess (basic params) {Number} id 老师分红提取编号
   * @apiSuccess (basic params) {Number} type 提取类型
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课程名称
   * @apiSuccess (basic params) {String} present 礼包信息
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   *
   * @apiSampleRequest /api/teacher/management/money/extract/list
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
