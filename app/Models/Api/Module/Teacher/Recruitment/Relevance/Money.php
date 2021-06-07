<?php
namespace App\Models\Api\Module\Teacher\Recruitment\Relevance;

use App\Models\Common\Module\Teacher\Recruitment\Relevance\Money as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 分红模型类
 */
class Money extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'create_time',
    'update_time'
  ];

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
      return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id')
                  ->where(['status'=>1]);
  }
}
