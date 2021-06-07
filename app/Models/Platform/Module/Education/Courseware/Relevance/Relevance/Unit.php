<?php
namespace App\Models\Platform\Module\Education\Courseware\Relevance\Relevance;

use App\Models\Common\Module\Education\Courseware\Relevance\Relevance\Unit as Common;
use App\Models\Platform\Module\Education\Courseware\Relevance\Relevance\Relevance\Point;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-05
 *
 * 课程级别模型类
 */
class Unit extends Common
{
  // 追加到模型数组表单的访问器
  public $appends = [
    'total'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 课程级别封装
   * ------------------------------------------
   *
   * 课程级别封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTotalAttribute($value)
  {
    $where = [
      'courseware_id' => $this->courseware_id,
      'level_id'      => $this->level_id,
      'unit_id'       => $this->id
    ];

    $response = Point::getCount($where);

    return $response;
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-06
   * ------------------------------------------
   * 课件单元与课件级别关联函数
   * ------------------------------------------
   *
   * 课件单元与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Platform\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }
}
