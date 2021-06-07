<?php
namespace App\Models\Common\Module\Teacher\Recruitment\Relevance\Relevance;

use App\Models\Base;
use App\Enum\Module\Teacher\ShareEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 老师分红收益模型类
 */
class Obtain extends Base
{
  // 表名
  public $table = "module_teacher_share_money_obtain";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'course_id',
    'courseware_id',
    'level_id',
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
   * 结算状态封装
   * ------------------------------------------
   *
   * 结算状态封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getSettlementStatusAttribute($value)
  {
    return ShareEnum::getSettlementStatus($value);
  }

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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课程关联函数
   * ------------------------------------------
   *
   * 会员课程与课程关联函数
   *
   * @return [type]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id')
                ->where(['status'=>1]);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课件关联函数
   * ------------------------------------------
   *
   * 会员课程与课件关联函数
   *
   * @return [type]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id')
                ->where(['status'=>1]);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-28
   * ------------------------------------------
   * 会员课程与课件级别关联函数
   * ------------------------------------------
   *
   * 会员课程与课件级别关联函数
   *
   * @return [type]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id')
                ->where(['status'=>1]);
  }
}
