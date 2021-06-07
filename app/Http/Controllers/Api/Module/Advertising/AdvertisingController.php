<?php
namespace App\Http\Controllers\Api\Module\Advertising;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Advertising\Position;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-27
 *
 * 广告控制器类
 */
class AdvertisingController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Advertising\Advertising';

  protected $_where = [];

  protected $_params = [
    'position_id',
  ];

  protected $_addition = [
    'position' => [
      'course_id'
    ]
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'position'
  ];


  /**
   * @api {get} /api/advertising/list?page={page} 1. 获取广告列表(分页)
   * @apiDescription 获取广告列表(分页)
   * @apiGroup 21. 广告模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} position_id 广告位编号
   *
   * @apiSuccess (basic params) {Number} id 广告编号
   * @apiSuccess (basic params) {Number} position_id 广告位编号
   * @apiSuccess (basic params) {String} title 广告标题
   * @apiSuccess (basic params) {String} picture 广告图片资源
   * @apiSuccess (basic params) {String} url 广告其他资源
   * @apiSuccess (basic params) {String} type 链接类型
   * @apiSuccess (basic params) {String} link 广告链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/list
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
   * @api {get} /api/advertising/select 2. 获取广告列表(不分页)
   * @apiDescription 获取广告列表(不分页)
   * @apiGroup 21. 广告模块
   *
   * @apiParam {int} position_id 广告位编号
   *
   * @apiSuccess (basic params) {Number} id 广告编号
   * @apiSuccess (basic params) {Number} position_id 广告位编号
   * @apiSuccess (basic params) {String} title 广告标题
   * @apiSuccess (basic params) {String} picture 广告图片资源
   * @apiSuccess (basic params) {String} url 广告其他资源
   * @apiSuccess (basic params) {String} type 链接类型
   * @apiSuccess (basic params) {String} link 广告链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/select
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

      $response = $this->_model::getList($condition, $relevance, $this->_order, false, false, 5);

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
   * @api {get} /api/advertising/view/{id} 3. 获取广告详情
   * @apiDescription 获取广告详情
   * @apiGroup 21. 广告模块
   *
   * @apiSuccess (basic params) {Number} id 广告编号
   * @apiSuccess (basic params) {Number} position_id 广告位编号
   * @apiSuccess (basic params) {String} title 广告标题
   * @apiSuccess (basic params) {String} picture 广告图片资源
   * @apiSuccess (basic params) {String} url 广告其他资源
   * @apiSuccess (basic params) {String} type 链接类型
   * @apiSuccess (basic params) {String} link 广告链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/advertising/view/{id}
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
