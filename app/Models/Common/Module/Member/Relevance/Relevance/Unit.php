<?php
namespace App\Models\Common\Module\Member\Relevance\Relevance;

use App\Models\Base;
use App\Enum\Module\Member\Relevance\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-20
 *
 * 会员课程单元模型类
 */
class Unit extends Base
{
  // 表名
  public $table = 'module_member_course_unit';

  // 可以批量修改的字段
  public $fillable = [
    'organization_id',
    'member_id',
    'course_id',
    'courseware_id',
    'level_id',
    'unit_id',
    'wait_unlock_time'
  ];

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 是否学习完成课程知识点封装
   * ------------------------------------------
   *
   * 是否学习完成课程知识点封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getIsFinishAttribute($value)
  {
    return CourseEnum::getFinishStatus($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 是否解锁课程单元封装
   * ------------------------------------------
   *
   * 是否解锁课程单元封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getIsUnlockAttribute($value)
  {
    return CourseEnum::getLockStatus($value);
  }


  // 关联函数 ------------------------------------------------------


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
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
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
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-06
   * ------------------------------------------
   * 知识点与课件关联函数
   * ------------------------------------------
   *
   * 知识点与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-06
   * ------------------------------------------
   * 知识点与课件级别关联函数
   * ------------------------------------------
   *
   * 知识点与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-08
   * ------------------------------------------
   * 知识点与课件单元关联函数
   * ------------------------------------------
   *
   * 知识点与课件单元关联函数
   *
   * @return [关联对象]
   */
  public function unit()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Relevance\Unit', 'unit_id', 'id');
  }
}
