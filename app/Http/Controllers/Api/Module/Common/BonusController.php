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
 * 奖金控制器类
 */
class BonusController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 7
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/common/bonus/data 15. 老师分红配置
   * @apiDescription 获取老师分红配置
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {Number} student_buy_course 学生购买系统课老师可得分红(元/人)
   * @apiSuccess (basic params) {String} share_money_rule 分红规则
   *
   * @apiSampleRequest /api/common/bonus/data
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
