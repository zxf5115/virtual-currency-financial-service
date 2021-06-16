<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-10
 *
 * 设置控制器类
 */
class SettingController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Member\Setting';


  /**
   * @api {get} /api/member/setting/data 01. 我的设置
   * @apiDescription 获取我的设置详情
   * @apiGroup 28. 会员设置模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {String} order_switch 订单开关
   * @apiSuccess (字段说明) {String} activity_switch 活动开关
   *
   * @apiSampleRequest /api/member/setting/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('member_id');

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {post} /api/member/setting/handle 03. 推送设置
   * @apiDescription 当前会员设置推送开关
   * @apiGroup 28. 会员设置模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} order_switch 订单开关
   * @apiParam {string} activity_switch 活动开关
   *
   * @apiSampleRequest /api/member/setting/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'order_switch.required'    => '请您输入订单开关',
      'activity_switch.required' => '请您输入活动开关',
    ];

    $rule = [
      'order_switch'    => 'required',
      'activity_switch' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $model = $this->_model::getRow(['member_id' => self::getCurrentId()]);
        $model->order_switch    = $request->order_switch;
        $model->activity_switch = $request->activity_switch;
        $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
