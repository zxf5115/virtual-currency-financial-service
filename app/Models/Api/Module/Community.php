<?php
namespace App\Models\Api\Module;

use App\Enum\Common\TimeEnum;
use App\Models\Common\Module\Community as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-21
 *
 * 社区模型类
 */
class Community extends Common
{

  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'member_id',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-07-01
   * ------------------------------------------
   * 时间封装
   * ------------------------------------------
   *
   * 时间封装
   *
   * @param int $value [数据库存在的值]
   * @return 状态值
   */
  public function getCreateTimeAttribute($value)
  {
    return TimeEnum::formatDateTime($value);
  }



  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 社区与社区分类关联函数
   * ------------------------------------------
   *
   * 社区与社区分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Community\Category',
      'category_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 社区与社区评论关联函数
   * ------------------------------------------
   *
   * 社区与社区评论关联函数
   *
   * @return [关联对象]
   */
  public function comment()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Community\Comment',
      'community_id',
      'id'
    );
  }
}
