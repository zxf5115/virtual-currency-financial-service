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
 * 棒棒糖控制器类
 */
class LollipopController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 6
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/common/lollipop/data 09. 棒棒糖配置数据
   * @apiDescription 获取棒棒糖配置数据
   * @apiGroup 02. 公共模块
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} finish_course 完成每节课程(个)
   * @apiSuccess (basic params) {String} upload_production 上传作品(个)
   * @apiSuccess (basic params) {Number} share_production 分享自己作品(个)
   * @apiSuccess (basic params) {Number} lollipop_rule 棒棒糖使用规则说明
   *
   * @apiSampleRequest /api/common/lollipop/data
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
