<?php
namespace App\Models\Api\Module\Education\Course\Relevance;

use App\Models\Common\Module\Education\Course\Relevance\Unlock as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 课程礼包模型类
 */
class Unlock extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


}
