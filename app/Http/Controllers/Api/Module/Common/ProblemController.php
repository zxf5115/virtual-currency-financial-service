<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-22
 *
 * 常见问题控制器类
 */
class ProblemController extends BaseController
{
  protected $_model = 'App\Models\Common\Module\Common\Problem';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/common/problem/list?page={page} 1. 获取常见问题列表(分页)
   * @apiDescription 获取常见问题列表(分页)
   * @apiGroup 46. 常见问题模块
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 常见问题编号
   * @apiSuccess (basic params) {String} title 常见问题标题
   * @apiSuccess (basic params) {Number} position_id 常见问题位编号
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/common/problem/list
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
   * @api {get} /api/common/problem/select 2. 获取常见问题列表(不分页)
   * @apiDescription 获取常见问题列表(不分页)
   * @apiGroup 46. 常见问题模块
   *
   * @apiSuccess (basic params) {Number} id 常见问题编号
   * @apiSuccess (basic params) {String} title 常见问题标题
   * @apiSuccess (basic params) {String} content 常见问题答案
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/common/problem/select
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
   * @api {get} /api/common/problem/view/{id} 3. 获取常见问题详情
   * @apiDescription 获取常见问题详情
   * @apiGroup 46. 常见问题模块
   *
   * @apiSuccess (basic params) {Number} id 常见问题编号
   * @apiSuccess (basic params) {String} title 常见问题标题
   * @apiSuccess (basic params) {String} content 常见问题答案
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/common/problem/view/{id}
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
