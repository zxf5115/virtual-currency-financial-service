<?php
namespace App\Models\Api\Module\Production\Relevance;

use App\Models\Common\Module\Production\Relevance\Comment as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品评论模型类
 */
class Comment extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与学员关联函数
   * ------------------------------------------
   *
   * 作品与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id');
  }
}
