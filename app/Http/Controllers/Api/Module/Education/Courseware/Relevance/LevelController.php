<?php
namespace App\Http\Controllers\Api\Module\Education\Courseware\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课件控制器类
 */
class LevelController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Courseware\Relevance\Level';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'courseware_id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/education/courseware/level/list?page={page} 1. 课件级别列表(分页)
   * @apiDescription 获取课件级别列表(分页)
   * @apiGroup 25. 课件级别模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} courseware_id 课件编号
   *
   * @apiSuccess (basic params) {Number} id 课件级别编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} minimum_age 最小年龄
   * @apiSuccess (basic params) {Number} largest_age 最大年龄
   * @apiSuccess (basic params) {String} level 课件级别信息
   * @apiSuccess (basic params) {String} description 课件级别描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/list
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
   * @api {get} /api/education/courseware/level/select 2. 课件级别列表(不分页)
   * @apiDescription 获取课件级别列表(不分页)
   * @apiGroup 25. 课件级别模块
   *
   * @apiParam {int} courseware_id 课件编号
   *
   * @apiSuccess (basic params) {Number} id 课件级别编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} minimum_age 最小年龄
   * @apiSuccess (basic params) {Number} largest_age 最大年龄
   * @apiSuccess (basic params) {String} level 课件级别信息
   * @apiSuccess (basic params) {String} description 课件级别描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/select
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
   * @api {get} /api/education/courseware/level/view/{id} 3. 课件级别详情
   * @apiDescription 获取课件级别详情
   * @apiGroup 25. 课件级别模块
   *
   * @apiParam {int} courseware_id 课件编号
   *
   * @apiSuccess (basic params) {Number} id 课件级别编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} minimum_age 最小年龄
   * @apiSuccess (basic params) {Number} largest_age 最大年龄
   * @apiSuccess (basic params) {String} level 课件级别信息
   * @apiSuccess (basic params) {String} description 课件级别描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/view/{id}
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
