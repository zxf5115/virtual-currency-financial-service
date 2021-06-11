<?php
namespace App\Http\Controllers\Api\Module\Flash;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-08
 *
 * 快讯评论控制器类
 */
class CommentController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Flash\Comment';

  // 关联对像
  protected $_relevance = [
    'select' => [
      'member',
      'bemember'
    ]
  ];


  /**
   * @api {get} /api/flash/comment/select 01. 快讯评论数据
   * @apiDescription 获取快讯评论不分页列表数据
   * @apiGroup 52. 快讯评论模块
   *
   * @apiParam {string} flash_id 快讯编号
   *
   * @apiSuccess (字段说明|评论) {String} content 评论内容
   * @apiSuccess (字段说明|评论) {String} create_time 评论时间
   * @apiSuccess (字段说明|评论人) {String} avatar 评论人头像
   * @apiSuccess (字段说明|评论人) {String} nickname 评论人昵称
   * @apiSuccess (字段说明|被评论人) {String} avatar 被评论人头像
   * @apiSuccess (字段说明|被评论人) {String} nickname 被评论人昵称
   *
   * @apiSampleRequest /api/flash/comment/select
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
}
