<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Models\Common\Module\Member\Relevance\Lollipop as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员棒棒糖模型类
 */
class Lollipop extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
