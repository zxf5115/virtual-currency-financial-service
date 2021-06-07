<?php
namespace App\Listeners\Api\Member\Order;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Events\Api\Member\Order\PayEvent;
use Yansongda\Pay\Exceptions\GatewayException;

/**
 * 支付监听器
 */
class PayListeners
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
      //
  }

  /**
   * Handle the event.
   *
   * @param  PayEvent  $event
   * @return void
   */
  public function handle(PayEvent $event)
  {
    try
    {
      $response = null;

      // 订单信息
      $order = $event->order;

      // h5支付
      $is_h5 = $event->is_h5;

      if(empty($order))
      {
        return false;
      }

      $type = $order->pay_type['value'];

      // 微信支付
      if(2 == $type)
      {
        $response = $this->wechat($order, $is_h5);
      }
      // 支付宝支付
      else if(1 == $type)
      {
        $response = $this->alipay($order, $is_h5);
      }

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 微信支付
   * ------------------------------------------
   *
   * 微信支付
   *
   * @return [type]
   */
  private function wechat($order, $is_h5 = false)
  {
    try
    {
      $pay_money = intval(bcmul($order->pay_money, 100));

      $data = [
        'out_trade_no' => $order->order_no,
        'body'         => '订单支付',
        'total_fee'    => $pay_money
      ];

      $config  = config('pay.wechat');

      // 如果是H5支付
      if($is_h5)
      {
        $data['openid'] = auth('api')->user()->public_id;

        $result = Pay::wechat($config)->mp($data);

        $response = $result;
      }
      else
      {
        $result = Pay::wechat($config)->app($data);

        $content = $result->getContent() ?? '';

        $response = json_decode($content, true) ?? [];
      }

      return $response;
    }
    catch (GatewayException $e)
    {
      Log::info(date("H:i:s") . " 订单{order['out_trade_no']}");

      if (strpos($e->getMessage(), 'OK该订单已支付') === false)
      {
        // 不是已支付订单
        Log::error($e->getMessage());
      }
      else
      {
        // 订单已支付消息;
      }
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 支付宝支付
   * ------------------------------------------
   *
   * 支付宝支付
   *
   * @return [type]
   */
  private function alipay($order, $is_h5 = false)
  {
    try
    {
      $data = [
        'out_trade_no' => $order->order_no,
        'subject'      => '订单支付',
        'total_amount' => $order->pay_money
      ];

      $config  = config('pay.alipay');

      // 如果是H5支付
      if($is_h5)
      {
        $result = Pay::alipay($config)->wap($data);

        $response = $result->getContent() ?? '';
      }
      else
      {
        $result = Pay::alipay($config)->app($data);

        $response = $result->getContent() ?? '';
      }

      return $response;
    }
    catch (GatewayException $e)
    {
      Log::info(date("H:i:s") . " 订单{order['out_trade_no']}");

      if (strpos($e->getMessage(), 'OK该订单已支付') === false)
      {
        // 不是已支付订单
        Log::error($e->getMessage());
      }
      else
      {
        // 订单已支付消息;
      }
    }
  }
}
