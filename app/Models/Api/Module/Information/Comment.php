<?php
namespace App\Models\Api\Module\Information;

use App\Models\Common\Module\Information\Comment as Common;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 资讯评论模型类
 */
class Comment extends Common
{
  use \Awobaz\Compoships\Compoships;

  // 隐藏的属性
  protected $hidden = [
    'organization_id',
    'information_id',
    'member_id',
    'status',
    'update_time'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-07-31
   * ------------------------------------------
   * 获取子集数据
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param [type] $data [description]
   * @return [type]
   */
  public static function getChildData($data)
  {
    try
    {
      $response = [];

      if(empty($data))
      {
        $data;
      }

      foreach($data as $key => $item)
      {
        $where = [
          'parent_id' => $item['id']
        ];

        $order = [['key' => 'create_time', 'value' => 'desc']];

        $response = self::getList($where, 'member', $order, true);

        if(empty($response))
        {
          continue;
        }

        $data[$key]['child'] = $response;
      }

      return $data;
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      record($e);

      return self::error(Code::ERROR);
    }
  }


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
      'App\Models\Api\Module\Information',
      'information_id',
      'id'
    );
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-09
   * ------------------------------------------
   * 无限评论封装
   * ------------------------------------------
   *
   * 无限评论封装
   *
   * @return [type]
   */
  public function children()
  {
    return $this->hasMany(__CLASS__, 'information_id', 'information_id')
                ->where([['parent_id', '<>', 0], 'status'=>1])
                ->orderBy('create_time', 'desc')
                ->limit(3);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-08-03
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
      'App\Models\Api\Module\Member',
      'be_member_id',
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
      'App\Models\Api\Module\Member',
      'member_id',
      'id'
    );
  }
}
