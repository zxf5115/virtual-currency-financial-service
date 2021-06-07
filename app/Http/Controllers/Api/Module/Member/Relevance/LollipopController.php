<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Events\Api\Member\LollipopEvent;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员棒棒糖控制器类
 */
class LollipopController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Lollipop';

  protected $_where = [];

  protected $_params = [
    'type'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/lollipop/list?page={page} 01. 会员帮帮糖列表(分页)
   * @apiDescription 获取当前会员的帮帮糖列表(分页)
   * @apiGroup 05. 会员棒棒糖模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} type 棒棒糖类型 1:获取 2:消费
   *
   * @apiSuccess (basic params) {Number} id 棒棒糖编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} type 棒棒糖类型 1: 获取 2: 消费
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {String} content 棒棒糖描述
   * @apiSuccess (basic params) {Number} number 棒棒糖数量
   * @apiSuccess (basic params) {Number} create_time 获取时间|消费时间
   *
   * @apiSampleRequest /api/member/lollipop/list
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
      $relevance = self::getRelevanceData($this->_relevance, 'select');

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
   * @api {get} /api/member/lollipop/select 02. 会员帮帮糖列表(不分页)
   * @apiDescription 获取当前会员的帮帮糖列表(不分页)
   * @apiGroup 05. 会员棒棒糖模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} type 棒棒糖类型 1:获取 2:消费
   *
   * @apiSuccess (basic params) {Number} id 棒棒糖编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} type 棒棒糖类型 1: 获取 2: 消费
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {String} content 棒棒糖描述
   * @apiSuccess (basic params) {Number} number 棒棒糖数量
   * @apiSuccess (basic params) {Number} create_time 获取时间|消费时间
   *
   * @apiSampleRequest /api/member/lollipop/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
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
   * @api {post} /api/member/lollipop/status 03. 是否领取了棒棒糖
   * @apiDescription 获取当前会员是否领取了棒棒糖
   * @apiGroup 05. 会员棒棒糖模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} data true|false
   *
   * @apiSampleRequest /api/member/lollipop/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'unit_id.required'       => '请您输入课件单元编号',
    ];

    $rule = [
      'course_id'     => 'required',
      'unit_id'       => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $response = false;

        $condition = self::getCurrentWhereData();

        $where = [
          'course_id'     => $request->course_id,
          'unit_id'       => $request->unit_id,
        ];

        $condition = array_merge($condition, $where);

        $result = $this->_model::getRow($condition);

        if(!empty($result))
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
  }



  /**
   * @api {post} /api/member/lollipop/receive 04. 领取棒棒糖
   * @apiDescription 当前会员领取棒棒糖
   * @apiGroup 05. 会员棒棒糖模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} data true|false
   *
   * @apiSampleRequest /api/member/lollipop/receive
   * @apiVersion 1.0.0
   */
  public function receive(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'unit_id.required'       => '请您输入课件单元编号',
    ];

    $rule = [
      'course_id'     => 'required',
      'unit_id'       => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        // 领取棒棒糖
        event(new LollipopEvent($request->course_id, $request->unit_id, 1, 1));

        return self::success(Code::message(Code::SUCCESS));
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::ERROR);
      }
    }
  }
}
