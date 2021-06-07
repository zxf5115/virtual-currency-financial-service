<?php
namespace App\Models\Common\Module\Education\Course\Relevance;

use App\Models\Base;
use App\Http\Constant\Status;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 课程图片模型类
 */
class Picture extends Base
{
  // 表名
  protected $table = "module_course_picture";

  // 隐藏的属性
  protected $hidden = [
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];

  // 批量添加
  protected $fillable = [
    'id',
    'organization_id',
    'picture'
  ];

}
