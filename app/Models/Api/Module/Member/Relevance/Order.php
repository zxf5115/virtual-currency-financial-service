<?php
namespace App\Models\Api\Module\Member\Relevance;

use App\Models\Common\Module\Member\Relevance\Order as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 会员订单模型类
 */
class Order extends Common
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
   * @dateTime 2020-12-26
   * ------------------------------------------
   * 会员订单与学员关联表
   * ------------------------------------------
   *
   * 会员订单与学员关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
      return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-26
   * ------------------------------------------
   * 会员订单与课程关联表
   * ------------------------------------------
   *
   * 会员订单与课程关联表
   *
   * @return [关联对象]
   */
  public function course()
  {
      return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id')
                  ->where(['status'=>1]);
  }
}
