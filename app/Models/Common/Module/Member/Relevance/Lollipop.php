<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;
use App\Enum\Module\Member\Relevance\LollipopEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 学员棒棒糖模型类
 */
class Lollipop extends Base
{
  // 表名
  public $table = "module_member_lollipop";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'course_id',
    'mode',
    'type',
    'content',
    'number',
  ];

  // 隐藏的属性
  public $hidden = [
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 棒棒糖类型封装
   * ------------------------------------------
   *
   * 棒棒糖类型封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getTypeAttribute($value)
  {
    return LollipopEnum::getTypeStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员棒棒糖与学员关联表
   * ------------------------------------------
   *
   * 学员棒棒糖与学员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
