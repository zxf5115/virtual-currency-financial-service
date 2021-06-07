<?php
namespace App\Models\Api\Module\Common\Problem;

use App\Models\Common\Module\Common\Problem\Category as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-06
 *
 * 购车指南分类模型类
 */
class Category extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-05-29
   * ------------------------------------------
   * 购车指南分类置与购车指南关联函数
   * ------------------------------------------
   *
   * 购车指南分类置与购车指南关联函数
   *
   * @return [关联对象]
   */
  public function problem()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Common\Problem',
      'category_id',
      'id'
    );
  }
}
