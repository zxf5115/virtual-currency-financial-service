<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Models\Common\Module\Member\Relevance\Target as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 学员任务指标模型类
 */
class Target extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
