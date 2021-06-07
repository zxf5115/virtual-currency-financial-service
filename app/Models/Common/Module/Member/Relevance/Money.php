<?php
namespace App\Models\Common\Module\Member\Relevance;

use App\Models\Base;
use App\Enum\Module\Member\Relevance\MoneyEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 学员红包模型类
 */
class Money extends Base
{
  // 表名
  public $table = "module_member_money";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
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
   * 红包类型封装
   * ------------------------------------------
   *
   * 红包类型封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getTypeAttribute($value)
  {
    return MoneyEnum::getTypeStatus($value);
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 是否添加了家长微信封装
   * ------------------------------------------
   *
   * 是否添加了家长微信封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getAuditTypeAttribute($value)
  {
    return MoneyEnum::getAuditTypeStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 报名状态封装
   * ------------------------------------------
   *
   * 报名状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getWithdrawalTypeAttribute($value)
  {
    return MoneyEnum::getWithdrawalTypeStatus($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 报名状态封装
   * ------------------------------------------
   *
   * 报名状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getWithdrawalStatusAttribute($value)
  {
    return MoneyEnum::getWithdrawalStatus($value);
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员红包与学员关联表
   * ------------------------------------------
   *
   * 学员红包与学员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员红包与学员账户关联表
   * ------------------------------------------
   *
   * 学员红包与学员账户关联表
   *
   * @return [关联对象]
   */
  public function account()
  {
      return $this->belongsTo('App\Models\Common\Module\Member\Relevance\Account', 'member_id', 'member_id')
                  ->where(['status'=>1]);
  }
}
