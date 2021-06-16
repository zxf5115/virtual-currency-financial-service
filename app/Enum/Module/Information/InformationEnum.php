<?php
namespace App\Enum\Module\Information;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 资讯枚举类
 */
class InformationEnum
{
  // 是否推荐状态
  const WAIT   = 0; // 未推荐
  const FINISH = 1; // 已推荐


  // 是否推荐状态
  public static $recommend = [
    self::WAIT       => [
      'value' => self::WAIT,
      'text' => '未推荐'
    ],

    self::FINISH       => [
      'value' => self::FINISH,
      'text' => '已推荐'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-10
   * ------------------------------------------
   * 是否推荐状态封装
   * ------------------------------------------
   *
   * 是否推荐状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getRecommendStatus($code)
  {
    return self::$recommend[$code] ?: self::$recommend[self::WAIT];
  }
}
