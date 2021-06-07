<?php
namespace App\Models\Common\Module\Goods;

use App\Models\Base;
use App\Http\Constant\Status;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品模型类
 */
class Goods extends Base
{
  // 表名
  protected $table = "module_goods";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


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
    return $this->hasOne('App\Models\Common\Module\Goods\Relevance\Detail', 'goods_id', 'id');
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
    return $this->hasMany('App\Models\Common\Module\Goods\Relevance\Picture', 'goods_id', 'id');
  }
}
