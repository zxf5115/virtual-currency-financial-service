<?php
namespace App\Listeners\Api\Member;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\Api\System\Config;
use App\Models\Api\Module\Goods\Goods;
use App\Events\Api\Member\LollipopEvent;
use App\Models\Api\Module\Member\Relevance\Asset;
use App\Models\Api\Module\Education\Course\Course;
use App\Models\Api\Module\Member\Relevance\Lollipop;

/**
 * 棒棒糖听器
 */
class LollipopListeners
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {

  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-24
   * ------------------------------------------
   * 会员执行操作获取棒棒糖
   * ------------------------------------------
   *
   * 会员执行操作获取棒棒糖 1: 完成课程  2: 上传作品 3: 分享作品
   *
   * @param LollipopEvent $event [description]
   * @return [type]
   */
  public function handle(LollipopEvent $event)
  {
    try
    {
      $user_id   = auth('api')->user()->id;
      $course_id = $event->course_id;
      $unit_id   = $event->unit_id;
      $mode      = $event->mode;
      $type      = $event->type;
      $goods_id  = $event->goods_id;
      $total     = $event->total;

      // 获取棒棒糖
      if(1 == $type)
      {
        $this->obtain($user_id, $course_id, $unit_id, $mode);
      }
      // 消耗棒棒糖
      else if(2 == $type)
      {
        $this->expend($user_id, $course_id, $unit_id, $mode, $goods_id, $total);
      }

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-31
   * ------------------------------------------
   * 获取棒棒糖
   * ------------------------------------------
   *
   * 获取棒棒糖
   *
   * @param [type] $user_id 用户编号
   * @param [type] $course_id 佣金金额
   * @param [type] $unit_id 佣金金额
   * @param [type] $mode 获取模式
   *
   * @return [type]
   */
  private function obtain($user_id, $course_id, $unit_id, $mode)
  {
    try
    {
      $where = [
        'member_id' => $user_id,
        'course_id' => $course_id,
        'unit_id'   => $unit_id,
        'mode'      => $mode
      ];

      $lollipop = Lollipop::getRow($where);

      // 完成每节课程、上传作品、分享作品（只能领取一次）
      if(!empty($lollipop->id))
      {
        return false;
      }

      $course = Course::getRow(['id' => $course_id]);

      if(empty($course))
      {
        \Log::error('获取棒棒糖时，课程信息不存在');

        return fasle;
      }

      $default = '完成课程';

      $config = Config::getRow(['title' => 'finish_course']);

      if(2 == $mode)
      {
        $config = Config::getRow(['title' => 'upload_production']);

        $default = '上传作品';
      }
      else if(3 == $mode)
      {
        $config = Config::getRow(['title' => 'share_production']);

        $default = '分享作品';
      }

      $content = $default . '《' . $course->title .'》';

      $quantity = $config->value;

      $asset = Asset::firstOrCreate(['member_id' => $user_id]);
      $asset->increment('lollipop', $quantity);
      $asset->save();

      $model = new Lollipop();

      $model->member_id = $user_id;
      $model->course_id = $course_id;
      $model->unit_id   = $unit_id;
      $model->mode      = $mode;
      $model->type      = 1;
      $model->content   = $content;
      $model->number    = $quantity;

      $model->save();

      return true;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-31
   * ------------------------------------------
   * 消耗棒棒糖
   * ------------------------------------------
   *
   * 消耗棒棒糖
   *
   * @param [type] $user_id 用户编号
   * @param [type] $course_id 佣金金额
   * @param [type] $unit_id 佣金金额
   * @param [type] $mode 模式
   * @param [type] $goods_id 商品编号
   * @param [type] $total 消耗棒棒糖总数
   *
   * @return [type]
   */
  private function expend($user_id, $course_id, $unit_id, $mode, $goods_id, $total)
  {
    try
    {
      $asset = Asset::firstOrCreate(['member_id' => $user_id]);
      $asset->decrement('lollipop', $total);
      $asset->save();

      $goods = Goods::getRow(['id' => $goods_id]);

      if(empty($goods))
      {
        \Log::error('消耗棒棒糖时，商品信息不存在');

        return false;
      }

      $content = '兑换商品 《' . $goods->title . '》';

      $model = new Lollipop();

      $model->member_id = $user_id;
      $model->course_id = $course_id;
      $model->unit_id   = $unit_id;
      $model->mode      = $mode;
      $model->type      = 2;
      $model->content   = $content;
      $model->number    = $total;

      $model->save();
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
