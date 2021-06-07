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
 * 任务指标控制器类
 */
class TargetController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 4
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/common/target/data 04. 任务指标
   * @apiDescription 获取成为招生老师的任务指标
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} course_total 购买课程目标总数
   * @apiSuccess (basic params) {String} invitation_total 邀请他人购买课程目标总数
   * @apiSuccess (basic params) {Number} upload_total 上传作品目标总数
   * @apiSuccess (basic params) {Number} create_time 创建时间
   *
   * @apiSampleRequest /api/common/target/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($this->_where, $filter);

      $response = $this->_model::getList($condition);

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
