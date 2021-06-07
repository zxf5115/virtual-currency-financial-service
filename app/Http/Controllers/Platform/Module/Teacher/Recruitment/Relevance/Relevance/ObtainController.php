<?php
namespace App\Http\Controllers\Platform\Module\Teacher\Recruitment\Relevance\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 招聘老师分红获取控制器类
 */
class ObtainController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Platform\Module\Teacher\Recruitment\Relevance\Relevance\Obtain';

  /**
   * 基本查询条件
   */
  protected $_where = [];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [
    'extract_id',
  ];

  /**
   * 关联查询字段
   */
  protected $_addition = [];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [
    'list' => [
      'member',
      'course',
      'courseware'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-03-03
   * ------------------------------------------
   * 获取分红提取列表
   * ------------------------------------------
   *
   * 获取分红提取列表
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      // 获取当前老师的班级
      $response = $this->_model::getPaging($condition, $relevance);

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
