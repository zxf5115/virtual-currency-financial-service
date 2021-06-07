<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance\Relevance\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Member\Course\UnitFinishEvent;
use App\Events\Api\Member\Course\Unit\Point\UnlockEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-04
 *
 * 会员课程单元知识点控制器类
 */
class Point2Controller extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Relevance\Relevance\Point';

  protected $_where = [];

  protected $_params = [
    'is_finish',
    'course_id',
    'courseware_id',
    'level_id',
    'unit_id'
  ];

  protected $_addition = [
    'point' => [
      'status'
    ]
  ];

  protected $_order = [];

  protected $_relevance = [
    'list' => [
      'point',
    ],
    'select' => [
      'point',
    ],
    'view' => [
      'point',
    ]
  ];


  /**
   * @api {get} /api/member/course/unit/point/list?page={page} 01. 会员课程知识点列表(分页)
   * @apiDescription 获取当前会员订阅的课程列表(分页)
   * @apiGroup 36. 会员课程知识点模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课程单元编号
   *
   * @apiSuccess (basic params) {Number} id 学员课程单元知识点编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} point_id 课件单元知识点编号
   * @apiSuccess (basic params) {Number} is_unlock 是否解锁 0 未解锁 1 已解锁
   * @apiSuccess (basic params) {Number} unlock_time 解锁时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (point params) {Number} id 课程单元知识点编号
   * @apiSuccess (point params) {Number} courseware_id 课件编号
   * @apiSuccess (point params) {Number} level_id 课件级别编号
   * @apiSuccess (point params) {Number} unit_id 课件级别单元编号
   * @apiSuccess (point params) {Number} title 课件单元知识点名称
   * @apiSuccess (point params) {Number} picture 课程单元知识点图片
   * @apiSuccess (point params) {Number} url 课程单元知识点资源地址
   * @apiSuccess (point params) {String} sort 排序
   * @apiSuccess (point params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/unit/point/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

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
   * @api {get} /api/member/course/unit/point/select 02. 会员课程知识点列表(不分页)
   * @apiDescription 获取当前会员订阅的课程知识点列表(不分页)
   * @apiGroup 36. 会员课程知识点模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课程单元编号
   *
   * @apiSuccess (basic params) {Number} id 学员课程单元知识点编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} point_id 课件单元知识点编号
   * @apiSuccess (basic params) {Number} is_unlock 是否解锁 0 未解锁 1 已解锁
   * @apiSuccess (basic params) {Number} unlock_time 解锁时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (point params) {Number} id 课程单元知识点编号
   * @apiSuccess (point params) {Number} courseware_id 课件编号
   * @apiSuccess (point params) {Number} level_id 课件级别编号
   * @apiSuccess (point params) {Number} unit_id 课件级别单元编号
   * @apiSuccess (point params) {Number} title 课件单元知识点名称
   * @apiSuccess (point params) {Number} picture 课程单元知识点图片
   * @apiSuccess (point params) {Number} url 课程单元知识点资源地址
   * @apiSuccess (point params) {String} sort 排序
   * @apiSuccess (point params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/unit/point/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $request['point_status'] = 1;

      $condition = self::getCurrentWhereData();

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
   * @api {get} /api/member/course/unit/point/view/{id} 03. 当前会员课程知识点详情
   * @apiDescription 获取当前会员课程知识点详情
   * @apiGroup 36. 会员课程知识点模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 学员课程单元知识点编号
   *
   * @apiSuccess (basic params) {Number} id 学员课程单元知识点编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} unit_id 课件单元编号
   * @apiSuccess (basic params) {Number} point_id 课件单元知识点编号
   * @apiSuccess (basic params) {Number} is_unlock 是否解锁 0 未解锁 1 已解锁
   * @apiSuccess (basic params) {Number} unlock_time 解锁时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (point params) {Number} id 课程单元知识点编号
   * @apiSuccess (point params) {Number} courseware_id 课件编号
   * @apiSuccess (point params) {Number} level_id 课件级别编号
   * @apiSuccess (point params) {Number} unit_id 课件级别单元编号
   * @apiSuccess (point params) {Number} title 课件单元知识点名称
   * @apiSuccess (point params) {Number} picture 课程单元知识点图片
   * @apiSuccess (point params) {Number} url 课程单元知识点资源地址
   * @apiSuccess (point params) {String} sort 排序
   * @apiSuccess (point params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/unit/point/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

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
   * @api {get} /api/member/course/unit/point/status/{id} 04. 当前课程知识点是否完成
   * @apiDescription 获取当前课程知识点是否完成
   * @apiGroup 36. 会员课程知识点模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 学员课程单元知识点编号
   *
   * @apiSuccess (basic params) {Boolean} true|false 是否完成
   *
   * @apiSampleRequest /api/member/course/unit/point/status/{id}
   * @apiVersion 1.0.0
   */
  public function status(Request $request, $id)
  {
    try
    {
      $response = false;

      $condition = self::getCurrentWhereData();

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition);

      if(!empty($result) && 1 == $result['is_finish']['value'])
      {
        $response = true;
      }

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
   * @api {post} /api/member/course/unit/point/finish 05. 完成课程知识点
   * @apiDescription 当前会员学习完成了课程知识点
   * @apiGroup 36. 会员课程知识点模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} id 学员课程单元知识点编号
   *
   * @apiSampleRequest /api/member/course/unit/point/finish
   * @apiVersion 1.0.0
   */
  public function finish(Request $request)
  {
    $messages = [
      'id.required' => '请您输入课程知识点编号'
    ];

    $rule = [
      'id' => 'required'
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        if(empty($model))
        {
          return self::error(Code::COURSE_POINT_EMPTY);
        }

        if(1 == $model->is_finish['value'])
        {
          return self::error(Code::COURSE_POINT_FINISH);
        }

        $model->is_finish = 1;

        $response = $model->save();

        // 完成课程单元学习
        event(new UnitFinishEvent($model));

        // 解锁课程单元知识点
        event(new UnlockEvent($request->all()));

        DB::commit();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        DB::rollback();

        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
