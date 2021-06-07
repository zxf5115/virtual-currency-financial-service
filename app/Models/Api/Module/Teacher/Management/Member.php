<?php
namespace App\Models\Api\Module\Teacher\Management;

use App\Models\Common\Module\Member\Member as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员模型类
 */
class Member extends Common
{
  // 隐藏的属性
  public $hidden = [
    'password',
    'password_salt',
    'remember_token',
    'is_freeze',
    'is_add',
    'last_login_time',
    'last_login_ip',
    'try_number',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-15
   * ------------------------------------------
   * 登录操作
   * ------------------------------------------
   *
   * 登录操作，更新最后时间，更新失败登录次数
   *
   * @param [type] $request [description]
   * @return [type]
   */
  public static function login($request)
  {
    try
    {
      $request->last_login_time = time();
      $request->try_number = 0;
      $request->save();

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与学员档案关联表
   * ------------------------------------------
   *
   * 学员与学员档案关联表
   *
   * @return [关联对象]
   */
  public function archive()
  {
      return $this->hasOne('App\Models\Api\Module\Teacher\Management\Relevance\Archive', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
