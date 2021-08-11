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


  // 追加到模型数组表单的访问器
  protected $appends = [
    'comment_total'
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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-08-11
   * ------------------------------------------
   * 资讯评论数量封装
   * ------------------------------------------
   *
   * 资讯评论数量封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getCommentTotalAttribute($value)
  {
    $comment = $this->comment ?? '';

    if(empty($comment))
    {
      return 0;
    }

    unset($this->comment);

    return count($comment);
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
    return $this->hasMany(
      'App\Models\Api\Module\Community\Comment',
      'community_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-08-11
   * ------------------------------------------
   * 资讯与会员关联函数
   * ------------------------------------------
   *
   * 资讯与会员关联函数
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
}
