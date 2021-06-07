<?php
namespace App\Models\Api\Module\Education\Courseware;

use App\Models\Common\Module\Education\Courseware\Courseware as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课件模型类
 */
class Courseware extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'update_time'
  ];



  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课程分类与课程关联函数
   * ------------------------------------------
   *
   * 课程分类与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->hasMany('App\Models\Api\Module\Education\Course\Course', 'courseware_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课件与课件级别关联函数
   * ------------------------------------------
   *
   * 课件与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->hasMany('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'courseware_id', 'id')
                ->where(['status'=>1]);
  }
}
