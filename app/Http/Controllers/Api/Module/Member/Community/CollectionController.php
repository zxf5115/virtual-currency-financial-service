<?php
namespace App\Http\Controllers\Api\Module\Member\Community;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Models\Api\Module\Community;
use App\Events\Common\Push\AuroraEvent;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员收藏控制器类
 */
class CollectionController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Community\Collection';

  // 关联对像
  protected $_relevance = [
    'list' => [
      'community',
      'member',
    ]
  ];


  /**
   * @api {get} /api/member/community/collection/list?page={page} 01. 我的收藏列表
   * @apiDescription 获取当前会员收藏分页列表
   * @apiGroup 74. 社区收藏模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (字段说明|资讯) {String} id 资讯编号
   * @apiSuccess (字段说明|资讯) {String} title 资讯标题
   * @apiSuccess (字段说明|资讯) {String} picture 资讯封面
   * @apiSuccess (字段说明|资讯) {String} content 资讯内容
   * @apiSuccess (字段说明|资讯) {String} author 资讯作者
   * @apiSuccess (字段说明|资讯) {String} is_hot 是否热门
   * @apiSuccess (字段说明|资讯) {String} create_time 发布时间
   * @apiSuccess (字段说明|会员) {Number} avatar 会员头像
   * @apiSuccess (字段说明|会员) {Number} nickname 会员昵称
   *
   * @apiSampleRequest /api/member/community/collection/list
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
   * @api {post} /api/member/community/collection/status 02. 资讯是否收藏
   * @apiDescription 获取当前会员资讯收藏的详情
   * @apiGroup 74. 社区收藏模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {Number} community_id 资讯编号
   *
   * @apiSampleRequest /api/member/community/collection/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'community_id.required' => '请您输入资讯编号',
    ];

    $rule = [
      'community_id' => 'required',
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

        $where = ['community_id' => $request->community_id];

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
   * @api {post} /api/member/community/collection/handle 03. 收藏操作
   * @apiDescription 当前会员执行资讯收藏操作, 已经收藏过，再次点击取消收藏
   * @apiGroup 74. 社区收藏模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} community_id 资讯编号
   *
   * @apiSampleRequest /api/member/community/collection/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'community_id.required' => '请您输入资讯编号',
    ];

    $rule = [
      'community_id' => 'required',
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
        $status = $this->_model::createOrDelete([
          'member_id' => self::getCurrentId(),
          'community_id' => $request->community_id
        ]);

        // 社区数据
        $community = Community::getRow(['id' => $request->community_id]);

        if(!empty($community->id))
        {
          $nickname = self::getCurrentNickname();

          $data = $status ? '收藏' : '取消收藏';

          $content = $nickname . $data . '了您的' .$community->title;

          $data = [
            'title'     => '社区收藏消息',
            'content'   => $content,
          ];

          // 消息推送
          event(new AuroraEvent(1, $data, $community->member_id));
        }

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
