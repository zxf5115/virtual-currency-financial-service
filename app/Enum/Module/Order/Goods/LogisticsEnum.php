<?php
namespace App\Enum\Module\Order\Goods;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 课程订单物流枚举类
 */
class LogisticsEnum
{
  const WAIT_SEND = 0; // 待发货
  const WAIT_SIGN = 1; // 待签收
  const FINISH_SIGN = 2; // 已签收


  // 物流状态类型
  public static $logistics = [
    self::WAIT_SEND       => [
      'value' => self::WAIT_SEND,
      'text' => '待发货'
    ],

    self::WAIT_SIGN => [
      'value' => self::WAIT_SIGN,
      'text' => '待签收'
    ],

    self::FINISH_SIGN => [
      'value' => self::FINISH_SIGN,
      'text' => '已签收'
    ],
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 订单状态封装
   * ------------------------------------------
   *
   * 订单状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getLogisticsStatus($code)
  {
    return self::$logistics[$code] ?: self::$logistics[self::WAIT];
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 课程周期封装
   * ------------------------------------------
   *
   * 课程周期封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getSemesterData($code)
  {
    return [
      'value' => $code,
      'text' => '第'.$code.'期'
    ];
  }
}
