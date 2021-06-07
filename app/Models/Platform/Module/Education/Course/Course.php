<?php
namespace App\Models\Platform\Module\Education\Course;

use App\Models\Common\Module\Education\Course\Course as Common;
use App\Models\Common\Module\Education\Course\Relevance\Teacher;
use App\Models\Common\Module\Member\Relevance\Course as MemberCourse;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-09-27
 *
 * 课程模型类
 */
class Course extends Common
{

  // 追加到模型数组表单的访问器
  protected $appends = [
    'apply_time',
    'pictureData',
    'pictureList',
    'recruitment_number',
    'apply_number',
  ];

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-11
   * ------------------------------------------
   * 报名起止时间封装
   * ------------------------------------------
   *
   * 报名起止时间封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getApplyTimeAttribute($value)
  {
    return [
      $this->apply_start_time,
      $this->apply_end_time
    ];
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 课程图片封装
   * ------------------------------------------
   *
   * 课程图片封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getPictureDataAttribute($value)
  {
    $response = [];

    $picture = $this->picture;

    if(!empty($picture))
    {
      $data = $picture->toArray();

      foreach($data as $item)
      {
        $response[] = $item['picture'];
      }
    }

    return $response;
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 课程图片列表封装
   * ------------------------------------------
   *
   * 课程图片列表封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getPictureListAttribute($value)
  {
    $response = [];

    $picture = $this->picture;

    if(!empty($picture))
    {
      $data = $picture->toArray();

      foreach($data as $item)
      {
        $response[]['url'] = $item['picture'];
      }
    }

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 招生老师人数封装
   * ------------------------------------------
   *
   * 招生老师人数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getRecruitmentNumberAttribute($value)
  {
    $where = [
      'course_id'     => $this->id,
      'courseware_id' => $this->courseware_id,
    ];

    $response = Teacher::getCount($where);

    return $response;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 报名人数封装
   * ------------------------------------------
   *
   * 报名人数封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getApplyNumberAttribute($value)
  {
    $where = [
      'course_id'     => $this->id,
      'courseware_id' => $this->courseware_id,
    ];

    $response = MemberCourse::getCount($where);

    return $response;
  }
}
