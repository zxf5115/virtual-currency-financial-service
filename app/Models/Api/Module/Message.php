<?php
namespace App\Models\Api\Module;

use App\Models\Common\Module\Message as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-04-21
 *
 * 消息模型类
 */
class Message extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'category_id',
    'status',
    'create_time',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-04-22
   * ------------------------------------------
   * 消息与会员消息关联函数
   * ------------------------------------------
   *
   * 消息与会员消息关联函数
   *
   * @return [type]
   */
  public function relevance()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Member\MemberMessage',
      'message_id',
      'id'
    );
  }
}
