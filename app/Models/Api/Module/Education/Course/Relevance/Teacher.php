<?php
namespace App\Models\Api\Module\Education\Course\Relevance;

use App\Models\Common\Module\Education\Course\Relevance\Teacher as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-14
 *
 * 课程老师模型类
 */
class Teacher extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];

  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 课程老师与课程关联函数
   * ------------------------------------------
   *
   * 课程老师与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 课程老师与课件关联函数
   * ------------------------------------------
   *
   * 课程老师与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 课程老师与课件级别关联函数
   * ------------------------------------------
   *
   * 课程老师与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 课程老师与老师关联函数
   * ------------------------------------------
   *
   * 课程老师与老师关联函数
   *
   * @return [关联对象]
   */
  public function teacher()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'teacher_id', 'id');
  }
}
