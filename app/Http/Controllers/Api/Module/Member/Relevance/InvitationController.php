<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 会员邀请控制器类
 */
class InvitationController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Invitation';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序条件
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联对像
  protected $_relevance = [
    'list' => [
      'member',
      'invitation'
    ],
    'select' => [
      'member',
      'invitation'
    ]
  ];


  /**
   * @api {get} /api/member/invitation/list?page={page} 01. 会员邀请列表(分页)
   * @apiDescription 获取当前会员邀请列表(分页)
   * @apiGroup 30. 会员邀请模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 会员邀请编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} invitation_member_id 邀请会员编号
   * @apiSuccess (basic params) {Number} create_time 邀请时间
   *
   * @apiSampleRequest /api/member/invitation/list
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
   * @api {get} /api/member/invitation/select 02. 会员邀请列表(不分页)
   * @apiDescription 获取当前会员邀请列表(不分页)
   * @apiGroup 30. 会员邀请模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员邀请编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} invitation_member_id 邀请会员编号
   * @apiSuccess (basic params) {Number} create_time 邀请时间
   *
   * @apiSampleRequest /api/member/invitation/select
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
   * @api {post} /api/member/invitation/status 03. 是否邀请会员
   * @apiDescription 获取当前会员邀请的详情
   * @apiGroup 30. 会员邀请模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} invitation_member_id 邀请会员编号
   *
   * @apiSuccess (basic params) {Boolean} status 是否邀请
   *
   * @apiSampleRequest /api/member/invitation/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'invitation_member_id.required' => '请您输入邀请会员编号',
    ];

    $rule = [
      'invitation_member_id' => 'required',
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

        $where = ['invitation_member_id' => $request->invitation_member_id];

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
   * @api {post} /api/member/invitation/handle 04. 邀请操作
   * @apiDescription 当前会员执行邀请操作, 已经邀请过，再次点击取消邀请
   * @apiGroup 30. 会员邀请模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} invitation_member_id 作品编号
   *
   * @apiSampleRequest /api/member/invitation/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'invitation_member_id.required' => '请您输入作品编号',
    ];

    $rule = [
      'invitation_member_id' => 'required',
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
        $model = $this->_model::firstOrNew([
          'member_id'           => self::getCurrentId(),
          'invitation_member_id' => $request->invitation_member_id
        ]);

        // 邀请
        if(empty($model->id))
        {
          $model->save();
        }
        // 取消邀请
        else
        {
          $model->delete();
        }

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
