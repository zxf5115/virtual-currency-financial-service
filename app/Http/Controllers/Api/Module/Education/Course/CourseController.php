<?php
namespace App\Http\Controllers\Api\Module\Education\Course;

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
 * 课程控制器类
 */
class CourseController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Course\Course';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title'
  ];

  // 附加关联查询条件
  protected $_addition = [
    'courseware' => [
      'status'
    ]
  ];

  // 排序
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'list' => ['courseware'],
    'list' => ['courseware'],
    'view' => [
      'detail',
      'unlock',
      'picture',
      'courseware.level'
    ]
  ];


  /**
   * @api {get} /api/education/course/list?page={page} 1. 获取课程列表(分页)
   * @apiDescription 获取课程列表(分页)
   * @apiGroup 28. 课程模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课程名称
   * @apiSuccess (basic params) {String} present 礼包信息
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课程周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSampleRequest /api/education/course/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      // 默认参数
      $request['courseware_status'] = 1;

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
   * @api {get} /api/education/course/select 2. 获取课程列表(不分页)
   * @apiDescription 获取课程列表(不分页)
   * @apiGroup 28. 课程模块
   *
   * @apiSuccess (basic params) {Number} id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课程名称
   * @apiSuccess (basic params) {String} present 礼包信息
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课程周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSampleRequest /api/education/course/select
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
   * @api {get} /api/education/course/view/{id} 3. 获取课程详情
   * @apiDescription 获取课程详情
   * @apiGroup 28. 课程模块
   *
   * @apiSuccess (basic params) {Number} id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课程名称
   * @apiSuccess (basic params) {Number} present 礼包信息
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课程周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (detail params) {String} id 课程详情编号
   * @apiSuccess (detail params) {String} content 课程内容
   * @apiSuccess (detail params) {String} plan 课程安排
   *
   * @apiSuccess (picture params) {String} picture 课程轮播图片
   *
   * @apiSampleRequest /api/education/course/view/{id}
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
