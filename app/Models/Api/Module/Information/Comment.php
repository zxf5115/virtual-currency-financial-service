<?php
namespace App\Models\Api\Module\Information;

use App\Models\Common\Module\Information\Comment as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 资讯评论模型类
 */
class Comment extends Common
{

  // 隐藏的属性
  protected $hidden = [
    'id',
    'organization_id',
    'flash_id',
    'member_id',
    'be_member_id',
    'status',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯评论置与资讯关联函数
   * ------------------------------------------
   *
   * 资讯评论置与资讯关联函数
   *
   * @return [关联对象]
   */
  public function information()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Information',
      'information_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-11
   * ------------------------------------------
   * 评论与评论人关联表
   * ------------------------------------------
   *
   * 评论与评论人关联表
   *
   * @return [关联对象]
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
   * @dateTime 2021-06-11
   * ------------------------------------------
   * 评论与被评论人关联表
   * ------------------------------------------
   *
   * 评论与被评论人关联表
   *
   * @return [关联对象]
   */
  public function bemember()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Member',
      'be_member_id',
      'id'
    );
  }
}
