<?php
namespace App\Models\Api\Module\Currency;

use App\Models\Common\Module\Currency\Symbol as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-28
 *
 * 货币交易模型类
 */
class Symbol extends Common
{
  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'state',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];


}
