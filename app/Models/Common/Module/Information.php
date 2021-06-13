<?php
namespace App\Models\Common\Module;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-09
 *
 * 资讯模型类
 */
class Information extends Base
{
  // 表名
  protected $table = "module_information";

  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯与资讯分类关联函数
   * ------------------------------------------
   *
   * 资讯与资讯分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo(
      'App\Models\Common\Module\Flash\Category',
      'category_id',
      'id'
    );
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯与资讯评论关联函数
   * ------------------------------------------
   *
   * 资讯与资讯评论关联函数
   *
   * @return [关联对象]
   */
  public function comment()
  {
    return $this->belongsTo(
      'App\Models\Common\Module\Flash\Comment',
      'flash_id',
      'id'
    );
  }
}
