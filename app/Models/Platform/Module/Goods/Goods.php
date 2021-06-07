<?php
namespace App\Models\Platform\Module\Goods;

use App\Models\Common\Module\Goods\Goods as Common;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品模型类
 */
class Goods extends Common
{

  // 追加到模型数组表单的访问器
  public $appends = [
    'pictureData',
    'pictureList',
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
   * ------------------------------------------
   * 商品图片封装
   * ------------------------------------------
   *
   * 商品图片封装
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
   * 商品图片列表封装
   * ------------------------------------------
   *
   * 商品图片列表封装
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
}
