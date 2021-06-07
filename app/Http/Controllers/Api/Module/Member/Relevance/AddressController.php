<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员送货地址控制器类
 */
class AddressController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Address';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/address/list?page={page} 01. 会员地址列表(分页)
   * @apiDescription 获取当前会员送货地址列表(分页)
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 会员地址编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} name 收货人姓名
   * @apiSuccess (basic params) {String} mobile 收货人电话
   * @apiSuccess (basic params) {Number} province_id 省
   * @apiSuccess (basic params) {Number} city_id 市
   * @apiSuccess (basic params) {Number} region_id 县
   * @apiSuccess (basic params) {String} address 详细地址
   * @apiSuccess (basic params) {Number} is_default 是否为默认地址
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/address/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      $response = $this->_model::getPaging($condition, $relevance, $this->_order);

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
   * @api {get} /api/member/address/select 02. 会员地址列表(不分页)
   * @apiDescription 获取当前会员送货地址列表(不分页)
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员地址编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} name 收货人姓名
   * @apiSuccess (basic params) {String} mobile 收货人电话
   * @apiSuccess (basic params) {Number} province_id 省
   * @apiSuccess (basic params) {Number} city_id 市
   * @apiSuccess (basic params) {Number} region_id 县
   * @apiSuccess (basic params) {String} address 详细地址
   * @apiSuccess (basic params) {Number} is_default 是否为默认地址
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/address/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

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
   * @api {get} /api/member/address/view/{id} 03. 当前用户地址详情
   * @apiDescription 获取当前用户地址详情
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员地址编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} name 收货人姓名
   * @apiSuccess (basic params) {String} mobile 收货人电话
   * @apiSuccess (basic params) {Number} province_id 省
   * @apiSuccess (basic params) {Number} city_id 市
   * @apiSuccess (basic params) {Number} region_id 县
   * @apiSuccess (basic params) {String} address 详细地址
   * @apiSuccess (basic params) {Number} is_default 是否为默认地址
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/address/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $where = ['id' => $id];

      $condition = array_merge($condition, $where);

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
   * @api {post} /api/member/address/handle 04. 新建(编辑)会员地址
   * @apiDescription 新建或者编辑当前会员的送货地址信息
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} id 会员地址编号（不存在：新增，存在：编辑）
   * @apiParam {string} name 收货人姓名
   * @apiParam {string} mobile 收货人电话
   * @apiParam {string} province_id 省
   * @apiParam {string} city_id 市
   * @apiParam {string} region_id 县
   * @apiParam {string} address 详细地址
   * @apiParam {string} is_default 是否为默认地址 0 不是 1 是
   *
   * @apiSampleRequest /api/member/address/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'name.required'        => '请您输入收货人姓名',
      'mobile.required'      => '请您输入收货人电话',
      'mobile.regex'         => '收货人电话不合法',
      'province_id.required' => '请您选择省',
      'city_id.required'     => '请您选择市',
      'region_id.required'   => '请您选择县',
      'address.required'     => '请您输入详细地址'
    ];

    $rule = [
      'name'        => 'required',
      'mobile'      => 'required',
      'mobile'      => 'regex:/^1[3456789][0-9]{9}$/',     //正则验证
      'province_id' => 'required',
      'city_id'     => 'required',
      'region_id'   => 'required',
      'address'     => 'required'
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

        // 如果当前设置为默认地址
        if(1 == $request->is_default && empty($model) && 1 != $model->is_default['value'])
        {
          $where = [
            'organization_id' => self::getOrganizationId(),
            'member_id'       => self::getCurrentId(),
            'is_default'      => 1
          ];

          $original = $this->_model::where($where)->first();

          if(!empty($original))
          {
            $original->is_default = 0;
            $original->save();
          }
        }

        $model->organization_id = self::getOrganizationId();
        $model->member_id       = self::getCurrentId();
        $model->name            = $request->name;
        $model->mobile          = $request->mobile;
        $model->province_id     = $request->province_id;
        $model->city_id         = $request->city_id;
        $model->region_id       = $request->region_id;
        $model->address         = $request->address;
        $model->is_default      = $request->is_default ?? 0;

        $response = $model->save();

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
   * @api {post} /api/member/address/delete 05. 删除会员地址
   * @apiDescription 删除当前会员的送货地址信息
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} id 会员地址编号
   *
   * @apiSampleRequest /api/member/address/delete
   * @apiVersion 1.0.0
   */
  public function delete(Request $request)
  {
    try
    {
      $response = $this->_model::remove($request->id);

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
   * @api {get} /api/member/address/default 06. 当前用户默认地址
   * @apiDescription 获取当前用户默认地址详情
   * @apiGroup 08. 会员地址模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员地址编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {String} name 收货人姓名
   * @apiSuccess (basic params) {String} mobile 收货人电话
   * @apiSuccess (basic params) {Number} province_id 省
   * @apiSuccess (basic params) {Number} city_id 市
   * @apiSuccess (basic params) {Number} region_id 县
   * @apiSuccess (basic params) {String} address 详细地址
   * @apiSuccess (basic params) {Number} is_default 是否为默认地址
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/address/default
   * @apiVersion 1.0.0
   */
  public function default(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $where = ['is_default' => 1];

      $condition = array_merge($condition, $where);

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
}
