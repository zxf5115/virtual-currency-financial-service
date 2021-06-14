<?php
namespace App\Models\Common\Module\Information;

use App\Models\Base;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-09
 *
 * 资讯评论模型类
 */
class Comment extends Base
{
  // 表名
  protected $table = "module_information_comment";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = ['id'];


  // 关联函数 ------------------------------------------------------

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 资讯评论置与资讯关联函数
   * ------------------------------------------
   *
   * 资讯评论置与资讯关联函数
   *
   * @return [关联对象]
   */
  public function information()
  {
    return $this->hasMany(
      'App\Models\Common\Module\Information',
      'information_id',
      'id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-11
   * ------------------------------------------
   * 评论与评论人关联表
   * ------------------------------------------
   *
   * 评论与评论人关联表
   *
   * @return [关联对象]
   */
  public function member()
  {
    return $this->belongsTo(
      'App\Models\Common\Module\Member',
      'member_id',
      'id'
    );
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-11
   * ------------------------------------------
   * 评论与被评论人关联表
   * ------------------------------------------
   *
   * 评论与被评论人关联表
   *
   * @return [关联对象]
   */
  public function bemember()
  {
    return $this->belongsTo(
      'App\Models\Common\Module\Member',
      'be_member_id',
      'id'
    );
  }
}
