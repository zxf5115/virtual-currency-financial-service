<?php
namespace App\Models\Api\Module\Common;

use App\Models\Common\Module\Common\Logistics as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-05-30
 *
 * 物流模型类
 */
class Logistics extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];

}
