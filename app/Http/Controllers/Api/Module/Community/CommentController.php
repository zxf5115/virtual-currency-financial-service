<?php
namespace App\Http\Controllers\Api\Module\Community;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-22
 *
 * 社区评论控制器类
 */
class CommentController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Community\Comment';

  // 默认查询条件
  protected $_where = [
    'parent_id' => 0
  ];

  // 客户端搜索字段
  protected $_params = [
    'community_id',
  ];

  // 关联对像
  protected $_relevance = [
    'select' => [
      'children.member',
      'member',
    ]
  ];


  /**
   * @api {get} /api/community/comment/select 01. 社区评论数据
   * @apiDescription 获取社区评论不分页列表数据
   * @apiGroup 72. 社区评论模块
   *
   * @apiParam {string} community_id 社区编号
   *
   * @apiSuccess (字段说明|评论) {String} content 评论内容
   * @apiSuccess (字段说明|评论) {String} create_time 评论时间
   * @apiSuccess (字段说明|评论人) {String} avatar 评论人头像
   * @apiSuccess (字段说明|评论人) {String} nickname 评论人昵称
   * @apiSuccess (字段说明|被评论人) {String} avatar 被评论人头像
   * @apiSuccess (字段说明|被评论人) {String} nickname 被评论人昵称
   *
   * @apiSampleRequest /api/community/comment/select
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
