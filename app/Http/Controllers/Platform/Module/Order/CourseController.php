<?php
namespace App\Http\Controllers\Platform\Module\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 课程订单控制器类
 */
class CourseController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Order\Course';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'order_no',
    'member_id'
  ];

  // 附加关联查询条件
  protected $_addition = [
    'member' => [
      'nickname',
    ],
    'course' => [
      'title',
    ],
    'courseware' => [
      'id',
    ]
  ];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联信息
  protected $_relevance = [
    'list' => [
      'course',
      'courseware',
      'member',
    ],
    'view' => [
      'course',
      'courseware',
      'level',
      'member',
      'address',
    ]
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-16
   * ------------------------------------------
   * 全部订单支付金额
   * ------------------------------------------
   *
   * 获取全部订单支付金额
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function money(Request $request)
  {
    try
    {
      $where = ['pay_status' => 1];

      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter, $where);

      $data = $this->_model::getPluck('pay_money', $condition, false, false, true);

      $response = 0;

      foreach($data as $item)
      {
        $response = bcadd($response, $item, 2);
      }

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
