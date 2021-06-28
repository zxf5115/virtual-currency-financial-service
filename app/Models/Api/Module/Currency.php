<?php
namespace App\Models\Api\Module;

use App\Models\Common\Module\Currency as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-27
 *
 * 货币模型类
 */
class Currency extends Common
{
  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

}
