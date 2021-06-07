<?php
namespace App\Models\Common\Module\Order\Goods;

use App\Models\Base;
use App\Http\Constant\Status;
use App\Enum\Module\Order\Course\LogisticsEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-17
 *
 * 商品订单物流模型类
 */
class Logistics extends Base
{
  // 表名
  protected $table = "module_goods_order_logistics";

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
    return $this->belongsTo('App\Models\Common\Module\Order\Goods', 'order_id', 'id');
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
}
