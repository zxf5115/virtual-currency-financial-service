<?php
namespace App\Models\Api\Module\Advertising;

use App\Models\Common\Module\Advertising\Advertising as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-26
 *
 * 广告模型类
 */
class Advertising extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'update_time'
  ];
}
