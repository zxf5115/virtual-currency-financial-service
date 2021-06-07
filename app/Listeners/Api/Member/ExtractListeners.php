<?php
namespace App\Listeners\Api\Member;

use App\Events\Api\Member\ExtractEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Events\Api\Member\Order\PayEvent;
use Yansongda\Pay\Exceptions\GatewayException;
use App\Models\Api\Module\Member\Relevance\Account;

/**
 * 提现听器
 */
class ExtractListeners
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
   * @param  ExtractEvent  $event
   * @return void
   */
  public function handle(ExtractEvent $event)
  {
    try
    {
      // 提现订单
      $order = $event->order;

      if(empty($order))
      {
        \Log::error('提现订单不存在');

        return false;
      }

      $account = Account::getRow(['member_id' => $order->member_id]);

      if(empty($account))
      {
        \Log::error('提现账户不存在');

        return false;
      }

      // 提现账户
      $payment_account = $account->payment_account;

      // 提现姓名
      $payment_name = $account->payment_name;

      $response = $this->transfer($order, $payment_account, $payment_name);

      return $response;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      throw new \Exception("提现失败");
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 支付宝提现
   * ------------------------------------------
   *
   * 支付宝提现
   *
   * @return [type]
   */
  private function transfer($order, $payment_account, $payment_name)
  {
    try
    {
      $data = [
        'out_biz_no'   => time(),
        'trans_amount' => $order->money,
        'product_code' => 'TRANS_ACCOUNT_NO_PWD',
        'biz_scene'    => 'DIRECT_TRANSFER',
        'payee_info'   => [
          'identity_type' => 'ALIPAY_LOGON_ID',
          'identity'      => $payment_account,
          'name'          => $payment_name
        ]
      ];

      $config  = config('pay.alipay');

      $result = Pay::alipay($config)->transfer($data);

      $code = $result->code;

      if(10000 == $code)
      {
        return true;
      }

      return false;
    }
    catch (GatewayException $e)
    {
      Log::info(date("H:i:s") . " 订单{order['out_trade_no']}");

      throw new \Exception("提现失败");

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
