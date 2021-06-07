<?php
namespace App\Models\Common\Module\Education\Course\Relevance;

use App\Models\Base;
use App\Enum\Module\Education\CourseEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-08
 *
 * 课程分享模型类
 */
class Share extends Base
{
  // 表名
  public $table = "module_course_share";

  // 可以批量修改的字段
  public $fillable = [
    'id'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 隐藏的属性
  public $hidden = [];

}
