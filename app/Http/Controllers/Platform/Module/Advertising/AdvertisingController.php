<?php
namespace App\Http\Controllers\Platform\Module\Advertising;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\Module\Advertising\Position;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 广告控制器类
 */
class AdvertisingController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Advertising\Advertising';

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

  protected $_relevance = [
    'list' => [
      'position'
    ],
    'select' => [
      'position'
    ],
    'view' => [
      'position'
    ]
  ];


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
      'position_id.required' => '请您输入广告位标题',
      'title.required'       => '请您输入广告标题',
    ];

    $rule = [
      'position_id' => 'required',
      'title'       => 'required',
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

        if(1 == $request->type)
        {
          $request->link = '';
          $request->goods_id = '';
        }
        else if(2 == $request->type)
        {
          $request->link = '';
          $request->course_id = '';
        }
        else
        {
          $request->course_id = '';
          $request->goods_id = '';
        }


        $model->organization_id = self::getOrganizationId();
        $model->position_id     = $request->position_id;
        $model->title           = $request->title;
        $model->picture         = $request->picture;
        $model->url             = $request->url;
        $model->type            = $request->type;
        $model->link            = $request->link ?? '';
        $model->course_id       = $request->course_id ?? '';
        $model->goods_id        = $request->goods_id ?? '';
        $model->sort            = $request->sort;

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
