<?php
namespace App\Models\Api\Module\Template;

use App\Models\Common\Module\Template\Template as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 模板模型类
 */
class Template extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
