<?php
namespace App\Http\Controllers\Api\Module\Common;

use Flex\Express\Express100;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Models\Common\Module\Order\Goods;
use App\Models\Common\Module\Order\Course;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 快递控制器类
 */
class ExpressController extends BaseController
{

  /**
   * @api {post} /api/common/express/data 10. 快递查询
   * @apiDescription 根据快递单号查询快递信息
   * @apiGroup 02. 公共模块
   *
   * @apiParam {int} type 订单类型 1 课程订单 2 商品订单
   * @apiParam {int} order_id 订单号
   * @apiParam {int} express_no 物流单号
   * @apiParam {string} company_code 物流公司编号
   *
   * @apiSampleRequest /api/common/express/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      $type         = $request->type;
      $order_id     = $request->order_id;
      $express_no   = $request->express_no;
      $company_code = $request->company_code;

      $where = self::getSimpleWhereData($order_id);

      if(1 == $type)
      {
        $model = Course::getRow($where, 'address');
      }
      else
      {
        $model = Goods::getRow($where, 'address');
      }

      if(empty($model) || empty($model->address))
      {
        return self::error(Code::ERROR);
      }

      $phone = $model->address->mobile;

      $additional = ['phone' => $phone];

      $response = app('express')->track($express_no, $company_code, $additional);

      $response = json_decode($response);

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
