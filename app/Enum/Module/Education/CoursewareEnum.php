<?php
namespace App\Enum\Module\Education;

use App\Enum\BaseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-06
 *
 * 课件枚举类
 */
class CoursewareEnum extends BaseEnum
{
  // 课程推荐
  const YES = 1;
  const NO  = 2;

  // 课程推荐
  public static $status = [
    self::YES => [
      'value' => self::YES,
      'text' => '永久课程'
    ],

    self::NO => [
      'value' => self::NO,
      'text' => '循环课程'
    ]
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-24
   * ------------------------------------------
   * 是否为永久课程状态值
   * ------------------------------------------
   *
   * 是否为永久课程状态值
   *
   * @param int $code 信息代码
   * @return 信息内容
   */
  public static function getIsPermanentStatus($code)
  {
    return self::$status[$code] ?: self::$status[self::NO];
  }
}
