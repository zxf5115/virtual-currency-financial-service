<?php
namespace App\Http\Controllers\Api\Module\Member\Flash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员快讯利益控制器类
 */
class BenefitController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Flash';



  /**
   * @api {get} /api/member/flash/benefit/bullish 01. 会员利多操作
   * @apiDescription 当前会员会员快讯利多操作
   * @apiGroup 54. 会员快讯利益模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} flash_id 快讯编号
   *
   * @apiSampleRequest /api/member/flash/benefit/bullish
   * @apiVersion 1.0.0
   */
  public function bullish(Request $request)
  {
    $messages = [
      'flash_id.required' => '请您输入快讯编号',
    ];

    $rule = [
      'flash_id' => 'required',
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
        $model = $this->_model::find($request->flash_id);
        $model->increment('bullish_total');

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


  /**
   * @api {get} /api/member/flash/benefit/bearish 02. 会员点赞列表(不分页)
   * @apiDescription 获取当前会员点赞列表(不分页)
   * @apiGroup 54. 会员快讯利益模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiSuccess (字段说明) {Number} id 会员点赞编号
   * @apiSuccess (字段说明) {Number} member_id 会员编号
   * @apiSuccess (字段说明) {Number} course_id 课程编号
   * @apiSuccess (字段说明) {Number} production_id 作品编号
   * @apiSuccess (字段说明) {Number} create_time 点赞时间
   *
   * @apiSampleRequest /api/member/flash/benefit/bearish
   * @apiVersion 1.0.0
   */
  public function bearish(Request $request)
  {
    $messages = [
      'flash_id.required' => '请您输入快讯编号',
    ];

    $rule = [
      'flash_id' => 'required',
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
        $model = $this->_model::find($request->flash_id);
        $model->increment('bearish_total');

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
