<?php
namespace App\Http\Controllers\Api\Module\Goods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 商品控制器类
 */
class GoodsController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Goods\Goods';

  protected $_where = [
    'status' => 1
  ];

  protected $_params = [];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'view' => [
      'detail',
      'picture'
    ]
  ];


  /**
   * @api {get} /api/goods/list?page={page} 1. 获取商品列表(分页)
   * @apiDescription 获取商品列表(分页)
   * @apiGroup 41. 商品模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 商品编号
   * @apiSuccess (basic params) {String} title 商品名称
   * @apiSuccess (basic params) {String} cover 商品封面图
   * @apiSuccess (basic params) {String} description 商品描述
   * @apiSuccess (basic params) {String} lollipop_total 棒棒糖兑换数
   * @apiSuccess (basic params) {String} cash_money 现金价格
   * @apiSuccess (basic params) {String} exchange_total 已经兑换数量
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/goods/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

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
   * @api {get} /api/goods/select 2. 获取商品列表(不分页)
   * @apiDescription 获取商品列表(不分页)
   * @apiGroup 41. 商品模块
   *
   * @apiSuccess (basic params) {Number} id 商品编号
   * @apiSuccess (basic params) {String} title 商品名称
   * @apiSuccess (basic params) {String} cover 商品封面图
   * @apiSuccess (basic params) {String} description 商品描述
   * @apiSuccess (basic params) {String} lollipop_total 棒棒糖兑换数
   * @apiSuccess (basic params) {String} cash_money 现金价格
   * @apiSuccess (basic params) {String} exchange_total 已经兑换数量
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/goods/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

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
   * @api {get} /api/goods/view/{id} 3. 获取商品详情
   * @apiDescription 获取商品详情
   * @apiGroup 41. 商品模块
   *
   * @apiSuccess (basic params) {Number} id 商品编号
   * @apiSuccess (basic params) {String} title 商品名称
   * @apiSuccess (basic params) {String} cover 商品封面图
   * @apiSuccess (basic params) {String} description 商品描述
   * @apiSuccess (basic params) {String} lollipop_total 棒棒糖兑换数
   * @apiSuccess (basic params) {String} cash_money 现金价格
   * @apiSuccess (basic params) {String} exchange_total 已经兑换数量
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (detail params) {String} content 商品详情
   *
   * @apiSuccess (picture params) {String} picture 商品轮播图片
   *
   * @apiSampleRequest /api/goods/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id);

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
