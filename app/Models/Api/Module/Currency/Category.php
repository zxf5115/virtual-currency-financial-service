<?php
namespace App\Models\Api\Module\Currency;

use App\Models\Common\Module\Currency\Category as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-28
 *
 * 货币种类模型类
 */
class Category extends Common
{
  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];


}
