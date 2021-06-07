<?php
namespace App\Models\Common\Module\Production;

use App\Models\Base;
use App\Http\Constant\Status;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-05
 *
 * 作品模型类
 */
class Production extends Base
{
  // 表名
  protected $table = "module_production";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


  /**
   * 转换属性类型
   */
  protected $casts = [
    'status' => 'array',
    'create_time' => 'datetime:Y-m-d',
    'update_time' => 'datetime:Y-m-d H:i:s',
  ];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与课程关联函数
   * ------------------------------------------
   *
   * 作品与课程关联函数
   *
   * @return [关联对象]
   */
  public function course()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Course\Course', 'course_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与课件关联函数
   * ------------------------------------------
   *
   * 作品与课件关联函数
   *
   * @return [关联对象]
   */
  public function courseware()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与课件级别关联函数
   * ------------------------------------------
   *
   * 作品与课件级别关联函数
   *
   * @return [关联对象]
   */
  public function level()
  {
    return $this->belongsTo('App\Models\Common\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与学员关联函数
   * ------------------------------------------
   *
   * 作品与学员关联函数
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Member', 'member_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与学员档案关联函数
   * ------------------------------------------
   *
   * 作品与学员档案关联函数
   *
   * @return [关联对象]
   */
  public function archive()
  {
    return $this->belongsTo('App\Models\Common\Module\Member\Relevance\Archive', 'archive_id', 'id');
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与作品评论关联函数
   * ------------------------------------------
   *
   * 作品与作品评论关联函数
   *
   * @return [关联对象]
   */
  public function comment()
  {
    return $this->hasMany('App\Models\Common\Module\Production\Relevance\Comment', 'production_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 作品与作品点赞关联函数
   * ------------------------------------------
   *
   * 作品与作品点赞关联函数
   *
   * @return [关联对象]
   */
  public function approval()
  {
    return $this->hasMany('App\Models\Common\Module\Production\Relevance\Approval', 'production_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
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

    static::deleted(function($model) {
      $model->comment()->delete();
      $model->approval()->delete();
    });
  }
}
