<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;
use App\Enum\Module\Member\Relevance\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-20
 *
 * 会员课程关联模型类
 */
class Course extends Base
{
  // 表名
  public $table = 'module_member_course';

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'organization_id',
    'member_id',
    'course_id',
    'courseware_id',
    'level_id',
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  /**
   * 转换属性类型
   */
  protected $casts = [
    'status' => 'array',
    'create_time' => 'datetime:Y-m-d H:i:s',
    'update_time' => 'datetime:Y-m-d H:i:s',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 报名时间封装
   * ------------------------------------------
   *
   * 报名时间封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getApplyTimeAttribute($value)
  {
    $text = '未报名';

    if(0 != $value)
    {
      $text = date('Y-m-d H:i:s', $value);
    }

    return [
      'text' => $text,
      'value' => $value,
    ];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 是否添加了家长微信封装
   * ------------------------------------------
   *
   * 是否添加了家长微信封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsAddAttribute($value)
  {
    return CourseEnum::getAddStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 报名状态封装
   * ------------------------------------------
   *
   * 报名状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getApplyStatusAttribute($value)
  {
    return CourseEnum::getApplyStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 是否学习完成课程封装
   * ------------------------------------------
   *
   * 是否学习完成课程封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getIsFinishAttribute($value)
  {
    return CourseEnum::getFinishStatus($value);
  }



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
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'teacher_id', 'id')
                  ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与会员关联函数
   * ------------------------------------------
   *
   * 会员课程与会员关联函数
   *
   * @return [type]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
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
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id')
                ->where(['status'=>1]);
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id')
                ->where(['status'=>1]);
  }
}
