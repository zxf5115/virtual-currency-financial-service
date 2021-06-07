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
 * @dateTime 2020-12-30
 *
 * 联系客服控制器类
 */
class ServiceController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 9
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/common/service/data 11. 客服联系方式
   * @apiDescription 获取客服联系方式
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} service_mobile 客服电话
   * @apiSuccess (basic params) {String} service_wechat 客服微信号
   * @apiSuccess (basic params) {Number} service_qrcode 客服微信二维码
   *
   * @apiSampleRequest /api/common/service/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($this->_where, $filter);

      $response = $this->_model::getPluck(['value', 'title'], $condition);

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
