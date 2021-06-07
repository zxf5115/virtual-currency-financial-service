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
 * 分享红包控制器类
 */
class RedEnvelopeController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 5
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/common/redenvelope/data 12. 红包配置
   * @apiDescription 获取学员红包配置
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {Number} invitation_money 邀请用户购买体验课奖励红包(元)
   * @apiSuccess (basic params) {Number} withdrawal_total 红包每天最多提现(次)
   * @apiSuccess (basic params) {Number} withdrawal_money 红包每次最多提现(元)
   * @apiSuccess (basic params) {String} withdrawal_rule 红包提现规则说明
   *
   * @apiSampleRequest /api/common/redenvelope/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($this->_where, $filter);

      $response = $this->_model::getPluck(['value', 'title'], $condition);

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
