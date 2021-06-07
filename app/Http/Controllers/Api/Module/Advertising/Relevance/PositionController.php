<?php
namespace App\Http\Controllers\Api\Module\Advertising\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

class PositionController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Advertising\Relevance\Position';

  protected $_where = [];

  protected $_params = [
    'course_id',
  ];

  protected $_addition = [];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'view' => [
      'advertising'
    ]
  ];


  /**
   * @api {get} /api/advertising/position/list?page={page} 1. 获取广告位列表(分页)
   * @apiDescription 获取广告位列表(分页)
   * @apiGroup 20. 广告位模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 广告位编号
   * @apiSuccess (basic params) {Number} title 广告位名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 广告位宽度
   * @apiSuccess (basic params) {Number} height 广告位高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/position/list
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
   * @api {get} /api/advertising/position/select 2. 获取广告位列表(不分页)
   * @apiDescription 获取广告位列表(不分页)
   * @apiGroup 20. 广告位模块
   *
   * @apiSuccess (basic params) {Number} id 广告位编号
   * @apiSuccess (basic params) {Number} title 广告位名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 广告位宽度
   * @apiSuccess (basic params) {Number} height 广告位高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/position/select
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
   * @api {get} /api/advertising/position/view/{id} 3. 获取广告位详情
   * @apiDescription 获取广告位详情
   * @apiGroup 20. 广告位模块
   *
   * @apiSuccess (basic params) {Number} id 广告位编号
   * @apiSuccess (basic params) {Number} title 广告位名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 广告位宽度
   * @apiSuccess (basic params) {Number} height 广告位高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/position/view/{id}
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
