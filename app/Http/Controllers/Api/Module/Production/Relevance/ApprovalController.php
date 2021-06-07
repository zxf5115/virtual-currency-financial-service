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
 * 作品点赞控制器类
 */
class ApprovalController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Production\Relevance\Approval';

  protected $_where = [];

  protected $_params = [
    'course_id',
    'member_id',
  ];

  protected $_addition = [];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'member.archive',
      'production'
    ],
    'select' => [
      'member.archive',
      'production'
    ],
    'view' => [
      'member.archive',
      'production'
    ],
  ];


  /**
   * @api {get} /api/production/approval/list?page={page} 1. 获取作品点赞列表(分页)
   * @apiDescription 获取作品点赞列表(分页)
   * @apiGroup 45. 作品点赞模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} member_id 会员编号（可以为空）
   *
   * @apiSuccess (basic params) {Number} id 作品点赞编号
   * @apiSuccess (basic params) {Number} title 作品点赞名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 作品点赞宽度
   * @apiSuccess (basic params) {Number} height 作品点赞高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/production/approval/list
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
   * @api {get} /api/production/approval/select 2. 获取作品点赞列表(不分页)
   * @apiDescription 获取作品点赞列表(不分页)
   * @apiGroup 45. 作品点赞模块
   *
   * @apiParam {int} member_id 会员编号（可以为空）
   *
   * @apiSuccess (basic params) {Number} id 作品点赞编号
   * @apiSuccess (basic params) {Number} title 作品点赞名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 作品点赞宽度
   * @apiSuccess (basic params) {Number} height 作品点赞高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/production/approval/select
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


  /**
   * @api {get} /api/production/approval/view/{id} 3. 获取作品点赞详情
   * @apiDescription 获取作品点赞详情
   * @apiGroup 45. 作品点赞模块
   *
   * @apiSuccess (basic params) {Number} id 作品点赞编号
   * @apiSuccess (basic params) {Number} title 作品点赞名称
   * @apiSuccess (basic params) {String} is_open 是否开启 1 开启 2 未开启
   * @apiSuccess (basic params) {String} width 作品点赞宽度
   * @apiSuccess (basic params) {Number} height 作品点赞高度
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/production/approval/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

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
