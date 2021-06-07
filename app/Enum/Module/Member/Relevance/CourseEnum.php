<?php
namespace App\Enum\Module\Member\Relevance;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-20
 *
 * 会员课程枚举类
 */
class CourseEnum
{
  // 添加状态
  const ADD = 1; // 是
  const UNADD = 2; // 否

  const WAIT = 0; // 待确认
  const AGREE = 1; // 已确认

  // 添加状态封装
  public static $add = [
    self::ADD => [
      'value' => self::ADD,
      'text' => '是'
    ],

    self::UNADD => [
      'value' => self::UNADD,
      'text' => '否'
    ]
  ];

  // 报名状态封装
  public static $apply = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待确认'
    ],

    self::AGREE => [
      'value' => self::AGREE,
      'text' => '已确认'
    ]
  ];

  // 解锁状态封装
  public static $lock = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待解锁'
    ],

    self::AGREE => [
      'value' => self::AGREE,
      'text' => '已解锁'
    ]
  ];


  // 完成状态封装
  public static $finish = [
    self::WAIT => [
      'value' => self::WAIT,
      'text' => '待完成'
    ],

    self::AGREE => [
      'value' => self::AGREE,
      'text' => '已完成'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 添加状态类型封装
   * ------------------------------------------
   *
   * 添加状态类型封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getAddStatus($code)
  {
    return self::$add[$code] ?: self::$add[self::UNADD];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 报名状态封装
   * ------------------------------------------
   *
   * 报名状态封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getApplyStatus($code)
  {
    return self::$apply[$code] ?: self::$apply[self::WAIT];
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 是否解锁状态封装
   * ------------------------------------------
   *
   * 是否解锁状态封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getLockStatus($code)
  {
    return self::$lock[$code] ?: self::$lock[self::WAIT];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 是否完成状态封装
   * ------------------------------------------
   *
   * 是否完成状态封装
   *
   * @param int $code 状态代码
   * @return 状态信息
   */
  public static function getFinishStatus($code)
  {
    return self::$finish[$code] ?: self::$finish[self::WAIT];
  }
}
