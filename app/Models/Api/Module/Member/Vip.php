<?php
namespace App\Models\Api\Module\Member;

use App\Models\Common\Module\Member\Vip as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-17
 *
 * 会员贵宾模型类
 */
class Vip extends Common
{
  // 隐藏的属性
  public $hidden = [
    'id',
    'organization_id',
    'member_id',
    'vip_id',
    'status',
    'create_time',
    'update_time'
  ];
}