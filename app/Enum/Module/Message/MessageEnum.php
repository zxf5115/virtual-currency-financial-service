<?php
namespace App\Enum\Module\Message;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-20
 *
 * 消息枚举类
 */
class MessageEnum
{
  // 消息阅读状态
  const WAIT   = 0; // 待阅读
  const FINISH = 1; // 已完成


  // 消息阅读状态
  public static $finish = [
    self::WAIT       => [
      'value' => self::WAIT,
      'text' => '待阅读'
    ],

    self::FINISH => [
      'value' => self::FINISH,
      'text' => '已完成'
    ],
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-05
   * ------------------------------------------
   * 消息类型封装
   * ------------------------------------------
   *
   * 消息类型封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getFinishStatus($code)
  {
    return self::$finish[$code] ?: self::$finish[self::WAIT];
  }
}
