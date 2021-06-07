<?php
namespace App\Models\Api\Module\Order\Course;

use App\Models\Common\Module\Order\Course\Logistics as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-17
 *
 * 课程订单物流模型类
 */
class Logistics extends Common
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
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 物流与订单关联函数
   * ------------------------------------------
   *
   * 物流与订单关联函数
   *
   * @return [关联对象]
   */
  public function order()
  {
    return $this->belongsTo('App\Models\Api\Module\Order\Course', 'order_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 物流与学员关联函数
   * ------------------------------------------
   *
   * 物流与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id');
  }
}
