<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员消息接口控制器类
 */
class MessageController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Member\MemberMessage';

  // 附加搜索条件
  protected $_addition = [
    'message' => [
      'category_id'
    ]
  ];

  // 关联对象
  protected $_relevance = [
    'message'
  ];


  /**
   * @api {get} /api/member/message/list?page={page} 我的消息列表
   * @apiDescription 获取当前会员消息分页列表
   * @apiGroup 23. 会员消息模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} message_category_id 消息分类编号
   *
   * @apiSuccess (字段说明|会员消息) {String} id 会员消息编号
   * @apiSuccess (字段说明|会员消息) {String} create_time 消息时间
   * @apiSuccess (字段说明|消息) {String} id 消息编号
   * @apiSuccess (字段说明|消息) {String} title 消息标题
   * @apiSuccess (字段说明|消息) {String} content 消息内容
   * @apiSuccess (字段说明|消息) {String} is_finish 消息阅读状态
   *
   * @apiSampleRequest /api/member/message/list
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

      // 关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      $response = $this->_model::getPaging($condition, $relevance, $this->_order);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/member/message/finish 我的消息已阅读
   * @apiDescription 当前会员消息标记已阅读
   * @apiGroup 23. 会员消息模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} message_id 会员消息编号
   *
   * @apiSampleRequest /api/member/message/finish
   * @apiVersion 1.0.0
   */
  public function finish(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $where = [
        'id' => $request->message_id
      ];

      $condition = array_merge($condition, $where);

      // 设置为已读
      $model = $this->_model::getRow($condition);
      $model->is_finish = 1;
      $model->save();

      return self::success(Code::message(Code::HANDLE_SUCCESS));
    }
    catch(\Exception $e)
    {
      record($e);

      return self::error(Code::ERROR);
    }
  }
}
