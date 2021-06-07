<?php
namespace App\Http\Controllers\Api\Module\Education\Course\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-14
 *
 * 课程分享控制器类
 */
class ShareController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Education\Course\Relevance\Share';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [];


  /**
   * @api {get} /api/education/course/share/data 01. 课程分享数据
   * @apiDescription 获取课程解锁详情
   * @apiGroup 47. 课程分享模块
   *
   * @apiParam {int} course_id 课程编号（不能为空）
   *
   * @apiSuccess (basic params) {Number} picture 分享图片
   *
   * @apiSampleRequest /api/education/course/share/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData($request->course_id, 'course_id');

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
}
