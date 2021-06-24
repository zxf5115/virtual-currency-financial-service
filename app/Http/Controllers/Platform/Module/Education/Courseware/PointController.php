<?php
namespace App\Http\Controllers\Platform\Module\Education\Courseware;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-23
 *
 * 课程知识点控制器类
 */
class PointController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Platform\Module\Education\Courseware\Point';

  // 客户端搜索字段
  protected $_params = [
    'title',
    'courseware_id'
  ];

  // 排序方式
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联对象
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
      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = self::getOrganizationId();
        $model->courseware_id   = $request->courseware_id;
        $model->title           = $request->title;
        $model->picture         = $request->picture;
        $model->url             = $request->url;
        $model->sort            = $request->sort;
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
}