<?php
namespace App\Http\Controllers\Api\Module\Common\Problem;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-05-28
 *
 * 购车指南分类控制器类
 */
class CategoryController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Common\Problem\Category';

  protected $_where = [];

  protected $_params = [];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [
    'problem'
  ];


  /**
   * @api {get} /api/common/problem/category/select 01. 购车指南分类数据
   * @apiDescription 获取购车指南分类不分页列表数据
   * @apiGroup 08. 购车指南分类模块
   *
   * @apiSuccess (basic params) {Number} id 购车指南分类编号
   * @apiSuccess (basic params) {String} title 购车指南分类标题
   * @apiSuccess (problem params) {String} title 购车指南标题
   * @apiSuccess (problem params) {String} content 购车指南内容
   *
   * @apiSampleRequest /api/common/problem/category/select
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
