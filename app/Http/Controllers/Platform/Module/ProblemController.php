<?php
namespace App\Http\Controllers\Platform\Module;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-22
 *
 * 常见问题控制器类
 */
class ProblemController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Common\Module\Problem';

  protected $_where = [];

  protected $_params = [
    'title'
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'category'
    ],
    'select' => false,
    'view' => false,
  ];


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
      'category_id.required' => '请您选择分类标题',
      'title.required'   => '请您输入问题标题',
      'content.required' => '请您输入问题答案',
    ];

    $rule = [
      'category_id' => 'required',
      'title' => 'required',
      'content' => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      $model = $this->_model::firstOrNew(['id' => $request->id]);

      $model->organization_id  = self::getOrganizationId();
      $model->category_id     = $request->category_id;
      $model->title            = $request->title;
      $model->content          = $request->content;

      $response = $model->save();

      if($response)
      {
        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      else
      {
        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }

}
