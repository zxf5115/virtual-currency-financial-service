<?php
namespace App\Http\Controllers\Platform\Module\Education\Courseware\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-05
 *
 * 课程级别控制器类
 */
class LevelController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Courseware\Relevance\Level';

  protected $_where = [];

  protected $_params = [
    'title',
    'courseware_id',
    'status'
  ];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'courseware'
    ]
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
      'minimum_age.required' => '请您输入最小年龄',
      'largest_age.required' => '请您输入最大年龄',
    ];

    $rule = [
      'minimum_age' => 'required',
      'largest_age' => 'required',
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

      $model->organization_id = self::getOrganizationId();
      $model->courseware_id   = $request->courseware_id;
      $model->minimum_age     = $request->minimum_age;
      $model->largest_age     = $request->largest_age;
      $model->description     = $request->description;

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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 启用（停用）课程级别
   * ------------------------------------------
   *
   * 启用（停用）课程级别
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function status(Request $request)
  {
    try
    {
      $model = $this->_model::find($request->id);

      $model->status = $model->status['value'] == 1 ? 2 : 1;

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
