<?php
namespace App\Models\Api\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Course as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课程模型类
 */
class Course extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  // 追加到模型数组表单的访问器
  protected $appends = [];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 课程与课程详情关联函数
   * ------------------------------------------
   *
   * 课程与课程详情关联函数
   *
   * @return [关联对象]
   */
  public function detail()
  {
    return $this->hasOne('App\Models\Api\Module\Education\Course\Relevance\Detail', 'course_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-28
   * ------------------------------------------
   * 课程与课件关联函数
   * ------------------------------------------
   *
   * 课程与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-10
   * ------------------------------------------
   * 课程与解锁关联函数
   * ------------------------------------------
   *
   * 课程与解锁关联函数
   *
   * @return [关联对象]
   */
  public function unlock()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Relevance\Unlock', 'unlock_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 课程与课程图片关联函数
   * ------------------------------------------
   *
   * 课程与课程图片关联函数
   *
   * @return [关联对象]
   */
  public function picture()
  {
    return $this->hasMany('App\Models\Api\Module\Education\Course\Relevance\Picture', 'course_id', 'id');
  }
}
