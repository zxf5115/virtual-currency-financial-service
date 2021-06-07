<?php
namespace App\Models\Api\Module\Education\Course\Relevance;

use App\Models\Common\Module\Education\Course\Relevance\Share as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 课程分享模型类
 */
class Share extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];


}
