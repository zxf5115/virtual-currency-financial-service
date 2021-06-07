<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-14
 *
 * 课程老师控制器类
 */
class TeacherController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Course\Relevance\Teacher';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id',
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
  protected $_relevance = [
    'list' => [
      'teacher',
    ],
    'view' => [
      'teacher',
    ]
  ];


  /**
   * @api {get} /api/education/course/teacher/list?page={page} 1. 课程老师列表(分页)
   * @apiDescription 获取课程老师列表(分页)
   * @apiGroup 29. 课程老师模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课程老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} teacher_id 老师编号
   * @apiSuccess (basic params) {String} sort 课程老师名称
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {String} id 老师编号
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   *
   * @apiSampleRequest /api/education/course/teacher/list
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
   * @api {get} /api/education/course/teacher/select 2. 课程老师列表(不分页)
   * @apiDescription 获取课程老师列表(不分页)
   * @apiGroup 29. 课程老师模块
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课程老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} teacher_id 老师编号
   * @apiSuccess (basic params) {String} sort 课程老师名称
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {String} id 老师编号
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   *
   * @apiSampleRequest /api/education/course/teacher/select
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
   * @api {get} /api/education/course/teacher/view/{id} 3. 课程老师详情
   * @apiDescription 获取课程老师详情
   * @apiGroup 29. 课程老师模块
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 课程老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} teacher_id 老师编号
   * @apiSuccess (basic params) {String} sort 课程老师名称
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {String} id 老师编号
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   *
   * @apiSampleRequest /api/education/course/teacher/view/{id}
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
