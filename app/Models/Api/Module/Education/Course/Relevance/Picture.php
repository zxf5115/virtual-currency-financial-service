<?php
namespace App\Models\Api\Module\Education\Course\Relevance;

use App\Models\Common\Module\Education\Course\Relevance\Picture as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 课程图片模型类
 */
class Picture extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


}
