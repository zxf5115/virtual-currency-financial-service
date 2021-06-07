<?php
namespace App\Http\Controllers\Api\Module\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 模板控制器类
 */
class TemplateController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Template\Template';

  protected $_where = [];

  protected $_params = [
    'position_id',
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/template/list?page={page} 1. 获取模板列表(分页)
   * @apiDescription 获取模板列表(分页)
   * @apiGroup 35. 模板模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 模板编号
   * @apiSuccess (basic params) {String} title 模板名称
   * @apiSuccess (basic params) {String} picture 模板图片
   * @apiSuccess (basic params) {String} left_top 左上坐标点
   * @apiSuccess (basic params) {String} left_bottom 左下坐标点
   * @apiSuccess (basic params) {String} right_top 右上坐标点
   * @apiSuccess (basic params) {String} right_bottom 右下坐标点
   * @apiSuccess (basic params) {Number} sort 模板排序
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/template/list
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
   * @api {get} /api/template/select 2. 获取模板列表(不分页)
   * @apiDescription 获取模板列表(不分页)
   * @apiGroup 35. 模板模块
   *
   * @apiSuccess (basic params) {Number} id 模板编号
   * @apiSuccess (basic params) {String} title 模板名称
   * @apiSuccess (basic params) {String} picture 模板图片
   * @apiSuccess (basic params) {String} left_top 左上坐标点
   * @apiSuccess (basic params) {String} left_bottom 左下坐标点
   * @apiSuccess (basic params) {String} right_top 右上坐标点
   * @apiSuccess (basic params) {String} right_bottom 右下坐标点
   * @apiSuccess (basic params) {Number} sort 模板排序
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/template/select
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
   * @api {get} /api/template/view/{id} 3. 获取模板详情
   * @apiDescription 获取模板详情
   * @apiGroup 35. 模板模块
   *
   * @apiSuccess (basic params) {Number} id 模板编号
   * @apiSuccess (basic params) {String} title 模板名称
   * @apiSuccess (basic params) {String} picture 模板图片
   * @apiSuccess (basic params) {String} left_top 左上坐标点
   * @apiSuccess (basic params) {String} left_bottom 左下坐标点
   * @apiSuccess (basic params) {String} right_top 右上坐标点
   * @apiSuccess (basic params) {String} right_bottom 右下坐标点
   * @apiSuccess (basic params) {Number} sort 模板排序
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/template/view/{id}
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
