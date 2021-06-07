<?php
namespace App\Models\Common\Module\Complain;

use App\Models\Base;
use App\Http\Constant\Status;
use App\Enum\Module\Complain\ComplainEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-18
 *
 * 投诉模型类
 */
class Complain extends Base
{
  // 表名
  protected $table = "module_complain";

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
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 阅读状态封装
   * ------------------------------------------
   *
   * 阅读状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getReadStatusAttribute($value)
  {
    return ComplainEnum::getReadStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 投诉与投诉分类关联函数
   * ------------------------------------------
   *
   * 投诉与投诉分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo('App\Models\Common\Module\Complain\Relevance\Category', 'category_id', 'id')
                ->where(['status'=>1]);
  }
}
