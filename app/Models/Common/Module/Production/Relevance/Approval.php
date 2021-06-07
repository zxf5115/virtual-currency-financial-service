<?php
namespace App\Models\Common\Module\Production\Relevance;

use App\Models\Base;
use App\Http\Constant\Status;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品点赞模型类
 */
class Approval extends Base
{
  // 表名
  protected $table = "module_production_approval";

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
    'member_id',
    'course_id',
    'production_id',
  ];



  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品点赞与作品关联函数
   * ------------------------------------------
   *
   * 作品点赞与作品关联函数
   *
   * @return [关联对象]
   */
  public function production()
  {
    return $this->belongsTo('App\Models\Common\Module\Production\Production', 'production_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品点赞与学员关联函数
   * ------------------------------------------
   *
   * 作品点赞与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
  }
}
