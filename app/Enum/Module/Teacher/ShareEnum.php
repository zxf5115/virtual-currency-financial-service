<?php
namespace App\Enum\Module\Teacher;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-20
 *
 * 老师分红枚举类
 */
class ShareEnum
{
  // 状态
  const WAIT   = 0; // 待结算
  const FINISH = 1; // 已结算

  const OFFLINE = 1; // 线下
  const ONLINE  = 2; // 线上

  // 提现类型封装
  public static $type = [
    self::OFFLINE => [
      'value' => self::OFFLINE,
      'text' => '线下结算'
    ],

    self::ONLINE => [
      'value' => self::ONLINE,
      'text' => '线上结算'
    ]
  ];

  // 结算状态封装
  public static $settlement = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待结算'
    ],

    self::FINISH => [
      'value' => self::FINISH,
      'text' => '已结算'
    ]
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 结算状态类型封装
   * ------------------------------------------
   *
   * 结算状态类型封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::OFFLINE];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 结算状态类型封装
   * ------------------------------------------
   *
   * 结算状态类型封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getSettlementStatus($code)
  {
    return self::$settlement[$code] ?: self::$settlement[self::SYSTEM];
  }
}
