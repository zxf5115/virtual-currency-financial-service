<?php
namespace App\Http\Controllers\Platform\Module\Teacher\Management;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\TraitClass\ToolTrait;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Member\Relevance\Archive;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 用户控制器类
 */
class TeacherController extends BaseController
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
      'role_id' => 2
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

        $model->username = $request->username;
        $model->nickname = $request->nickname;
        $model->avatar   = $request->avatar ?: '';
        $model->qr_code  = $request->qr_code ?: '';

        $response = $model->save();

        $data = [['role_id' => 2]];

        if(!empty($data))
        {
          $model->relevance()->delete();

          $model->relevance()->createMany($data);
        }

        $data = [
          'member_id'   => $model->id
        ];

        if(!empty($data))
        {
          $archive = Archive::firstOrNew($data);

          $archive->id_card_no  = $request->id_card_no ?? '';
          $archive->sex         = $request->sex ?? '';
          $archive->weixin      = $request->weixin ?? '';
          $archive->province_id = $request->province_id ?? '';
          $archive->city_id     = $request->city_id ?? '';
          $archive->region_id   = $request->region_id ?? '';
          $archive->address     = $request->address ?? '';

          $archive->save();
        }

        $data = ['red_envelope' => 0.00, 'lollipop' => 0, 'production' => 0];

        $model->asset()->delete();
        $model->asset()->create($data);

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
   * @dateTime 2020-12-25
   * ------------------------------------------
   * 禁用（解禁）老师账户
   * ------------------------------------------
   *
   * 禁用（解禁）老师账户
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
