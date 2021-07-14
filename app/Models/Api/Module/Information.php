<?php
namespace App\Models\Api\Module;

use App\Enum\Common\TimeEnum;
use App\Models\Common\Module\Information as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 资讯模型类
 */
class Information extends Common
{

  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'category_id',
    'member_id',
    'audit_status',
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
   * 资讯与资讯分类关联函数
   * ------------------------------------------
   *
   * 资讯与资讯分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Information\Category',
      'category_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-07-14
   * ------------------------------------------
   * 资讯与资讯专题关联函数
   * ------------------------------------------
   *
   * 资讯与资讯专题关联函数
   *
   * @return [关联对象]
   */
  public function subject()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Information\Subject',
      'subject_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯与标签关联函数
   * ------------------------------------------
   *
   * 资讯与标签关联函数
   *
   * @return [关联对象]
   */
  public function label()
  {
    return $this->belongsToMany(
      'App\Models\Api\Module\Label',
      'module_information_label',
      'information_id',
      'label_id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯与资讯标签关联函数
   * ------------------------------------------
   *
   * 资讯与资讯标签关联函数
   *
   * @return [关联对象]
   */
  public function labelRelevance()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Information\Label',
      'information_id',
      'id',
    );
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯与资讯评论关联函数
   * ------------------------------------------
   *
   * 资讯与资讯评论关联函数
   *
   * @return [关联对象]
   */
  public function comment()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Information\Comment',
      'information_id',
      'id'
    );
  }
}
