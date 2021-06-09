<?php
namespace App\Models\Api\Module\Member;

use App\Models\Common\Module\Member\MemberMessage as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-04-20
 *
 * 会员消息模型类
 */
class MemberMessage extends Common
{
  // 隐藏的属性
  public $hidden = [
    'status',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-04-20
   * ------------------------------------------
   * 会员消息与会员关联函数
   * ------------------------------------------
   *
   * 会员消息与会员关联函数
   *
   * @return [type]
   */
  public function member()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Member',
      'member_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-04-20
   * ------------------------------------------
   * 会员消息与消息关联函数
   * ------------------------------------------
   *
   * 会员消息与消息关联函数
   *
   * @return [type]
   */
  public function message()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Message',
      'message_id',
      'id'
    );
  }
}
