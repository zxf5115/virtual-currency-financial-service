<?php
namespace App\Models\Api\Module\Education\Courseware;

use App\Models\Common\Module\Education\Courseware\Point as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-23
 *
 * 课件知识点模型类
 */
class Point extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'update_time'
  ];



  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-23
   * ------------------------------------------
   * 课件知识点与课件关联函数
   * ------------------------------------------
   *
   * 课件知识点与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Education\Courseware',
      'courseware_id',
      'id'
    );
  }

}
