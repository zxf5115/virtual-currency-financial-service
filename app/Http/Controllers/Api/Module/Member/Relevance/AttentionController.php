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
 * 会员关注控制器类
 */
class AttentionController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Attention';

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
      'attention'
    ],
    'select' => [
      'member',
      'attention'
    ]
  ];


  /**
   * @api {get} /api/member/attention/list?page={page} 01. 会员关注列表(分页)
   * @apiDescription 获取当前会员关注列表(分页)
   * @apiGroup 19. 会员关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 会员关注编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} attention_member_id 关注会员编号
   * @apiSuccess (basic params) {Number} create_time 关注时间
   *
   * @apiSampleRequest /api/member/attention/list
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
   * @api {get} /api/member/attention/select 02. 会员关注列表(不分页)
   * @apiDescription 获取当前会员关注列表(不分页)
   * @apiGroup 19. 会员关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员关注编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} attention_member_id 关注会员编号
   * @apiSuccess (basic params) {Number} create_time 关注时间
   *
   * @apiSampleRequest /api/member/attention/select
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
   * @api {post} /api/member/attention/status 03. 是否关注会员
   * @apiDescription 获取当前会员关注的详情
   * @apiGroup 19. 会员关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} attention_member_id 关注会员编号
   *
   * @apiSuccess (basic params) {Boolean} status 是否关注
   *
   * @apiSampleRequest /api/member/attention/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'attention_member_id.required' => '请您输入关注会员编号',
    ];

    $rule = [
      'attention_member_id' => 'required',
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

        $where = ['attention_member_id' => $request->attention_member_id];

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
   * @api {post} /api/member/attention/handle 04. 关注操作
   * @apiDescription 当前会员执行关注操作, 已经关注过，再次点击取消关注
   * @apiGroup 19. 会员关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} attention_member_id 作品编号
   *
   * @apiSampleRequest /api/member/attention/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'attention_member_id.required' => '请您输入作品编号',
    ];

    $rule = [
      'attention_member_id' => 'required',
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
          'attention_member_id' => $request->attention_member_id
        ]);

        // 关注
        if(empty($model->id))
        {
          $model->save();
        }
        // 取消关注
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
