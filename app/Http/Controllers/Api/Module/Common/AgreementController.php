<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 协议控制器类
 */
class AgreementController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config\Agreement';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [];

  protected $_relevance = [];


  /**
   * @api {get} /api/common/agreement/user 05. 用户协议
   * @apiDescription 获取系统的用户协议
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {String} name 协议名称
   * @apiSuccess (basic params) {String} content 协议内容
   *
   * @apiSampleRequest /api/common/agreement/user
   * @apiVersion 1.0.0
   */
  public function user(Request $request)
  {
    try
    {
      $response = $this->_model::getRow(['title' => 'user_agreement']);

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
   * @api {get} /api/common/agreement/about 06. 关于我们
   * @apiDescription 获取系统的关于我们
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {String} name 协议名称
   * @apiSuccess (basic params) {String} content 协议内容
   *
   * @apiSampleRequest /api/common/agreement/about
   * @apiVersion 1.0.0
   */
  public function about(Request $request)
  {
    try
    {
      $response = $this->_model::getRow(['title' => 'about']);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
