<?php
namespace App\Models\Common\Module\Message;

use App\Models\Base;
use App\Enum\Module\Message\MessageEnum;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-17
 *
 * 系统消息模型类
 */
class Message extends Base
{
  // 表名
  public $table = 'module_message';

  // 可以批量修改的字段
  public $fillable = ['title', 'content'];

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 消息类型封装
   * ------------------------------------------
   *
   * 消息类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTypeAttribute($value)
  {
    return MessageEnum::getTypeStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-19
   * ------------------------------------------
   * 关联到用户表
   * ------------------------------------------
   *
   * 关联到用户色表
   *
   * @return [关联对象]
   */
  public function user()
  {
    return $this->belongsToMany(
      'App\Models\Common\System\User',
      'system_user_message_relevance',
      'message_id',
      'user_id'
    )->wherePivot('status', 1);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-20
   * ------------------------------------------
   * 消息与用户消息关联函数
   * ------------------------------------------
   *
   * 消息与用户消息关联函数
   *
   * @return [type]
   */
  public function relevance()
  {
    return $this->hasMany('App\Models\Common\Module\Member\Relevance\Message', 'message_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 注册关联删除
   * ------------------------------------------
   *
   * 注册关联删除
   *
   * @return [type]
   */
  public static function boot()
  {
    parent::boot();

    static::deleted(function($model) {
      $model->relevance()->delete();
    });
  }
}
