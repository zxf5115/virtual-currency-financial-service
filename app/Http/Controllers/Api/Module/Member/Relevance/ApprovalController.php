<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Member\Production\ApprovalEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-25
 *
 * 会员点赞控制器类
 */
class ApprovalController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Approval';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/approval/list?page={page} 01. 会员点赞列表(分页)
   * @apiDescription 获取当前会员点赞列表(分页)
   * @apiGroup 09. 会员点赞模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 会员点赞编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} production_id 作品编号
   * @apiSuccess (basic params) {Number} create_time 点赞时间
   *
   * @apiSampleRequest /api/member/approval/list
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
   * @api {get} /api/member/approval/select 02. 会员点赞列表(不分页)
   * @apiDescription 获取当前会员点赞列表(不分页)
   * @apiGroup 09. 会员点赞模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员点赞编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} production_id 作品编号
   * @apiSuccess (basic params) {Number} create_time 点赞时间
   *
   * @apiSampleRequest /api/member/approval/select
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
   * @api {post} /api/member/approval/status 03. 作品是否点赞
   * @apiDescription 获取当前会员点赞的详情
   * @apiGroup 09. 会员点赞模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} production_id 作品编号
   *
   * @apiSampleRequest /api/member/approval/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'production_id.required' => '请您输入作品编号',
    ];

    $rule = [
      'production_id' => 'required',
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
        $status = true;

        $condition = self::getCurrentWhereData();

        $where = ['production_id' => $request->production_id];

        $condition = array_merge($condition, $where);

        $response = $this->_model::getRow($condition);

        if(empty($response->id))
        {
          $status = false;
        }

        return self::success($status);
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
   * @api {post} /api/member/approval/handle 04. 点赞操作
   * @apiDescription 当前会员执行点赞操作, 已经点赞过，再次点击取消点赞
   * @apiGroup 09. 会员点赞模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} production_id 作品编号
   *
   * @apiSampleRequest /api/member/approval/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'production_id.required' => '请您输入作品编号',
    ];

    $rule = [
      'course_id'     => 'required',
      'production_id' => 'required',
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
        $model = $this->_model::firstOrNew([
          'member_id' => self::getCurrentId(),
          'course_id' => $request->course_id,
          'production_id' => $request->production_id
        ]);

        $type = 1;

        // 点赞
        if(empty($model->id))
        {
          $model->save();
        }
        // 取消点赞
        else
        {
          $type = 2;

          $model->delete();
        }

        // 记录点赞作品总数
        event(new ApprovalEvent($type, $request->production_id));

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
