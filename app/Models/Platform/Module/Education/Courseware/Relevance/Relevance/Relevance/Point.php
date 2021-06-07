<?php
namespace App\Models\Platform\Module\Education\Courseware\Relevance\Relevance\Relevance;

use App\Models\Common\Module\Education\Courseware\Relevance\Relevance\Relevance\Point as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-05
 *
 * 课程级别模型类
 */
class Point extends Common
{

  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-06
   * ------------------------------------------
   * 课件知识点与课件级别关联函数
   * ------------------------------------------
   *
   * 课件知识点与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Platform\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }
}
