<?php
namespace App\Enum\Module\Teacher;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-20
 *
 * 老师枚举类
 */
class TeacherEnum
{
  // 状态
  const SYSTEM = 1; // 系统添加
  const FINISH = 2; // 完成条件


  // 状态封装
  public static $condition = [
    self::SYSTEM => [
      'value' => self::SYSTEM,
      'text' => '系统添加'
    ],

    self::FINISH => [
      'value' => self::FINISH,
      'text' => '完成条件'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 条件状态类型封装
   * ------------------------------------------
   *
   * 条件状态类型封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getConditionStatus($code)
  {
    return self::$condition[$code] ?: self::$condition[self::SYSTEM];
  }
}
