<?php
namespace App\Http\Controllers\Platform\Module\Order\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Common\Express\Company;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-16
 *
 * 课程订单物流控制器类
 */
class LogisticsController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Order\Course\Logistics';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'order_id'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联信息
  protected $_relevance = [];



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 操作信息
   * ------------------------------------------
   *
   * 操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'present_name.required' => '请您输入礼物名称',
      'semester.required'     => '请您输入礼物周期',
      'company_name.required' => '请您输入物流公司',
      'logistics_no.required' => '请您输入物流单号',
    ];

    $rule = [
      'present_name' => 'required',
      'semester'     => 'required',
      'company_name' => 'required',
      'logistics_no' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $company = Company::getRow(['value' => $request->company_name]);

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id  = self::getOrganizationId();
        $model->member_id        = $request->member_id;
        $model->order_id         = $request->order_id;
        $model->present_name     = $request->present_name;
        $model->semester         = $request->semester;
        $model->company_name     = $company->title;
        $model->company_code     = $request->company_name;
        $model->logistics_no     = $request->logistics_no;
        $model->logistics_status = 1;

        $response = $model->save();

        // 更新订单状态
        $order = $model->order;

        $order->order_status = 1;
        $order->save();

        DB::commit();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        DB::rollback();

        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
