<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Api\System\Config;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 202105-19
 *
 * 支付控制器类
 */
class PayController extends BaseController
{
  /**
   * @api {post} /api/common/pay/data 15. 支付类型
   * @apiDescription 获取支付类型
   * @apiGroup 02. 公共模块
   *
   * @apiSampleRequest /api/common/pay/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      $response = Config::getConfigValue('pay_type');

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
