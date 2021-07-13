<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;
use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use Yansongda\Pay\Exceptions\GatewayException;

use App\Events\Api\Member\AssetEvent;
use App\Models\Common\Module\Member\Money;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-19
 *
 * 回调控制器类
 */
class NotifyController extends BaseController
{

  /**
   * @api {post} /api/common/notify/wechat 14. 微信支付回调
   * @apiDescription 获取微信支付回调
   * @apiGroup 02. 公共模块
   *
   * @apiSampleRequest /api/common/notify/wechat
   * @apiVersion 1.0.0
   */
  public function wechat(Request $request)
  {
    DB::beginTransaction();

    try
    {
      Log::info('微信支付回调开始 <================ 支付中');

      $config = config('pay.wechat');

      $pay = Pay::wechat($config);

      $data = $pay->verify(); // 验签

      Log::debug('微信回调参数', $data->all());

      $order_no = $data->out_trade_no;

      Log::info('订单编号====' . $order_no);

      $where = [
        'id'     => $order_no,
        'status' => 1
      ];

      $model = Money::getRow($where);

      if(empty($model->id))
      {
        return false;
      }

      $model->confirm_status = 1;
      $model->save();

      // 充值
      event(new AssetEvent($model->member_id, $model->money));

      Log::info('支付成功');

      DB::commit();

      return $pay->success()->send();
    }
    catch(\Exception $e)
    {
      DB::rollback();

      $content = '在文件 ' . $e->getFile();
      $content .= ' 的 ' . $e->getLine();
      $content .= ' 行 ' .$e->getMessage();

      Log::info('支付失败====' . $content);
    }
  }


  /**
   * @api {post} /api/common/notify/alipay 15. 支付宝支付回调
   * @apiDescription 获取支付宝支付回调
   * @apiGroup 02. 公共模块
   *
   * @apiSampleRequest /api/common/notify/alipay
   * @apiVersion 1.0.0
   */
  public function alipay(Request $request)
  {
    try
    {
      Log::info('支付宝支付回调开始 <================ 支付中');

      $config = config('pay.alipay');

      $alipay = Pay::alipay($config);

      $data = $alipay->verify(); // 验签

      Log::debug('支付宝回调参数', $data->all());

      $order_no = $data->out_trade_no;

      Log::info('订单编号====' . $order_no);

      $where = [
        'id'     => $order_no,
        'status' => 1
      ];

      $model = Money::getRow($where);

      if(empty($model->id))
      {
        return false;
      }

      $model->confirm_status = 1;
      $model->save();

      // 充值
      event(new AssetEvent($model->member_id, $model->money));

      Log::info('支付成功');

      DB::commit();

      return $alipay->success()->send();
    }
    catch(\Exception $e)
    {
      DB::rollback();

      $content = '在文件 ' . $e->getFile();
      $content .= ' 的 ' . $e->getLine();
      $content .= ' 行 ' .$e->getMessage();

      Log::info('支付失败====' . $content);
    }
  }


  /**
   * @api {post} /api/common/notify/apple 16. 苹果支付回调
   * @apiDescription 获取微信支付回调
   * @apiGroup 02. 公共模块
   *
   * @apiParam {int} order_no 订单号
   *
   * @apiSampleRequest /api/common/notify/apple
   * @apiVersion 1.0.0
   */
  public function apple(Request $request)
  {
    DB::beginTransaction();

    try
    {
      $order_no = $request->order_no;

      $where = [
        'id'     => $order_no,
        'status' => 1
      ];

      $model = Money::getRow($where);

      if(empty($model->id))
      {
        return false;
      }

      $model->confirm_status = 1;
      $model->save();

      // 充值
      event(new AssetEvent($model->member_id, $model->money));

      Log::info('支付成功');

      DB::commit();

      return self::success(Code::message(Code::HANDLE_SUCCESS));
    }
    catch(\Exception $e)
    {
      DB::rollback();

      record($e);

      return self::error(Code::HANDLE_FAILURE);
    }
  }
}
