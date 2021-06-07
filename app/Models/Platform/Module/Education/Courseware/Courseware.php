<?php
namespace App\Models\Platform\Module\Education\Courseware;

use App\Models\Common\Module\Education\Courseware\Courseware as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-05
 *
 * 课件模型类
 */
class Courseware extends Common
{
  // 追加到模型数组表单的访问器
  public $appends = [
    'valid_time',
    'time_limit',
    'is_delete'
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 循环课程起止时间封装
   * ------------------------------------------
   *
   * 循环课程起止时间封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getValidTimeAttribute($value)
  {
    return [
      $this->start_time,
      $this->end_time
    ];
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 课程限时封装
   * ------------------------------------------
   *
   * 课程限时封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getTimeLimitAttribute($value)
  {
    $response = '永久';

    $attribute = $this->getAttributes();

    if($attribute['is_permanent'] == 2)
    {
      $response = date('Y-m-d', $attribute['start_time']) . ' - ' . date('Y-m-d', $attribute['end_time']);
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 是否可以删除封装
   * ------------------------------------------
   *
   * 是否可以删除封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsDeleteAttribute($value)
  {
    $response = false;

    $attribute = $this->getAttributes();

    if($attribute['is_permanent'] == 2 && time() > $attribute['end_time'])
    {
      $response = true;
    }

    return $response;
  }
}
