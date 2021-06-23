<?php
namespace App\Models\Api\Module\Community;

use App\Models\Common\Module\Community\Comment as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-21
 *
 * 社区评论模型类
 */
class Comment extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  protected $hidden = [
    'id',
    'organization_id',
    'parent_id',
    'community_id',
    'member_id',
    'status',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-21
   * ------------------------------------------
   * 社区评论与社区关联函数
   * ------------------------------------------
   *
   * 社区评论与社区关联函数
   *
   * @return [关联对象]
   */
  public function community()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Community',
      'community_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-21
   * ------------------------------------------
   * 无限评论封装
   * ------------------------------------------
   *
   * 无限评论封装
   *
   * @return [type]
   */
  public function children()
  {
    return $this->hasMany(__CLASS__, ['community_id', 'parent_id'], ['community_id', 'parent_id'])
                ->with('children')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-21
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
}
