<?php
namespace App\Http\Controllers\Api\Module\Production\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品评论控制器类
 */
class CommentController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Production\Relevance\Comment';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id',
    'production_id',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序条件
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联对像
  protected $_relevance = [
    'list' => [
      'member'
    ],
    'select' => [
      'member'
    ]
  ];


  /**
   * @api {get} /api/production/comment/list?page={page} 1. 作品评论位列表(分页)
   * @apiDescription 获取作品评论位列表(分页)
   * @apiGroup 23. 作品评论模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} production_id 作品编号
   *
   * @apiSuccess (basic params) {Number} id 作品评论位编号
   * @apiSuccess (basic params) {Number} suffix 作品评论类型 1 文本内容 2 音频内容
   * @apiSuccess (basic params) {String} content 评论内容
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {String} create_time 评论时间
   *
   * @apiSuccess (member params) {String} id 会员编号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} nickname 会员昵称
   *
   * @apiSampleRequest /api/production/comment/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

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
   * @api {get} /api/production/comment/select 2. 作品评论位列表(不分页)
   * @apiDescription 获取作品评论位列表(不分页)
   * @apiGroup 23. 作品评论模块
   *
   * @apiParam {int} production_id 作品编号
   *
   * @apiSuccess (basic params) {Number} id 作品评论位编号
   * @apiSuccess (basic params) {Number} suffix 作品评论类型 1 文本内容 2 音频内容
   * @apiSuccess (basic params) {String} content 评论内容
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {String} create_time 评论时间
   *
   * @apiSuccess (member params) {String} id 会员编号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} nickname 会员昵称
   *
   * @apiSampleRequest /api/production/comment/select
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
