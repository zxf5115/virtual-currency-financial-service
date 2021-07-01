<?php
namespace App\Models\Api\Module;

use App\Models\Common\Module\Member as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-09
 *
 * 会员模型类
 */
class Member extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'open_id',
    'apply_id',
    'password',
    'password_salt',
    'remember_token',
    'last_login_time',
    'last_login_ip',
    'try_number',
    'status',
    'create_time',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 学员与机构关联表
   * ------------------------------------------
   *
   * 学员与机构关联表
   *
   * @return [关联对象]
   */
  public function organization()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Organization',
      'organization_id',
      'id'
    );
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 会员与角色关联函数
   * ------------------------------------------
   *
   * 会员与角色关联函数
   *
   * @return [关联对象]
   */
  public function role()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Member\Role',
      'role_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 会员与档案关联函数
   * ------------------------------------------
   *
   * 会员与档案关联函数
   *
   * @return [关联对象]
   */
  public function archive()
  {
    return $this->hasOne(
      'App\Models\Api\Module\Member\Archive',
      'member_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 会员与认证关联表
   * ------------------------------------------
   *
   * 会员与认证关联表
   *
   * @return [关联对象]
   */
  public function certification()
  {
    return $this->hasOne(
      'App\Models\Api\Module\Member\Certification',
      'member_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 会员与资产关联表
   * ------------------------------------------
   *
   * 会员与资产关联表
   *
   * @return [关联对象]
   */
  public function asset()
  {
    return $this->hasOne(
      'App\Models\Api\Module\Member\Asset',
      'member_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-16
   * ------------------------------------------
   * 会员与设置关联表
   * ------------------------------------------
   *
   * 会员与设置关联表
   *
   * @return [关联对象]
   */
  public function setting()
  {
    return $this->hasOne(
      'App\Models\Api\Module\Member\Setting',
      'member_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-18
   * ------------------------------------------
   * 会员与会员贵宾关联函数
   * ------------------------------------------
   *
   * 会员与会员贵宾关联函数
   *
   * @return [关联对象]
   */
  public function vip()
  {
    return $this->belongsToMany(
      'App\Models\Api\Module\Vip',
      'module_member_vip',
      'member_id',
      'vip_id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-07-01
   * ------------------------------------------
   * 会员与会员贵宾关联函数
   * ------------------------------------------
   *
   * 会员与会员贵宾关联函数
   *
   * @return [type]
   */
  public function vipRelevance()
  {
    return $this->hasOne(
      'App\Models\Api\Module\Member\Vip',
      'member_id',
      'id'
    );
  }
}
