<?php
namespace App\Http\Controllers\Platform\Module\Education\Courseware\Relevance\Relevance\Relevance;

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
class PointController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Courseware\Relevance\Relevance\Relevance\Point';

  protected $_where = [];

  protected $_params = [
    'title',
    'courseware_id',
    'level_id',
    'unit_id'
  ];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'courseware',
      'level',
      'unit',
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
      'title.required'   => '请您输入知识点名字',
      'picture.required' => '请您输入知识点封面',
      'url.required'     => '请您输入视频地址',
    ];

    $rule = [
      'title'   => 'required',
      'picture' => 'required',
      'url'     => 'required',
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
      $model->level_id        = $request->level_id;
      $model->unit_id         = $request->unit_id;
      $model->title           = $request->title;
      $model->picture         = $request->picture;
      $model->url             = $request->url;
      $model->sort            = $request->sort;

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
