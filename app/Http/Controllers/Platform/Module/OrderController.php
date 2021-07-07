<?php
namespace App\Http\Controllers\Platform\Module;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Http\Constant\Code;
use App\Exports\OrderExport;
use App\Models\Platform\System\Config;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-29
 *
 * 订单控制器类
 */
class OrderController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Order';

  // 查询条件
  protected $_params = [
    'order_no',
    'order_status',
  ];

  // 附加关联查询条件
  protected $_addition = [
    'courseware' => [
      'title',
    ],
    'member' => [
      'username',
    ],
  ];


  // 关联信息
  protected $_relevance = [
    'list' => [
      'courseware',
      'member',
    ],
    'view' => [
      'courseware',
      'member',
    ]
  ];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-29
   * ------------------------------------------
   * 取消订单
   * ------------------------------------------
   *
   * 取消订单
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function cancel(Request $request)
  {
    $messages = [
      'id.required'  => '请您输入订单编号',
    ];

    $rule = [
      'id' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $model = $this->_model::getRow(['id' => $request->id]);

        $model->order_status = 3;
        $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));

      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-29
   * ------------------------------------------
   * 导出订单
   * ------------------------------------------
   *
   * 导出订单
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function export(Request $request)
  {
    try
    {
      $condition = self::getBaseWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

      $dir = 'public/';

      $filename = 'excel/'. '订单记录_'.time().'.xlsx';

      Excel::store(new OrderExport($response), $dir . $filename);

      $url = Config::getConfigValue('web_url');

      $url = $url . '/storage/' . $filename;

      return self::success($url);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
