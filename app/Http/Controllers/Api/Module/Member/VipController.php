<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Events\Api\Member\AttentionEvent;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-19
 *
 * 会员贵宾控制器类
 */
class VipController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Member\Vip';


  /**
   * @api {post} /api/member/vip/status 01. 是否是贵宾
   * @apiDescription 获取当前会员是否是贵宾
   * @apiGroup 30. 会员贵宾模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {Boolean} status 是否贵宾
   *
   * @apiSampleRequest /api/member/vip/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    try
    {
      $status = true;

      $condition = self::getCurrentWhereData('member_id');

      $response = $this->_model::getRow($condition);

      if(empty($response->id))
      {
        $status = false;
      }

      return self::success($status);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/member/vip/handle 02. 开通贵宾
   * @apiDescription 当前会员开通贵宾
   * @apiGroup 30. 会员贵宾模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} vip_id 贵宾编号
   * @apiParam {string} money 贵宾费用
   *
   * @apiSampleRequest /api/member/vip/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'vip_id.required' => '请您输入贵宾编号',
    ];

    $rule = [
      'vip_id' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->member_id = self::getCurrentId();
        $model->vip_id    = $request->vip_id;
        $model->save();

        // 支付
        // event(new PayEvent($response, $request->money));

        DB::commit();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        DB::rollback();

        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
