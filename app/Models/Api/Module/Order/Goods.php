<?php
namespace App\Models\Api\Module\Order;

use App\Models\Common\Module\Order\Goods as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 商品订单模型类
 */
class Goods extends Common
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
   * 商品订单与商品关联函数
   * ------------------------------------------
   *
   * 商品订单与商品关联函数
   *
   * @return [关联对象]
   */
  public function goods()
  {
    return $this->belongsTo('App\Models\Common\Module\Goods\Goods', 'goods_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 商品订单与学员关联函数
   * ------------------------------------------
   *
   * 商品订单与学员关联函数
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
   * 商品订单与收货地址关联函数
   * ------------------------------------------
   *
   * 商品订单与收货地址关联函数
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
   * 商品订单与物流关联函数
   * ------------------------------------------
   *
   * 商品订单与物流关联函数
   *
   * @return [关联对象]
   */
  public function logistics()
  {
    return $this->hasOne('App\Models\Api\Module\Order\Goods\Logistics', 'order_id', 'id');
  }
}
