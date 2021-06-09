<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-04-20
 *
 * 会员消息模型类
 */
class MemberMessage extends Base
{
  // 表名
  public $table = 'module_member_message';

  /**
   * 可以被批量赋值的属性
   */
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'squad_id',
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 隐藏的属性
  public $hidden = [
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
      'App\Models\Common\Module\Member',
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
      'App\Models\Common\Module\Message',
      'message_id',
      'id'
    );
  }
}
