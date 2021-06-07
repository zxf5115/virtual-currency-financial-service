<?php
namespace App\Enum\Module\Production;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品评论枚举类
 */
class CommentEnum
{
  // 评论内容类型
  const CONTENT = 1; // 文本内容
  const AUDIO   = 2; // 音频内容


  // 评论内容类型
  public static $suffix = [
    self::CONTENT       => [
      'value' => self::CONTENT,
      'text' => '文本内容'
    ],

    self::AUDIO => [
      'value' => self::AUDIO,
      'text' => '音频内容'
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
  public static function getSuffixStatus($code)
  {
    return self::$suffix[$code] ?: self::$suffix[self::CONTENT];
  }
}
