<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-02
 *
 * 会员资产控制器类
 */
class AssetController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Asset';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/member/asset/center 01. 资产中心
   * @apiDescription 获取当前会员资产详情
   * @apiGroup 32. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {String} red_envelope 红包金额
   * @apiSuccess (basic params) {String} lollipop 棒棒糖数
   * @apiSuccess (basic params) {String} production 作品数
   *
   * @apiSampleRequest /api/member/asset/center
   * @apiVersion 1.0.0
   */
  public function center(Request $request)
  {
    try
    {
      $status = true;

      $condition = self::getCurrentWhereData();

      $response = $this->_model::getRow($condition);

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
   * @api {post} /api/member/asset/lollipop 02. 我的棒棒糖
   * @apiDescription 获取当前会员棒棒糖
   * @apiGroup 32. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {String} data 棒棒糖数
   *
   * @apiSampleRequest /api/member/asset/lollipop
   * @apiVersion 1.0.0
   */
  public function lollipop(Request $request)
  {
    try
    {
      $status = true;

      $condition = self::getCurrentWhereData();

      $response = $this->_model::getPluck('lollipop', $condition);

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
   * @api {post} /api/member/asset/money 02. 我的红包
   * @apiDescription 获取当前会员棒棒糖
   * @apiGroup 32. 会员资产模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {String} data 红包金额
   *
   * @apiSampleRequest /api/member/asset/money
   * @apiVersion 1.0.0
   */
  public function money(Request $request)
  {
    try
    {
      $status = true;

      $condition = self::getCurrentWhereData();

      $response = $this->_model::getPluck('red_envelope', $condition);

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
