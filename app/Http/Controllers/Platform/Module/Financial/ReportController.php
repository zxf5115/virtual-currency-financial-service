<?php
namespace App\Http\Controllers\Platform\Module\Financial;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Member\Relevance\Money;
use App\Models\Common\Module\Order\Goods as GoodsOrder;
use App\Models\Common\Module\Order\Course as CourseOrder;
use App\Models\Common\Module\Education\Courseware\Courseware;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-22
 *
 * 报表控制器类
 */
class ReportController extends BaseController
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 基础统计数据
   * ------------------------------------------
   *
   * 基础统计数据
   *
   * @return [type]
   */
  public function data()
  {
    try
    {
      $where = ['pay_status' => 1];

      $goods = GoodsOrder::getPluck('pay_money', $where, false, false, true);

      $goods_money = 0;

      foreach($goods as $item)
      {
        $goods_money = bcadd($goods_money, $item, 2);
      }

      $course = CourseOrder::getPluck('pay_money', $where, false, false, true);

      $course_money = 0;

      foreach($course as $item)
      {
        $course_money = bcadd($course_money, $item, 2);
      }

      $where = [
        'type' => 2,
        'withdrawal_status' => 1
      ];

      $red_envelope = Money::getPluck('money', $where, false, false, true);

      $red_envelope = array_sum($red_envelope);

      $money_total = bcadd($course_money, $goods_money, 2);
      $money_total = bcsub($money_total, $red_envelope, 2);

      $response['money_total']  = $money_total;
      $response['course_money'] = $course_money;
      $response['goods_money']  = $goods_money;
      $response['red_envelope'] = $red_envelope;

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 首页统计数据
   * ------------------------------------------
   *
   * 首页统计数据
   *
   * @return [type]
   */
  public function proportion()
  {
    try
    {
      $where = ['pay_status' => 1];

      $goods_money = GoodsOrder::getPluck('pay_money', $where, false, false, true);

      $goods_money = array_sum($goods_money);

      $response[]  = ['title' => '商品', 'value' => $goods_money];

      $courseware = Courseware::getList(['status' => 1]);

      foreach($courseware as $item)
      {
        $where = [
          'pay_status' => 1,
          'courseware_id' => $item->id
        ];

        $course_money = CourseOrder::getPluck('pay_money', $where, false, false, true);

        $course_money = array_sum($course_money);

        $response[] = ['title' => $item->title, 'value' => $course_money];
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-19
   * ------------------------------------------
   * 15天走势统计数据
   * ------------------------------------------
   *
   * 15天走势统计数据
   *
   * @return [type]
   */
  public function trend()
  {
    try
    {
      $x = 0;
      $response = [];

      $start_time = strtotime(date('Y-m-d', time() - (14 * 86400)));
      $end_time   = strtotime(date('Y-m-d', time()));

      $courseware = Courseware::getList(['status' => 1]);

      for($i = $start_time; $i <= $end_time; $i = $i + 86400 )
      {
        $response[$x]['日期'] = date('Y.m.d', $i);

        $where = [
          'pay_status' => 1,
          ['create_time', '>=', $i],
          ['create_time', '<', $i + 86400],
        ];

        $goods_money = GoodsOrder::getPluck('pay_money', $where, false, false, true);

        $response[$x]['商品'] = array_sum($goods_money);

        foreach($courseware as $item)
        {
          $where = [
            'pay_status' => 1,
            'courseware_id' => $item->id,
            ['create_time', '>=', $i],
            ['create_time', '<', $i + 86400],
          ];

          $course_money = CourseOrder::getPluck('pay_money', $where, false, false, true);

          $course_money = array_sum($course_money);

          $response[$x][$item->title] = $course_money;
        }











        $x++;
      }



// dd($response);













      // $response[]  = ['title' => '商品', 'value' => $goods_money];

      // $courseware = Courseware::getList(['status' => 1]);

      // foreach($courseware as $item)
      // {
      //   $where = [
      //     'pay_status' => 1,
      //     'courseware_id' => $item->id
      //   ];

      //   $course_money = CourseOrder::getPluck('pay_money', $where, false, false, true);

      //   $course_money = array_sum($course_money);

      //   $response[] = ['title' => $item->title, 'value' => $course_money];
      // }

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
