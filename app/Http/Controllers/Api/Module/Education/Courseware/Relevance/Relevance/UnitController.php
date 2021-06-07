<?php
namespace App\Http\Controllers\Api\Module\Education\Courseware\Relevance\Relevance;

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
 * 课件单元控制器类
 */
class UnitController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Courseware\Relevance\Relevance\Unit';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'courseware_id',
    'level_id',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/education/courseware/level/unit/list?page={page} 01. 课件单元列表(分页)
   * @apiDescription 获取课件单元列表(分页)
   * @apiGroup 26. 课件单元模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课件单元编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {String} title 课件单元名称
   * @apiSuccess (basic params) {String} description 课件单元描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/list
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
   * @api {get} /api/education/courseware/level/unit/select 02. 课件单元列表(不分页)
   * @apiDescription 获取课件单元列表(不分页)
   * @apiGroup 26. 课件单元模块
   *
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课件单元编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {String} title 课件单元名称
   * @apiSuccess (basic params) {String} description 课件单元描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/select
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
   * @api {get} /api/education/courseware/level/unit/view/{id} 03. 课件单元详情
   * @apiDescription 获取课件详情
   * @apiGroup 26. 课件单元模块
   *
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课件单元编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {String} title 课件单元名称
   * @apiSuccess (basic params) {String} description 课件单元描述
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/view/{id}
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


  /**
   * @api {get} /api/education/courseware/level/unit/unlock 04. 课件单元解锁数据
   * @apiDescription 获取课件单元列表(不分页)
   * @apiGroup 26. 课件单元模块
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课件单元编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {String} title 课件单元名称
   * @apiSuccess (basic params) {String} description 课件单元描述
   * @apiSuccess (basic params) {String} wait_unlock_time 解锁时间
   * @apiSuccess (basic params) {String} is_unlock 是否已解锁
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/unlock
   * @apiVersion 1.0.0
   */
  public function unlock(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $result = $this->_model::getList($condition, $relevance, $this->_order);

      // 获取解锁数据
      $response = $this->_model::setUnlockData($result, $request->course_id);

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
