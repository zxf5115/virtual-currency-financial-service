<?php
namespace App\Models\Api\Module\Education\Courseware;

use App\Models\Common\Module\Education\Courseware\Category as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-23
 *
 * 课件分类模型类
 */
class Category extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];



  // 关联函数 ------------------------------------------------------


}
