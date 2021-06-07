<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-21
 *
 * 学员账户模型类
 */
class Account extends Base
{
  // 表名
  public $table = "module_member_account";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'member_id',
    'payment_name',
    'payment_account',
  ];

  // 隐藏的属性
  public $hidden = [
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员资产与学员关联表
   * ------------------------------------------
   *
   * 学员资产与学员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
