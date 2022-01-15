<?php
namespace App\Http\Controllers\Api\Module;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 通知接口控制器类
 */
class NoticeController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Notice';

  // 附加搜索条件
  protected $_addition = [];

  // 关联对象
  protected $_relevance = [
    'category'
  ];


  /**
   * @api {get} /api/notice/list?page={page} 我的通知列表
   * @apiDescription 获取当前会员通知分页列表
   * @apiGroup 11. 通知模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (字段说明) {String} id 通知编号
   * @apiSuccess (字段说明) {String} content 通知内容
   * @apiSuccess (字段说明) {String} create_time 通知时间
   *
   * @apiSampleRequest /api/notice/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

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
}
