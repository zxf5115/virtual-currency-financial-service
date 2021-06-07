<?php
namespace App\Models\Api\Module\Goods;

use App\Models\Common\Module\Goods\Goods as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品模型类
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
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 商品与商品详情关联函数
   * ------------------------------------------
   *
   * 商品与商品详情关联函数
   *
   * @return [关联对象]
   */
  public function detail()
  {
    return $this->hasOne('App\Models\Api\Module\Goods\Relevance\Detail', 'goods_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 商品与商品图片关联函数
   * ------------------------------------------
   *
   * 商品与商品图片关联函数
   *
   * @return [关联对象]
   */
  public function picture()
  {
    return $this->hasMany('App\Models\Api\Module\Goods\Relevance\Picture', 'goods_id', 'id');
  }
}
