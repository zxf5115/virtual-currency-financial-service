<?php
namespace App\Http\Controllers\Api\Module\Education\Courseware\Relevance\Relevance\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 课件知识点控制器类
 */
class PointController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Courseware\Relevance\Relevance\Relevance\Point';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'courseware_id',
    'level_id',
    'unit_id',
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
   * @api {get} /api/education/courseware/level/unit/point/list?page={page} 1. 课件知识点列表(分页)
   * @apiDescription 获取课件知识点列表(分页)
   * @apiGroup 27. 课件知识点模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} id 课件知识点编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {String} title 课件知识点名称
   * @apiSuccess (basic params) {String} picture 课件知识点封面
   * @apiSuccess (basic params) {Number} url 课件知识点视频
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/point/list
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
   * @api {get} /api/education/courseware/level/unit/point/select 2. 课件知识点列表(不分页)
   * @apiDescription 获取课件知识点列表(不分页)
   * @apiGroup 27. 课件知识点模块
   *
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} id 课件知识点编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {String} title 课件知识点名称
   * @apiSuccess (basic params) {String} picture 课件知识点封面
   * @apiSuccess (basic params) {Number} url 课件知识点视频
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/point/select
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
   * @api {get} /api/education/courseware/level/unit/point/view/{id} 3. 课件知识点详情
   * @apiDescription 获取课件知识点详情
   * @apiGroup 27. 课件知识点模块
   *
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} id 课件知识点编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {String} title 课件知识点名称
   * @apiSuccess (basic params) {String} picture 课件知识点封面
   * @apiSuccess (basic params) {Number} url 课件知识点视频
   * @apiSuccess (basic params) {Number} create_time 发布时间
   *
   * @apiSampleRequest /api/education/courseware/level/unit/point/view/{id}
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
