<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Models\Api\System\Config;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 会员任务指标控制器类
 */
class TargetController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Target';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/target/progress 01. 会员任务指标进度
   * @apiDescription 获取当前会员成为招生老师的任务指标进度
   * @apiGroup 11. 会员任务指标模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} course_total 购买课程总数
   * @apiSuccess (basic params) {String} invitation_total 邀请他人购买体验课程总数
   * @apiSuccess (basic params) {Number} upload_total 上传作品总数
   * @apiSuccess (basic params) {Number} create_time 创建时间
   *
   * @apiSampleRequest /api/member/target/progress
   * @apiVersion 1.0.0
   */
  public function progress(Request $request)
  {
    try
    {
      $response = [
        'course_total'     => 0,
        'invitation_total' => 0,
        'upload_total'     => 0,
      ];

      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'progress');

      $result = $this->_model::getRow($condition, $relevance);

      if(!empty($result))
      {
        $response = $result;
      }

      $target = Config::where(['category_id' => 4])->pluck('value', 'title');

      $response['target'] = $target;

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
