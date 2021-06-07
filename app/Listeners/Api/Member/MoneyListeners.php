<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\System\Config;
use App\Events\Api\Member\MoneyEvent;
use App\Models\Api\Module\Member\Member;
use App\Models\Api\Module\Member\Relevance\Money;
use App\Models\Api\Module\Member\Relevance\Asset;

/**
 * 佣金监听器
 */
class MoneyListeners
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
   * @param  MoneyEvent  $event
   * @return void
   */
  public function handle(MoneyEvent $event)
  {
    try
    {
      $type      = $event->type;
      $member_id = $event->member_id;

      $config = Config::getRow(['title' => 'invitation_money']);

      $money = $config->value;

      if(1 == $type)
      {
        $this->obtain($member_id, $money);
      }
      else
      {
        $money = $event->money;

        $this->expend($member_id, $money);
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-31
   * ------------------------------------------
   * 获得佣金金额
   * ------------------------------------------
   *
   * 通过邀请学员购买课程获得佣金
   *
   * @param [type] $user_id 用户编号
   * @param [type] $money 佣金金额
   *
   * @return [type]
   */
  private function obtain($user_id, $money)
  {
    try
    {
      $asset = Asset::firstOrCreate(['member_id' => $user_id]);
      $asset->increment('red_envelope', $money);
      $asset->save();

      $model = new Money();

      $model->member_id = $user_id;
      $model->type      = 1;
      $model->content   = '邀请用户';
      $model->money     = $money;

      $model->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-31
   * ------------------------------------------
   * 消耗会员佣金
   * ------------------------------------------
   *
   * 记录用户佣金提现记录信息，总佣金数减少
   *
   * @param [type] $user_id 用户编号
   * @param [type] $money 佣金金额
   *
   * @return [type]
   */
  private function expend($user_id, $money)
  {
    try
    {
      $asset = Asset::firstOrCreate(['member_id' => $user_id]);
      $asset->decrement('red_envelope', $money);
      $asset->save();

      $model = new Money();

      $model->member_id = $user_id;
      $model->type      = 2;
      $model->content   = '红包提现';
      $model->money     = $money;

      $model->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
