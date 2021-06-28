<?php
namespace App\Crontab\Platform\Currency;

use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller;
use App\Models\Common\Module\Currency\Symbol as SymbolModel;

use App\Helpers\FireCurrency;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-28
 *
 * 货币交易定时任务
 */
class Symbol extends Controller
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-27
   * ------------------------------------------
   * 采集货币信息
   * ------------------------------------------
   *
   * 采集货币信息
   *
   * @return [type]
   */
  public function action()
  {
    DB::beginTransaction();

    try
    {
      $model = new FireCurrency();

      $result = $model->get_common_symbols();

      if(empty($result->data))
      {
        return false;
      }

      foreach($result->data as $item)
      {
        // 将对象转换为数组
        $data = (array)$item;

        $model = SymbolModel::firstOrNew(['symbol' => $data['symbol']]);

        // 将已存在的货币去除
        if(!empty($model->id))
        {
          continue;
        }

        $model->base_currency  = $data['base-currency'];
        $model->quote_currency = $data['quote-currency'];
        $model->state          = $data['state'];
        $model->save();
      }

      DB::commit();
    }
    catch(\Exception $e)
    {
      DB::rollback();

      record($e);

      return false;
    }
  }
}
