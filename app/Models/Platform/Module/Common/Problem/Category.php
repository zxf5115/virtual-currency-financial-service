<?php
namespace App\Models\Platform\Module\Common\Problem;

use App\Models\Common\Module\Common\Problem\Category as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-06
 *
 * 购车指南分类模型类
 */
class Category extends Common
{

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
      'App\Models\Platform\Module\Common\Problem',
      'category_id',
      'id'
    );
  }
}
