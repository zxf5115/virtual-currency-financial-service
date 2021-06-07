<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;
use App\Enum\Module\Member\Relevance\TeacherEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-29
 *
 * 管理老师与学员关联模型类
 */
class Teacher extends Base
{
  // 表名
  public $table = 'module_member_teacher';

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'organization_id',
    'member_id',
    'teacher_id'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 家长微信是否被老师添加状态封装
   * ------------------------------------------
   *
   * 家长微信是否被老师添加状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsAddAttribute($value)
  {
    return TeacherEnum::getAddStatus($value);
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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                ->where(['status'=>1]);
  }
}
