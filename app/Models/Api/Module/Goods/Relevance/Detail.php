<?php
namespace App\Models\Api\Module\Goods\Relevance;

use App\Models\Common\Module\Goods\Relevance\Detail as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品详情模型类
 */
class Detail extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
