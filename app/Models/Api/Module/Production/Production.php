<?php
namespace App\Models\Api\Module\Production;

use App\Models\Common\Module\Production\Production as Common;

use App\Models\Api\Module\Member\Relevance\Archive;
use App\Models\Api\Module\Member\Relevance\Approval;
use App\Models\Api\Module\Member\Relevance\Attention;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品模型类
 */
class Production extends Common
{
  // 追加到模型数组表单的访问器
  public $appends = [
    'is_approval'
  ];

  // 隐藏的属性
  public $hidden = [
    'organization_id',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 当前用户是否点赞封装
   * ------------------------------------------
   *
   * 当前用户是否点赞封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsApprovalAttribute($value)
  {
    try
    {
      $response = false;

      $member_id = auth('api')->user()->id;

      $where = [
        'production_id' => $this->id,
        'member_id' => $member_id
      ];

      $result = Approval::getRow($where);

      if(!empty($result))
      {
        $response = true;
      }

      return $response;
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 获取排序条件
   * ------------------------------------------
   *
   * 获取排序条件
   *
   * @param [type] $type 排序类型 1: 年龄 2: 城市 3: 点赞 4: 关注
   * @param [type] $member_id 当前学员编号
   * @return [type]
   */
  public static function getSortWhereData($request, $member_id)
  {
    $where = [];

    if(1 == $request->type)
    {
      $model = Archive::getRow(['member_id' => $member_id])->getAttributes();

      if(empty($model))
      {
        return false;
      }

      $where['archive'] = ['age' => $model['age']];
    }
    else if(2 == $request->type)
    {
      $model = Archive::getRow(['member_id' => $member_id])->getAttributes();

      if(empty($model))
      {
        return false;
      }

      $where['archive'] = ['city_id' => $model['city_id']];
    }
    else if(3 == $request->type)
    {
      $approval = Approval::getPluck('production_id', ['member_id' => $member_id], false, false, true);

      if(empty($approval))
      {
        return false;
      }

      $where = [['id', $approval]];
    }
    else if(4 == $request->type)
    {
      $attention = Attention::getPluck('attention_member_id', ['member_id' => $member_id], false, false, true);

      if(empty($attention))
      {
        return false;
      }

      $where = [['id', $attention]];
    }

    return $where;
  }



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
    return $this->belongsTo('App\Models\Api\Module\Education\Course\Course', 'course_id', 'id');
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
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Courseware', 'courseware_id', 'id');
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
    return $this->belongsTo('App\Models\Api\Module\Education\Courseware\Relevance\Level', 'level_id', 'id');
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
    return $this->belongsTo('App\Models\Api\Module\Member\Member', 'member_id', 'id');
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
    return $this->belongsTo('App\Models\Api\Module\Member\Relevance\Archive', 'archive_id', 'id');
  }
}
