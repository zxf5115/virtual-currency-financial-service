<?php
namespace App\Models\Api\Module\Education;

use App\Models\Common\Module\Education\Courseware as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-23
 *
 * 课件模型类
 */
class Courseware extends Common
{
  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'sort',
    'status',
    'create_time',
    'update_time'
  ];


  // 追加到模型数组表单的访问器
  public $appends = [
    'point_total'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-25
   * ------------------------------------------
   * 课程知识点数量封装
   * ------------------------------------------
   *
   * 课程知识点数量封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getPointTotalAttribute($value)
  {
    $response = 0;

    if(!empty($this->point))
    {
      $response = count($this->point);

      unset($this->point);
    }

    return $response;
  }


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 课件与课件分类关联函数
   * ------------------------------------------
   *
   * 课件与课件分类关联函数
   *
   * @return [关联对象]
   */
  public function category()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Education\Courseware\Category',
      'category_id',
      'id'
    );
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-08
   * ------------------------------------------
   * 课件与课件老师关联函数
   * ------------------------------------------
   *
   * 课件与课件老师关联函数
   *
   * @return [关联对象]
   */
  public function teacher()
  {
    return $this->belongsTo(
      'App\Models\Api\Module\Education\Courseware\Teacher',
      'teacher_id',
      'id'
    );
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-09-25
   * ------------------------------------------
   * 课件与课件知识点关联函数
   * ------------------------------------------
   *
   * 课件与课件知识点关联函数
   *
   * @return [关联对象]
   */
  public function point()
  {
    return $this->hasMany(
      'App\Models\Api\Module\Education\Courseware\Point',
      'courseware_id',
      'id'
    )->where(['status'=>1]);
  }
}
