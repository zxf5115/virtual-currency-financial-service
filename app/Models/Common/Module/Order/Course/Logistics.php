<?php
namespace App\Models\Common\Module\Order\Course;

use App\Models\Base;
use App\Http\Constant\Status;
use App\Enum\Module\Order\Course\LogisticsEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-17
 *
 * 物流物流模型类
 */
class Logistics extends Base
{
  // 表名
  protected $table = "module_course_order_logistics";

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
   * @dateTime 2021-01-17
   * ------------------------------------------
   * 物流状态封装
   * ------------------------------------------
   *
   * 物流状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getLogisticsStatusAttribute($value)
  {
    return LogisticsEnum::getLogisticsStatus($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-31
   * ------------------------------------------
   * 课程周期封装
   * ------------------------------------------
   *
   * 课程周期封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getSemesterAttribute($value)
  {
    return LogisticsEnum::getSemesterData($value);
  }


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
    return $this->belongsTo('App\Models\Common\Module\Order\Course', 'order_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
  }
}
