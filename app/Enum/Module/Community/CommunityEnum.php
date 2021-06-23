<?php
namespace App\Enum\Module\Community;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-21
 *
 * 社区枚举类
 */
class CommunityEnum
{
  // 是否热门状态
  const NO  = 0; // 普通
  const YES = 1; // 热门


  // 是否热门状态
  public static $hot = [
    self::NO       => [
      'value' => self::NO,
      'text' => '普通'
    ],

    self::YES       => [
      'value' => self::YES,
      'text' => '热门'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-10
   * ------------------------------------------
   * 是否热门状态封装
   * ------------------------------------------
   *
   * 是否热门状态封装
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getHotStatus($code)
  {
    return self::$hot[$code] ?: self::$hot[self::NO];
  }
}
