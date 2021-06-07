<?php
namespace App\Http\Controllers\Platform\Module\Complain;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 广告控制器类
 */
class ComplainController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Complain\Complain';

  protected $_where = [];

  protected $_params = [
    'category_id',
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
    'select' => [
      'category'
    ],
    'view' => [
      'category'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 阅读投诉
   * ------------------------------------------
   *
   * 阅读投诉
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function read(Request $request)
  {
    try
    {
      $model = $this->_model::find($request->id);

      $model->read_status = 1;

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
