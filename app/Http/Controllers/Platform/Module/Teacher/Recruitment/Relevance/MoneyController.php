<?php
namespace App\Http\Controllers\Platform\Module\Teacher\Recruitment\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Platform\Module\Teacher\Recruitment\Relevance\Relevance\Obtain;
use App\Models\Platform\Module\Teacher\Recruitment\Relevance\Relevance\Extract;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 招聘老师分红控制器类
 */
class MoneyController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Teacher\Recruitment\Relevance\Money';

  /**
   * 基本查询条件
   */
  protected $_where = [];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [];

  /**
   * 关联查询字段
   */
  protected $_addition = [];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-02-18
   * ------------------------------------------
   * 招聘老师分红中心
   * ------------------------------------------
   *
   * 招聘老师分红中心
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id, 'member_id');

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 分红结算
   * ------------------------------------------
   *
   * 分红结算
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'id.required' => '请您输入分红老师'
    ];

    $rule = [
      'id' => 'required',
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
        $condition = self::getSimpleWhereData($request->id, 'member_id');

        $model = $this->_model::getRow($condition);

        $wait_money = $model->wait_money;
        $wait_number = $model->wait_number;

        $model->wait_money = 0;
        $model->wait_number = 0;

        $model->save();

        $extract = new Extract();

        $extract->member_id         = $request->id;
        $extract->money             = $wait_money;
        $extract->number            = $wait_number;
        $extract->settlement_status = 1;
        $extract->settlement_time   = time();
        $extract->save();

        $where = [
          'member_id'         => $request->id,
          'settlement_status' => 0
        ];

        $obtain = Obtain::getList($where);

        foreach($obtain as $item)
        {
          $item->extract_id        = $extract->id;
          $item->settlement_status = 1;
          $item->settlement_time   = time();
          $item->save();
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
}
