<?php
namespace App\Http\Controllers\Api\Module\Teacher\Recruitment\Relevance;

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
 * 招聘老师分红控制器类
 */
class MoneyController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Teacher\Recruitment\Relevance\Money';

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
   * @api {get} /api/teacher/management/money/center 01. 分红中心
   * @apiDescription 获取当前招聘老师的课程详情
   * @apiGroup 39. 招聘老师分红模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 分红编号
   * @apiSuccess (basic params) {Number} member_id 招聘老师编号
   * @apiSuccess (basic params) {Number} wait_money 待分红金额
   * @apiSuccess (basic params) {Number} wait_number 待分红人数
   * @apiSuccess (basic params) {Number} total_money 总分红金额
   * @apiSuccess (basic params) {Number} total_number 总分红人数
   *
   * @apiSampleRequest /api/teacher/management/money/center
   * @apiVersion 1.0.0
   */
  public function center(Request $request)
  {
    try
    {
      $response = [
        'wait_money'   => 0,
        'wait_number'  => 0,
        'total_money'  => 0,
        'total_number' => 0,
      ];

      $condition = self::getCurrentWhereData('member_id');

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'center');

      $result = $this->_model::getRow($condition, $relevance);

      if(!empty($result))
      {
        $response = $result;
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
