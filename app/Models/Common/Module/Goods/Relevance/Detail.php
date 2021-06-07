<?php
namespace App\Models\Common\Module\Goods\Relevance;

use App\Models\Base;
use App\Http\Constant\Status;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品详情模型类
 */
class Detail extends Base
{
  // 表名
  protected $table = "module_goods_detail";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = [
    'id',
    'organization_id',
    'content'
  ];

}
