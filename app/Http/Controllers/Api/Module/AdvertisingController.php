<?php
namespace App\Http\Controllers\Api\Module;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-27
 *
 * 广告控制器类
 */
class AdvertisingController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Advertising';

  // 客户端搜索字段
  protected $_params = [
    'position_id',
  ];

  // 排序方式
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];


  /**
   * @api {get} /api/advertising/select 01. 广告数据
   * @apiDescription 获取广告不分页列表
   * @apiGroup 05. 广告模块
   *
   * @apiParam {int} position_id 广告位编号
   * @apiParam {int} total 显示广告数量，默认显示5条
   *
   * @apiSuccess (basic params) {String} title 广告标题
   * @apiSuccess (basic params) {String} picture 广告图片
   * @apiSuccess (basic params) {String} link 广告链接
   *
   * @apiSampleRequest /api/advertising/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $total = $request->total ?? 5;

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order, false, false, $total);

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
