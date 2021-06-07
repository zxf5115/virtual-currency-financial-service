<?php
namespace App\Models\Common\Module\Order;

use App\Models\Base;
use App\Http\Constant\Status;
use App\Enum\Module\Order\GoodsEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-15
 *
 * 商品订单模型类
 */
class Goods extends Base
{
  // 表名
  protected $table = "module_goods_order";

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
   * 兑换类型封装
   * ------------------------------------------
   *
   * 兑换类型封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getExchangeTypeAttribute($value)
  {
    return GoodsEnum::getExchangeStatus($value);
  }

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
    return GoodsEnum::getTypeStatus($value);
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
  public function getPayStatusAttribute($value)
  {
    return GoodsEnum::getPayStatus($value);
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
  public function getOrderStatusAttribute($value)
  {
    return GoodsEnum::getOrderStatus($value);
  }

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
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
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
    return $this->belongsTo('App\Models\Common\Module\Member\Relevance\Address', 'address_id', 'id');
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
    return $this->hasMany('App\Models\Common\Module\Order\Goods\Logistics', 'order_id', 'id');
  }
}
