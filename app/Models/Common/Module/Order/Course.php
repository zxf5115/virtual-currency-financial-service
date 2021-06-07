<?php
namespace App\Models\Common\Module\Order;

use App\Models\Base;
use App\Http\Constant\Status;
use App\Enum\Module\Order\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-15
 *
 * 课程订单模型类
 */
class Course extends Base
{
  // 表名
  protected $table = "module_course_order";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 支付类型封装
   * ------------------------------------------
   *
   * 支付类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getPayTypeAttribute($value)
  {
    return CourseEnum::getTypeStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 订单状态封装
   * ------------------------------------------
   *
   * 订单状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getPayStatusAttribute($value)
  {
    return CourseEnum::getPayStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 支付状态封装
   * ------------------------------------------
   *
   * 支付状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getOrderStatusAttribute($value)
  {
    return CourseEnum::getOrderStatus($value);
  }


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
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Relevance\Address', 'address_id', 'id');
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
    return $this->hasMany('App\Models\Common\Module\Order\Course\Logistics', 'order_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Relevance\Course', 'member_id', 'member_id');
  }
}
