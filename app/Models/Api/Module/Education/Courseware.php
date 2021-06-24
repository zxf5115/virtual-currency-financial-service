<?php
namespace App\Models\Api\Module\Education;

use App\Models\Common\Module\Education\Courseware as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-23
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
   * 课件与课件知识点关联函数
   * ------------------------------------------
   *
   * 课件与课件知识点关联函数
   *
   * @return [关联对象]
   */
  public function point()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Education\Courseware\Point',
      'courseware_id',
      'id'
    )->where(['status'=>1]);
  }
}
