<?php
namespace App\Http\Controllers\Platform\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-29
 *
 * 用户控制器类
 */
class MemberController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Platform\Module\Member\Member';

  /**
   * 基本查询条件
   */
  protected $_where = [
    'relevance' => [
      'role_id' => 3
    ]
  ];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [
    'username',
    'nickname'
  ];

  /**
   * 关联查询字段
   */
  protected $_addition = [
    'archive' => [
      'weixin',
    ]
  ];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [
    'list' => [
      'relevance',
      'archive',
      'asset',
    ],
    'select' => [
      'relevance'
    ],
    'view' => [
      'role',
      'relevance',
      'archive',
      'course',
      'asset',
    ],
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
      'username.required' => '请您输入登录账户',
      'username.regex'    => '登录账户不合法',
      'username.unique'   => '登录账户重复',
      'nickname.required' => '请您输入用户昵称',
    ];

    $rule = [
      'username' => 'required',
      'username' => 'unique:module_member,username,' . $request->id,
      'nickname' => 'required',
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

        $organization_id = self::getOrganizationId();

        if(empty($request->id))
        {
          $model->password    = $this->_model::generate(Parameter::PASSWORD);
        }

        if(!preg_match('/^1[345789][0-9]{9}$/', $request->username))
        {
          return self::error(Code::MEMBER_FORMAT_ERROR);
        }

        if(empty($request->id))
        {
          $model->member_no = ToolTrait::generateOnlyNumber(3);
        }

        $model->organization_id = $organization_id;
        $model->username        = $request->username;
        $model->nickname        = $request->nickname;
        $model->avatar          = $request->avatar ?: '';
        $model->email           = $request->email ?: '';
        $model->mobile          = $request->mobile ?: '';
        $model->status          = intval($request->status);

        $data = $this->_model::packRelevanceData($request, 'role_id');

        if(empty($request->role_id))
        {
          return self::error(Code::MEMBER_ROLE_EMPTY);
        }

        $response = $model->save();

        if(!empty($data))
        {
          $model->relevance()->delete();

          $model->relevance()->createMany($data);
        }

        DB::commit();

        if(empty($request->id) && $request->sms_notification)
        {
          // SmsTrait::sendRegistereSms($model->username);
        }

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
   * @dateTime 2020-02-25
   * ------------------------------------------
   * 冻结（解冻）学员账户金额
   * ------------------------------------------
   *
   * 冻结（解冻）学员账户金额
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function freeze(Request $request)
  {
    try
    {
      $model = $this->_model::find($request->id);

      $model->is_freeze = $model->is_freeze['value'] == 1 ? 2 : 1;

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

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-25
   * ------------------------------------------
   * 禁用（解禁）学员账户
   * ------------------------------------------
   *
   * 禁用（解禁）学员账户
   *
   * @param Request $request [description]
   * @return [type]
   */
  public function enable(Request $request)
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
