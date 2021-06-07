<?php
namespace App\Http\Controllers\Platform\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Enum\Common\MoneyEnum;
use App\Models\Common\Module\Member\Member;
use App\Models\Common\Module\Complain\Complain;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Member\Relevance\Money;
use App\Models\Common\Module\Education\Course\Course;
use App\Models\Common\Module\Order\Goods as GoodsOrder;
use App\Models\Common\Module\Order\Course as CourseOrder;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 首页控制器
 */
class IndexController extends BaseController
{
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
  public function data()
  {
    try
    {
      $today_member_total = 0;
      $member_total = 0;

      $today_course_total = 0;
      $course_total = 0;

      $today_goods_total = 0;
      $goods_total = 0;

      $today_money_total = 0;
      $money_total = 0;

      $wait_money_total = 0;
      $complain_total = 0;
      $wait_order_total = 0;

      // 今天0点
      $today = strtotime(date("Y-m-d"),time());

      // 今天
      $where = [['create_time', '>', $today]];

      $today_member_total = Member::getCount($where);
      $member_total = Member::getCount([]);

      $today_course_total = Course::getCount($where);
      $course_total = Course::getCount([]);

      $today_goods_total = GoodsOrder::getCount($where);
      $goods_total = GoodsOrder::getCount([]);

      $today_goods_money_total = GoodsOrder::getPluck('pay_money', $where, false, false, true);
      $goods_money_total = GoodsOrder::getPluck('pay_money', [], false, false, true);

      $today_course_money_total = CourseOrder::getPluck('pay_money', $where, false, false, true);
      $course_money_total = CourseOrder::getPluck('pay_money', [], false, false, true);

      $today_money_total = array_merge($today_course_money_total, $today_goods_money_total);

      $today_money_total = MoneyEnum::getTotalMoney($today_money_total);

      $money_total = array_merge($course_money_total, $goods_money_total);
      $money_total = MoneyEnum::getTotalMoney($money_total);

      $wait_money_total = Money::getCount(['type' => 2, 'withdrawal_status' => 0]);

      $complain_total = Complain::getCount([]);

      $where = ['pay_status' => 1, 'order_status' => 0];
      $wait_order_total = GoodsOrder::getCount($where);

      $response['today_member_total'] = $today_member_total;
      $response['member_total']       = $member_total;

      $response['today_course_total'] = $today_course_total;
      $response['course_total']       = $course_total;

      $response['today_goods_total']  = $today_goods_total;
      $response['goods_total']        = $goods_total;

      $response['today_money_total']  = $today_money_total;
      $response['money_total']        = $money_total;

      $response['wait_money_total']   = $wait_money_total;
      $response['complain_total']     = $complain_total;
      $response['wait_order_total']   = $wait_order_total;

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
