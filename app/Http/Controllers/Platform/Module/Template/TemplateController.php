<?php
namespace App\Http\Controllers\Platform\Module\Template;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 模板控制器类
 */
class TemplateController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Template\Template';

  protected $_where = [];

  protected $_params = [
    'position_id',
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-12
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
      'title.required'        => '请您输入模板名称',
      'picture.required'      => '请您输入模板图片',
      'left_top.required'     => '请您输入左上坐标点',
      'left_bottom.required'  => '请您输入左下坐标点',
      'right_top.required'    => '请您输入右上坐标点',
      'right_bottom.required' => '请您输入右下坐标点',
    ];

    $rule = [
      'title'        => 'required',
      'picture'      => 'required',
      'left_top'     => 'required',
      'left_bottom'  => 'required',
      'right_top'    => 'required',
      'right_bottom' => 'required',
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
        $model->picture         = $request->picture;
        $model->left_top        = $request->left_top;
        $model->left_bottom     = $request->left_bottom;
        $model->right_top       = $request->right_top;
        $model->right_bottom    = $request->right_bottom;
        $model->sort            = $request->sort ?? 0;

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
