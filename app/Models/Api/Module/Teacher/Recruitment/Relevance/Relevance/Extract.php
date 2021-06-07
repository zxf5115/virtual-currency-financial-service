<?php
namespace App\Models\Api\Module\Teacher\Recruitment\Relevance\Relevance;

use App\Models\Common\Module\Teacher\Recruitment\Relevance\Relevance\Extract as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 招聘老师分红提取模型类
 */
class Extract extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];
}
