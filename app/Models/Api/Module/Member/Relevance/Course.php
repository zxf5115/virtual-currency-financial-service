<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Models\Common\Module\Member\Relevance\Course as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员课程模型类
 */
class Course extends Common
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
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 反向关联管理老师
   * ------------------------------------------
   *
   * 反向关联管理老师
   *
   * @return [关联对象]
   */
  public function teacher()
  {
      return $this->belongsTo('App\Models\Api\Module\Member\Member', 'teacher_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-07
   * ------------------------------------------
   * 反向关联用户
   * ------------------------------------------
   *
   * 反向关联用户
   *
   * @return [type]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课程关联函数
   * ------------------------------------------
   *
   * 会员课程与课程关联函数
   *
   * @return [type]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课件关联函数
   * ------------------------------------------
   *
   * 会员课程与课件关联函数
   *
   * @return [type]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课件级别关联函数
   * ------------------------------------------
   *
   * 会员课程与课件级别关联函数
   *
   * @return [type]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }
}
