<?php
namespace App\Models\Common\Module\Education\Course\Relevance;

use App\Models\Base;
use App\Enum\Module\Education\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-08
 *
 * 课程老师模型类
 */
class Teacher extends Base
{
  // 表名
  public $table = "module_course_teacher";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 隐藏的属性
  public $hidden = [];



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
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'teacher_id', 'id');
  }
}
