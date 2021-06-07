<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Yansongda\Pay\Log;
use Yansongda\Pay\Pay;
use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use Yansongda\Pay\Exceptions\GatewayException;

use App\Models\Api\System\Config;
use App\Events\Api\Member\MoneyEvent;
use App\Events\Api\Member\TargetEvent;
use App\Models\Api\Module\Order\Goods;
use App\Models\Api\Module\Order\Course;
use App\Models\Api\Module\Member\Member;
use App\Events\Api\Member\Order\GoodsEvent;
use App\Events\Api\Member\Order\CourseEvent;
use App\Events\Api\Member\Course\TeacherEvent;
use App\Events\Api\Member\Course\UnitPointEvent;
use App\Events\Api\Member\Share\MoneyEvent as ShareMoneyEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-19
 *
 * 微信控制器类
 */
class WechatController extends BaseController
{

  /**
   * @api {post} /api/common/wechat/notify 07. 微信支付回调
   * @apiDescription 获取微信支付回调
   * @apiGroup 02. 公共模块
   *
   * @apiSampleRequest /api/common/wechat/notify
   * @apiVersion 1.0.0
   */
  public function notify(Request $request)
  {
    DB::beginTransaction();

    try
    {
      Log::info('微信支付回调开始 <================ 支付中');

      $config = config('pay.wechat');

      $pay = Pay::wechat($config);

      $data = $pay->verify(); // 验签

      Log::debug('微信回调参数', $data->all());

      $order_no = $data->out_trade_no;

      Log::info('订单编号====' . $order_no);

      $where = [
        'order_no' => $order_no
      ];

      $model = Goods::getRow($where);

      if(!empty($model))
      {
        $model->pay_status = 1;
        $model->pay_time   = time();

        $model->save();

        // $logistics = $model->logistics;

        // foreach($logistics as $item)
        // {
        //   if(2 != $item->logistics_status['value'])
        //   {
        //     $item->logistics_status = 2;
        //     $item->save();
        //   }
        // }

        // 记录兑换总数
        event(new GoodsEvent($model->goods_id));
      }
      else
      {
        $model = Course::getRow($where);

        if(empty($model))
        {
          Log::info('课程订单不存在');

          return false;
        }

        $model->pay_status = 1;
        $model->pay_time   = time();

        $model->save();

        // 记录销售总数
        event(new CourseEvent($model->course_id));

        // 添加课程单元知识点
        event(new UnitPointEvent($model->course_id, $model->courseware_id, $model->level_id, $model->member_id));

        // 报名成功添加管理老师
        event(new TeacherEvent($model->course_id, $model->courseware_id, $model->level_id, $model->member_id));

        // 获取系统课id
        $system_class_id = Config::getConfigValue('system_class');

        // 获取体验课id
        $trial_class_id = Config::getConfigValue('trial_class');

        // 学员购买体验课后
        if($trial_class_id == $model->courseware_id)
        {
          $user = Member::getRow(['id' => $model->member_id]);

          // 如果存在邀请人
          if(!empty($user) && 0 != $user->inviter_id && $model->member_id != $user->inviter_id)
          {
            // 获取红包
            event(new MoneyEvent(1, 0, $user->inviter_id));

            // 成为老师目标
            event(new TargetEvent($user->inviter_id, 2));
          }
        }
        else if($system_class_id == $model->courseware_id)
        {
          // 老师获取分红
          event(new ShareMoneyEvent($model->course_id, $model->courseware_id, $model->level_id, $model->member_id));

          // 成为老师目标
          event(new TargetEvent($model->member_id, 1));
        }
      }

      Log::info('支付成功');

      DB::commit();

      return $pay->success()->send();
    }
    catch(\Exception $e)
    {
      DB::rollback();

      $content = '在文件 ' . $e->getFile();
      $content .= ' 的 ' . $e->getLine();
      $content .= ' 行 ' .$e->getMessage();

      Log::info('支付失败====' . $content);
    }
  }
}
