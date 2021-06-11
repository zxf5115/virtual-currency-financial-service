<?php
namespace App\Models\Api\Module\Message;

use App\Models\Common\Module\Message\Category as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 消息分类模型类
 */
class Category extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];

  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-11
   * ------------------------------------------
   * 消息分类与消息关联函数
   * ------------------------------------------
   *
   * 消息分类与消息关联函数
   *
   * @return [关联对象]
   */
  public function message()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Message',
      'category_id',
      'id'
    );
  }
}
