<?php
namespace App\Models\Api\Module\Education\Courseware\Relevance;

use App\Models\Common\Module\Education\Courseware\Relevance\Level as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-23
 *
 * 课件级别模型类
 */
class Level extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];



  // 关联函数 ------------------------------------------------------


}
