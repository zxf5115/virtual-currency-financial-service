<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Models\Api\Module\Member;
use App\Events\Common\Push\AuroraEvent;
use App\Events\Api\Member\AttentionEvent;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员粉丝控制器类
 */
class FansController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Member\Attention';

  // 排序条件
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联对像
  protected $_relevance = [
    'list' => [
      'member',
    ],
    'select' => [
      'member',
    ]
  ];


  /**
   * @api {get} /api/member/fans/list?page={page} 01. 会员粉丝列表
   * @apiDescription 获取当前会员粉丝分页列表
   * @apiGroup 37. 会员粉丝模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (字段说明|基础) {Number} id 会员粉丝编号
   * @apiSuccess (字段说明|基础) {Number} member_id 粉丝会员编号
   * @apiSuccess (字段说明|基础) {Number} attention_member_id 会员编号
   * @apiSuccess (字段说明|基础) {Number} create_time 粉丝时间
   * @apiSuccess (字段说明|粉丝人) {Number} avatar 头像
   * @apiSuccess (字段说明|粉丝人) {Number} nickname 昵称
   * @apiSuccess (字段说明|被粉丝人) {Number} avatar 头像
   * @apiSuccess (字段说明|被粉丝人) {Number} nickname 昵称
   *
   * @apiSampleRequest /api/member/fans/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('attention_member_id');

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
}
