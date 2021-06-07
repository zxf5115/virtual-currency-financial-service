<?php
namespace App\Http\Controllers\Api\Module\Education\Courseware;

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
class CoursewareController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Courseware\Courseware';

  // 默认查询条件
  protected $_where = [
    'status' => 1,
  ];

  // 查询条件
  protected $_params = [
    'title'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    // 'index' => [
    //   'course'
    // ]
  ];


  /**
   * @api {get} /api/education/courseware/list?page={page} 1. 获取课件列表(分页)
   * @apiDescription 获取课件列表(分页)
   * @apiGroup 24. 课件模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 课件编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} present_id 礼包编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课件名称
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课件周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (present params) {String} id 礼包编号
   * @apiSuccess (present params) {String} title 礼包名称
   * @apiSuccess (present params) {String} description 礼包描述
   *
   * @apiSampleRequest /api/courseware/list
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
   * @api {get} /api/education/courseware/select 2. 获取课件列表(不分页)
   * @apiDescription 获取课件列表(不分页)
   * @apiGroup 24. 课件模块
   *
   * @apiSuccess (basic params) {Number} id 课件编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} present_id 礼包编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课件名称
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课件周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (present params) {String} id 礼包编号
   * @apiSuccess (present params) {String} title 礼包名称
   * @apiSuccess (present params) {String} description 礼包描述
   *
   * @apiSampleRequest /api/education/courseware/select
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
   * @api {get} /api/education/courseware/view/{id} 3. 获取课件详情
   * @apiDescription 获取课件详情
   * @apiGroup 24. 课件模块
   *
   * @apiSuccess (basic params) {Number} id 课件编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} present_id 礼包编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课件名称
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课件周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (detail params) {String} id 课件详情编号
   * @apiSuccess (detail params) {String} content 课件内容
   * @apiSuccess (detail params) {String} plan 课件安排
   *
   * @apiSuccess (present params) {String} id 礼包编号
   * @apiSuccess (present params) {String} title 礼包名称
   * @apiSuccess (present params) {String} description 礼包描述
   *
   * @apiSampleRequest /api/education/courseware/view/{id}
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
   * @api {get} /api/education/courseware/index 4. 获取课件列表(不分页，关联查询)
   * @apiDescription 获取课件列表(不分页，关联查询)
   * @apiGroup 24. 课件模块
   *
   * @apiSuccess (basic params) {Number} id 课件编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} present_id 礼包编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课件名称
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课件周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (present params) {String} id 礼包编号
   * @apiSuccess (present params) {String} title 礼包名称
   * @apiSuccess (present params) {String} description 礼包描述
   *
   * @apiSampleRequest /api/education/courseware/index
   * @apiVersion 1.0.0
   */
  public function index(Request $request)
  {
    try
    {
// DB::connection()->enableQueryLog();#开启执行日志
      $response = $this->_model::with('course')->where(['status' => 1, 'is_permanent' => 1])->whereHasIn('course', function($query) {
          $query->where(['status' => 1]);
        })->whereRaw('(is_permanent = 2 and start_time <= '. time() .' and end_time >= '.time().')', [], 'or')->orderBy('sort', 'desc')->get();

// dd(DB::getQueryLog()); //获取查询语句、参数和执行时间


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
