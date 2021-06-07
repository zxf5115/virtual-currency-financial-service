<?php
namespace App\Http\Controllers\Api\Module\Complain\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 投诉分类控制器类
 */
class CategoryController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Complain\Relevance\Category';

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];


  /**
   * @api {get} /api/complain/category/select 01. 获取投诉分类列表(不分页)
   * @apiDescription 获取投诉分类列表(不分页)
   * @apiGroup 43. 投诉分类模块
   *
   * @apiSuccess (basic params) {Number} id 投诉分类编号
   * @apiSuccess (basic params) {String} title 投诉分类标题
   *
   * @apiSampleRequest /api/complain/category/select
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
