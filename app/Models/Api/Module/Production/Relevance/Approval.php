<?php
namespace App\Models\Api\Module\Production\Relevance;

use App\Models\Common\Module\Production\Relevance\Approval as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品点赞模型类
 */
class Approval extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
