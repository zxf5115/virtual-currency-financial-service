<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员资产控制器类
 */
class AssetController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Member\Money';


  /**
   * @api {post} /api/member/asset/list 01. 我的收支记录
   * @apiDescription 获取当前会员的收支记录
   * @apiGroup 21. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {String} type 收支类型
   * @apiSuccess (字段说明) {String} money 收支金额
   * @apiSuccess (字段说明) {String} create_time 收支时间
   *
   * @apiSampleRequest /api/member/asset/list
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
   * @api {post} /api/member/asset/income 02. 我的充值记录
   * @apiDescription 获取当前会员的充值记录
   * @apiGroup 21. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {String} money 收支金额
   * @apiSuccess (字段说明) {String} create_time 收支时间
   *
   * @apiSampleRequest /api/member/asset/income
   * @apiVersion 1.0.0
   */
  public function income(Request $request)
  {
    try
    {
      $where = [
        'type' => 1
      ];

      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter, $where);

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
   * @api {post} /api/member/asset/expend 03. 我的消费记录
   * @apiDescription 获取当前会员的消费记录
   * @apiGroup 21. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {String} money 收支金额
   * @apiSuccess (字段说明) {String} create_time 收支时间
   *
   * @apiSampleRequest /api/member/asset/expend
   * @apiVersion 1.0.0
   */
  public function expend(Request $request)
  {
    try
    {
      $where = [
        'type' => 2
      ];

      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter, $where);

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
}
