<?php
namespace App\Http\Controllers\Platform\Module\Goods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-19
 *
 * 商品控制器类
 */
class GoodsController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Platform\Module\Goods\Goods';

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
    'view' => [
      'detail',
      'picture'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-19
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
      'title.required'          => '请您输入商品名称',
      'cover.required'          => '请您输入商品图片',
      'description.required'    => '请您输入商品描述',
      'content.required'        => '请您输入商品内容',
      'lollipop_total.required' => '请您输入商品棒棒糖兑换数量',
      'cash_money.required'     => '请您输入商品现金价格',
    ];

    $rule = [
      'title'          => 'required',
      'cover'          => 'required',
      'description'    => 'required',
      'content'        => 'required',
      'lollipop_total' => 'required',
      'cash_money'     => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = self::getOrganizationId();
        $model->title           = $request->title;
        $model->cover           = $request->cover;
        $model->description     = $request->description;
        $model->lollipop_total  = $request->lollipop_total;
        $model->cash_money      = $request->cash_money;
        $model->exchange_total  = $request->exchange_total ?? 0;
        $model->status          = intval($request->status);

        $response = $model->save();

        $data = [
          'content' => $request->content
        ];

        if(!empty($data))
        {
          $model->detail()->delete();

          $model->detail()->create($data);
        }

        $picture = self::packRelevanceData($request, 'picture');

        if(!empty($picture))
        {
          $model->picture()->delete();

          $model->picture()->createMany($picture);
        }

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


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-05
   * ------------------------------------------
   * 启用（停用）课程类型
   * ------------------------------------------
   *
   * 启用（停用）课程类型
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
