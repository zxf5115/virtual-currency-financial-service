<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance\Order\Goods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-18
 *
 * 会员商品订单物流控制器类
 */
class LogisticsController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Order\Goods\Logistics';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/order/goods/logistics/list?page={page} 01. 商品订单物流列表(分页)
   * @apiDescription 获取当前会员商品订单物流列表(分页)
   * @apiGroup 40. 商品订单物流模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {Number} order_id 订单编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} company_name 物流公司
   * @apiSuccess (basic params) {String} logistics_no 物流单号
   * @apiSuccess (basic params) {Number} logistics_status 物流状态
   *
   * @apiSampleRequest /api/member/order/goods/logistics/list
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
   * @api {get} /api/member/order/goods/logistics/select 02. 商品订单物流列表(不分页)
   * @apiDescription 获取当前会员商品订单物流列表(不分页)
   * @apiGroup 40. 商品订单物流模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {Number} order_id 订单编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} company_name 物流公司
   * @apiSuccess (basic params) {String} logistics_no 物流单号
   * @apiSuccess (basic params) {Number} logistics_status 物流状态
   *
   * @apiSampleRequest /api/member/order/goods/logistics/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

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
   * @api {get} /api/member/order/goods/logistics/view/{id} 03. 商品订单物流详情
   * @apiDescription 获取当前会员商品订单物流的详情
   * @apiGroup 40. 商品订单物流模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 订单编号
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {Number} order_id 订单编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} company_name 物流公司
   * @apiSuccess (basic params) {String} logistics_no 物流单号
   * @apiSuccess (basic params) {Number} logistics_status 物流状态
   *
   * @apiSampleRequest /api/member/order/goods/logistics/view/{id}
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
