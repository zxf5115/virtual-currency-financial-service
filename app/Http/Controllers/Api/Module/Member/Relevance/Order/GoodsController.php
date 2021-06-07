<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Events\Api\Member\MoneyEvent;
use App\Models\Api\Module\Goods\Goods;
use App\Events\Api\Member\LollipopEvent;
use App\Events\Api\Member\Order\PayEvent;
use App\Events\Api\Member\Order\GoodsEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Order\Goods as Order;
use App\Models\Api\Module\Member\Relevance\Address;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-18
 *
 * 会员商品订单控制器类
 */
class GoodsController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Order\Goods';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'goods',
      'member'
    ],
    'select' => [
      'goods',
      'member'
    ],
    'view' => [
      'goods',
      'member',
      'address',
      'logistics'
    ],
  ];


  /**
   * @api {get} /api/member/order/goods/list?page={page} 01. 商品订单列表(分页)
   * @apiDescription 获取当前会员商品订单列表(分页)
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {String} order_no 订单号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} goods_id 商品编号
   * @apiSuccess (basic params) {Number} exchange_type 兑换方式 1 棒棒糖 2 现金
   * @apiSuccess (basic params) {Number} lollipop_total 棒棒糖数量
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (goods params) {Number} id 商品编号
   * @apiSuccess (goods params) {String} title 商品名称
   * @apiSuccess (goods params) {String} cover 商品封面
   * @apiSuccess (goods params) {String} description 商品描述
   * @apiSuccess (goods params) {Number} lollipop_total 兑换需要棒棒糖数量
   * @apiSuccess (goods params) {Number} cash_money 兑换需要现金
   * @apiSuccess (goods params) {Number} exchange_total 已兑换数量
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/order/goods/list
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
   * @api {get} /api/member/order/goods/select 02. 商品订单列表(不分页)
   * @apiDescription 获取当前会员商品订单列表(不分页)
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {String} order_no 订单号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} goods_id 商品编号
   * @apiSuccess (basic params) {Number} exchange_type 兑换方式 1 棒棒糖 2 现金
   * @apiSuccess (basic params) {Number} lollipop_total 棒棒糖数量
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (goods params) {Number} id 商品编号
   * @apiSuccess (goods params) {String} title 商品名称
   * @apiSuccess (goods params) {String} cover 商品封面
   * @apiSuccess (goods params) {String} description 商品描述
   * @apiSuccess (goods params) {Number} lollipop_total 兑换需要棒棒糖数量
   * @apiSuccess (goods params) {Number} cash_money 兑换需要现金
   * @apiSuccess (goods params) {Number} exchange_total 已兑换数量
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSampleRequest /api/member/order/goods/select
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
   * @api {get} /api/member/order/goods/view/{id} 03. 商品订单详情
   * @apiDescription 获取当前会员商品订单的详情
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 订单编号
   *
   * @apiSuccess (basic params) {Number} id 订单编号
   * @apiSuccess (basic params) {String} order_no 订单号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} goods_id 商品编号
   * @apiSuccess (basic params) {Number} exchange_type 兑换方式 1 棒棒糖 2 现金
   * @apiSuccess (basic params) {Number} lollipop_total 棒棒糖数量
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (goods params) {Number} id 商品编号
   * @apiSuccess (goods params) {String} title 商品名称
   * @apiSuccess (goods params) {String} cover 商品封面
   * @apiSuccess (goods params) {String} description 商品描述
   * @apiSuccess (goods params) {Number} lollipop_total 兑换需要棒棒糖数量
   * @apiSuccess (goods params) {Number} cash_money 兑换需要现金
   * @apiSuccess (goods params) {Number} exchange_total 已兑换数量
   *
   * @apiSuccess (member params) {Number} id 会员编号
   * @apiSuccess (member params) {String} open_id 第三方登录编号
   * @apiSuccess (member params) {Number} member_no 会员号
   * @apiSuccess (member params) {String} avatar 会员头像
   * @apiSuccess (member params) {String} username 登录账户
   * @apiSuccess (member params) {String} nickname 会员姓名
   * @apiSuccess (member params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (member params) {Number} create_time 注册时间
   *
   * @apiSuccess (logistics params) {Number} id 订单物流编号
   * @apiSuccess (logistics params) {Number} order_id 订单编号
   * @apiSuccess (logistics params) {Number} member_id 会员编号
   * @apiSuccess (logistics params) {String} company_name 物流公司名称
   * @apiSuccess (logistics params) {String} logistics_no 物流单号
   * @apiSuccess (logistics params) {Number} logistics_status 物流状态 0 待发货 1 待签收 2 已签收
   *
   * @apiSampleRequest /api/member/order/goods/view/{id}
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
   * @api {post} /api/member/order/goods/handle 04. 创建商品订单
   * @apiDescription 当前会员购买商品后，创建商品订单
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} goods_id 商品编号
   * @apiParam {Number} address_id 收货地址编号
   * @apiParam {String} exchange_type 兑换方式 1 棒棒糖 2 现金
   * @apiParam {String} lollipop_total 棒棒糖数量（与支付金额只填写一个默认使用棒棒糖）
   * @apiParam {String} pay_money 支付金额（与棒棒糖数量只填写一个默认使用棒棒糖）
   * @apiParam {Number} pay_type 支付类型 1 支付包 2 微信 3 棒棒糖 4 苹果
   *
   * @apiSampleRequest /api/member/order/goods/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'goods_id.required'      => '请您输入商品编号',
      'address_id.required'    => '请您输入收货地址编号',
      'exchange_type.required' => '请您输入兑换方式',
      'pay_type.required'      => '请您选择支付类型',
    ];

    $rule = [
      'goods_id'      => 'required',
      'address_id'    => 'required',
      'exchange_type' => 'required',
      'pay_type'      => 'required',
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
        // 判断商品是否存在
        $goods = Goods::getRow(['id' => $request->goods_id]);

        if(empty($goods))
        {
          return self::error(Code::GOODS_EMPTY);
        }

        // 判断收货地址是否存在
        $address = Address::getRow(['id' => $request->address_id]);

        if(empty($address))
        {
          return self::error(Code::ADDRESS_EMPTY);
        }

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        if(empty($request->id))
        {
          $rand = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

          $model->order_no = date('YmdHis') . $rand;
        }

        $model->organization_id = self::getOrganizationId();
        $model->member_id       = self::getCurrentId();
        $model->goods_id        = $request->goods_id;
        $model->address_id      = $request->address_id;
        $model->exchange_type   = $request->exchange_type;
        $model->lollipop_total  = $request->lollipop_total ?? 0;
        $model->pay_money       = $request->pay_money ?? 0;
        $model->pay_type        = $request->pay_type;

        $model->save();

        return self::success($model);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }


  /**
   * @api {post} /api/member/order/goods/change 09. 修改商品订单
   * @apiDescription 当前会员修改修改商品订单
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} order_id 订单编号
   * @apiParam {Number} address_id 收货地址编号
   * @apiParam {Number} pay_type 支付类型 1 支付包 2 微信 4 苹果
   *
   * @apiSampleRequest /api/member/order/goods/change
   * @apiVersion 1.0.0
   */
  public function change(Request $request)
  {
    $messages = [
      'order_id.required'      => '请您输入订单编号',
      'address_id.required'    => '请您输入收货地址编号',
      'pay_type.required'      => '请您选择支付类型',
    ];

    $rule = [
      'order_id'      => 'required',
      'address_id'    => 'required',
      'pay_type'      => 'required',
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
        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->order_id];

        $where = array_merge($condition, $where);

        // 判断商品是否存在
        $goods = Order::getRow($where);

        if(empty($goods))
        {
          return self::error(Code::CURRENT_ORDER_EMPTY);
        }

        if(0 != $goods->pay_status['value'])
        {
          return self::error(Code::CURRENT_ORDER_NO_CHANGE);
        }

        $goods->address_id = $request->address_id;
        $goods->pay_type   = $request->pay_type;

        $goods->save();

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


  /**
   * @api {post} /api/member/order/goods/pay 05. 订单支付确认
   * @apiDescription 当前会员支付完成后，调用接口更改订单支付状态
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} order_id 订单编号
   *
   * @apiSampleRequest /api/member/order/goods/pay
   * @apiVersion 1.0.0
   */
  public function pay(Request $request)
  {
    $messages = [
      'order_id.required' => '请您输入订单编号',
    ];

    $rule = [
      'order_id' => 'required',
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
        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->order_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        // 支付方式：棒棒糖
        if(1 == $model->exchange_type['value'])
        {
          $model->pay_status = 1;
          $model->pay_time   = time();

          $model->save();

//           $logistics = $goods->logistics;
// dd($logistics);
//           foreach($logistics as $item)
//           {
//             if(2 != $item->logistics_status['value'])
//             {
//               $item->logistics_status = 2;
//               $item->save();
//             }
//           }

          // 记录兑换总数
          event(new GoodsEvent($model->goods_id));

          // 消耗棒棒糖
          event(new LollipopEvent(0, 0, 4, 2, $model->goods_id, $model->lollipop_total));

          $response = Code::message(Code::HANDLE_SUCCESS);
        }
        else
        {
          // 支付
          $result = event(new PayEvent($model));

          if(empty($result[0]))
          {
            return self::error(Code::PAY_ERROR);
          }

          $response = $result[0];
        }

        DB::commit();

        return self::success($response);
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
   * @api {post} /api/member/order/goods/finish 08. 商品订单完成
   * @apiDescription 当前会员收到货物后，点击完成商品订单
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} order_id 订单编号
   *
   * @apiSampleRequest /api/member/order/goods/finish
   * @apiVersion 1.0.0
   */
  public function finish(Request $request)
  {
    $messages = [
      'order_id.required' => '请您输入订单编号',
    ];

    $rule = [
      'order_id' => 'required',
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
        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->order_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        $model->order_status = 2;

        $model->save();

        $logistics = $model->logistics;

        if(!empty($logistics))
        {
          if(2 != $logistics->logistics_status['value'])
          {
            $logistics->logistics_status = 2;
            $logistics->save();
          }
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
   * @api {post} /api/member/order/course/cancel 07. 商品订单取消
   * @apiDescription 当前会员取消商品订单
   * @apiGroup 42. 商品订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} order_id 订单编号
   *
   * @apiSampleRequest /api/member/order/course/cancel
   * @apiVersion 1.0.0
   */
  public function cancel(Request $request)
  {
    $messages = [
      'order_id.required' => '请您输入订单编号',
    ];

    $rule = [
      'order_id' => 'required',
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
        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->order_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        if(0 != $model->order_status['value'])
        {
          return self::error(Code::CURRENT_ORDER_NO_CANCEL);
        }

        $model->order_status = 3;

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
