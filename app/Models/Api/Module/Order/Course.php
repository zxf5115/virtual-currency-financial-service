<?php
namespace App\Models\Api\Module\Order;

use App\Models\Common\Module\Order\Course as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 课程订单模型类
 */
class Course extends Common
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
   * 课程订单与课程关联函数
   * ------------------------------------------
   *
   * 课程订单与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-15
   * ------------------------------------------
   * 课程订单与课件关联函数
   * ------------------------------------------
   *
   * 课程订单与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 课程订单与课件级别关联函数
   * ------------------------------------------
   *
   * 课程订单与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 课程订单与学员关联函数
   * ------------------------------------------
   *
   * 课程订单与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 课程订单与收货地址关联函数
   * ------------------------------------------
   *
   * 课程订单与收货地址关联函数
   *
   * @return [关联对象]
   */
  public function address()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Relevance\Address', 'address_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 课程订单与物流关联函数
   * ------------------------------------------
   *
   * 课程订单与物流关联函数
   *
   * @return [关联对象]
   */
  public function logistics()
  {
    return $this->hasOne('App\Models\Api\Module\Order\Course\Logistics', 'order_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 课程订单与会员课程关联函数
   * ------------------------------------------
   *
   * 课程订单与会员课程关联函数
   *
   * @return [关联对象]
   */
  public function memberCourse()
  {
    return $this->belongsTo('App\Models\Api\Module\Member\Relevance\Course', 'member_id', 'member_id');
  }
}
