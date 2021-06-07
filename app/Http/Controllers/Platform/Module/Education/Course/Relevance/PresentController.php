<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Education\Course\Relevance\Question;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程礼包控制器类
 */
class PresentController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Relevance\Present';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联数组
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
      'title.required'   => '请您输入礼包名称',
    ];

    $rule = [
      'title' => 'required'
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = self::getOrganizationId();
        $model->title           = $request->title;
        $model->description     = $request->description ?? '';

        $response = $model->save();

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
}
