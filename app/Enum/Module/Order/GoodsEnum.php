<?php
namespace App\Enum\Module\Order;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 商品订单枚举类
 */
class GoodsEnum
{
  // 兑换类型
  const LOLLIPOP = 1; // 棒棒糖
  const CASH     = 2; // 现金

  const WAIT    = 0; // 待支付
  const FINISH  = 1; // 已支付

  // 支付状态
  const ALI    = 1; // 支付宝
  const WECHAT = 2; // 微信
  const SUGAR  = 3; // 棒棒糖
  const APPLE  = 4; // 苹果

  // 订单类型
  const WAIT_SEND   = 0; // 待发货
  const WAIT_SIGN   = 1; // 待签收
  const FINISH_SIGN = 2; // 已签收
  const CANCEL      = 3; // 已取消

  // 兑换类型
  public static $exchange = [
    self::LOLLIPOP       => [
      'value' => self::LOLLIPOP,
      'text' => '棒棒糖'
    ],

    self::CASH => [
      'value' => self::CASH,
      'text' => '现金'
    ],
  ];


  // 支付类型
  public static $type = [
    self::ALI       => [
      'value' => self::ALI,
      'text' => '支付宝'
    ],

    self::WECHAT => [
      'value' => self::WECHAT,
      'text' => '微信'
    ],

    self::SUGAR  => [
      'value' => self::SUGAR,
      'text' => '棒棒糖'
    ],

    self::APPLE => [
      'value' => self::APPLE,
      'text' => '苹果'
    ],
  ];


  // 支付类型
  public static $pay = [
    self::WAIT       => [
      'value' => self::WAIT,
      'text' => '待支付'
    ],

    self::FINISH => [
      'value' => self::FINISH,
      'text' => '已支付'
    ],
  ];


  // 支付类型
  public static $order = [
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

    self::CANCEL => [
      'value' => self::CANCEL,
      'text' => '已取消'
    ],
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 兑换类型封装
   * ------------------------------------------
   *
   * 兑换类型封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getExchangeStatus($code)
  {
    return self::$exchange[$code] ?: self::$exchange[self::LOLLIPOP];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 支付类型封装
   * ------------------------------------------
   *
   * 支付类型封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getTypeStatus($code)
  {
    return self::$type[$code] ?: self::$type[self::ALI];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 支付状态封装
   * ------------------------------------------
   *
   * 支付状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getPayStatus($code)
  {
    return self::$pay[$code] ?: self::$pay[self::WAIT];
  }


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
  public static function getOrderStatus($code)
  {
    return self::$order[$code] ?: self::$order[self::WAIT];
  }
}
