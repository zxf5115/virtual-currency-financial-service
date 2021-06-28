<?php
namespace App\Crontab\Platform\Currency;

use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller;
use App\Models\Common\Module\Currency\Category as CategoryModel;

use App\Helpers\FireCurrency;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-27
 *
 * 货币种类定时任务
 */
class Category extends Controller
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

      $result = $model->get_common_currencys();

      if(empty($result->data))
      {
        return false;
      }

      foreach($result->data as $item)
      {
        $model = CategoryModel::firstOrNew(['code' => $item]);

        // 将已存在的货币去除
        if(!empty($model->id))
        {
          continue;
        }

        $model->title = strtoupper($item);
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
