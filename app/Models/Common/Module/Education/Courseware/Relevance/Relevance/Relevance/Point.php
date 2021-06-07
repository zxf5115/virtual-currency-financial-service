<?php
namespace App\Models\Common\Module\Education\Courseware\Relevance\Relevance\Relevance;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-08
 *
 * 课件知识点模型类
 */
class Point extends Base
{
  // 表名
  public $table = "module_courseware_level_unit_point";

  // 隐藏的属性
  public $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  public $appends = [];

  // 批量添加
  public $fillable = ['id'];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-06
   * ------------------------------------------
   * 课件知识点与课件关联函数
   * ------------------------------------------
   *
   * 课件知识点与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }


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
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-08
   * ------------------------------------------
   * 课件知识点与课件单元关联函数
   * ------------------------------------------
   *
   * 课件知识点与课件单元关联函数
   *
   * @return [关联对象]
   */
  public function unit()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Relevance\Unit', 'unit_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-08
   * ------------------------------------------
   * 课件知识点与会员课件知识点关联函数
   * ------------------------------------------
   *
   * 课件知识点与会员课件知识点关联函数
   *
   * @return [关联对象]
   */
  public function memberPoint()
  {
    return $this->hasMany(
      'App\Models\Common\Module\Member\Relevance\Relevance\Relevance\Point',
      'point_id',
      'id'
    );
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-16
   * ------------------------------------------
   * 注册关联删除
   * ------------------------------------------
   *
   * 注册关联删除
   *
   * @return [type]
   */
  public static function boot()
  {
    parent::boot();

    static::updated(function($model) {
      $model->memberPoint()->update(['status' => -1]);
    });
  }
}
