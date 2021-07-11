<?php
namespace App\Http\Controllers\Api\Module;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Information\BrowseEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 资讯控制器类
 */
class InformationController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Information';

  // 默认查询条件
  protected $_where = [
    'audit_status' => 1
  ];

  // 客户端搜索字段
  protected $_params = [
    'category_id'
  ];


  // 附加搜索条件
  protected $_addition = [
    'labelRelevance' => [
      'label_id'
    ]
  ];


  // 关联对象
  protected $_relevance = [
    'list' => false,
    'related' => [
      'labelRelevance'
    ],
    'view' => [
      'label'
    ],
  ];


  /**
   * @api {get} /api/information/list?page={page} 01. 资讯列表
   * @apiDescription 获取资讯分页列表
   * @apiGroup 61. 资讯模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} category_id 分类编号
   *
   * @apiSuccess (字段说明) {Number} id 资讯编号
   * @apiSuccess (字段说明) {String} title 资讯标题
   * @apiSuccess (字段说明) {String} picture 资讯封面
   * @apiSuccess (字段说明) {String} content 资讯内容
   * @apiSuccess (字段说明) {String} source 资讯来源
   * @apiSuccess (字段说明) {String} author 资讯作者
   * @apiSuccess (字段说明) {String} read_total 阅读总数
   * @apiSuccess (字段说明) {String} is_top 是否置顶
   * @apiSuccess (字段说明) {String} is_recommend 是否推荐
   * @apiSuccess (字段说明) {String} is_comment 是否可以评论
   * @apiSuccess (字段说明) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/information/list
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
   * @api {get} /api/information/recommend?page={page} 02. 推荐资讯列表
   * @apiDescription 获取推荐资讯分页列表
   * @apiGroup 61. 资讯模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (字段说明) {Number} id 资讯编号
   * @apiSuccess (字段说明) {String} title 资讯标题
   * @apiSuccess (字段说明) {String} picture 资讯封面
   * @apiSuccess (字段说明) {String} content 资讯内容
   * @apiSuccess (字段说明) {String} source 资讯来源
   * @apiSuccess (字段说明) {String} author 资讯作者
   * @apiSuccess (字段说明) {String} read_total 阅读总数
   * @apiSuccess (字段说明) {String} is_top 是否置顶
   * @apiSuccess (字段说明) {String} is_recommend 是否推荐
   * @apiSuccess (字段说明) {String} is_comment 是否可以评论
   * @apiSuccess (字段说明) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/information/recommend
   * @apiVersion 1.0.0
   */
  public function recommend(Request $request)
  {
    try
    {
      $where = [
        'is_recommend' => 1
      ];

      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter, $where);

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
   * @api {get} /api/information/related?page={page} 03. 相关资讯列表
   * @apiDescription 获取相关资讯分页列表
   * @apiGroup 61. 资讯模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} label_id 标签编号
   *
   * @apiSuccess (字段说明) {Number} id 资讯编号
   * @apiSuccess (字段说明) {String} title 资讯标题
   * @apiSuccess (字段说明) {String} content 资讯内容
   * @apiSuccess (字段说明) {String} source 资讯来源
   * @apiSuccess (字段说明) {String} author 资讯作者
   * @apiSuccess (字段说明) {String} read_total 阅读总数
   * @apiSuccess (字段说明) {String} is_top 是否置顶
   * @apiSuccess (字段说明) {String} is_recommend 是否推荐
   * @apiSuccess (字段说明) {String} is_comment 是否可以评论
   * @apiSuccess (字段说明) {String} create_time 发布时间
   *
   * @apiSampleRequest /api/information/related
   * @apiVersion 1.0.0
   */
  public function related(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'related');

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
   * @api {get} /api/information/view/{id} 04. 资讯详情
   * @apiDescription 获取资讯详情
   * @apiGroup 61. 资讯模块
   *
   * @apiSuccess (字段说明|资讯) {Number} id 资讯编号
   * @apiSuccess (字段说明|资讯) {String} title 资讯标题
   * @apiSuccess (字段说明|资讯) {String} picture 资讯封面
   * @apiSuccess (字段说明|资讯) {String} content 资讯内容
   * @apiSuccess (字段说明|资讯) {String} source 资讯来源
   * @apiSuccess (字段说明|资讯) {String} author 资讯作者
   * @apiSuccess (字段说明|资讯) {String} read_total 阅读总数
   * @apiSuccess (字段说明|资讯) {String} is_top 是否置顶
   * @apiSuccess (字段说明|资讯) {String} is_recommend 是否推荐
   * @apiSuccess (字段说明|资讯) {String} is_comment 是否可以评论
   * @apiSuccess (字段说明|资讯) {String} create_time 发布时间
   * @apiSuccess (字段说明|标签) {String} title 标签名字
   *
   * @apiSampleRequest /api/information/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    DB::beginTransaction();

    try
    {
      $condition = self::getSimpleWhereData($id);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

      // 记录资讯浏览总数
      event(new BrowseEvent($id));

      DB::commit();

      return self::success($response);
    }
    catch(\Exception $e)
    {
      DB::rollback();

      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
