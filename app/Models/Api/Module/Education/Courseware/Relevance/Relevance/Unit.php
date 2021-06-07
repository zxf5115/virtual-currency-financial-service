<?php
namespace App\Models\Api\Module\Education\Courseware\Relevance\Relevance;

use App\Enum\Module\Member\Relevance\CourseEnum;
use App\Models\Api\Module\Member\Relevance\Relevance\Unit as MemberUnit;
use App\Models\Common\Module\Education\Courseware\Relevance\Relevance\Unit as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课件单元模型类
 */
class Unit extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-03-18
   * ------------------------------------------
   * 设置课程单元解锁数据
   * ------------------------------------------
   *
   * 设置课程单元解锁数据
   *
   * @param [type] $data 课程单元数据
   * @param [type] $course_id 课程编号
   */
  public static function setUnlockData($data, $course_id)
  {
    try
    {
      foreach($data as &$item)
      {
        $where = [
          'course_id'     => $course_id,
          'courseware_id' => $item->courseware_id,
          'level_id'      => $item->level_id,
          'unit_id'       => $item->id,
        ];

        // 获取每位老师管理人数
        $unit = MemberUnit::getRow($where);

        if(empty($unit))
        {
          return false;
        }

        $item->wait_unlock_time = date('Y-m-d', $unit->wait_unlock_time);
        $is_unlock = time() > $unit->wait_unlock_time ? 1 : 0;
        $item->is_unlock = CourseEnum::getLockStatus($is_unlock);
      }

      return $data;
    }
    catch(\Exception $e)
    {
      self::record($e);

      return false;
    }
  }

}
