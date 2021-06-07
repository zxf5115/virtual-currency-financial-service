<?php
namespace App\Models\Api\Module\Teacher\Management\Relevance;

use App\Models\Common\Module\Member\Relevance\Archive as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员档案模型类
 */
class Archive extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'skill_level',
    'birthday',
    'status',
    'create_time',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];
}
