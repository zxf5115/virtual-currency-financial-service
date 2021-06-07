<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Events\Api\Member\Order\PayEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Order\Course as Order;
use App\Models\Api\Module\Education\Course\Course;
use App\Models\Api\Module\Member\Relevance\Address;
use App\Models\Api\Module\Education\Courseware\Courseware;
use App\Models\Api\Module\Education\Courseware\Relevance\Level;
use App\Models\Api\Module\Member\Relevance\Course as MemberCourse;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-18
 *
 * 会员课程订单控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Order\Course';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'course',
      'member'
    ],
    'select' => [
      'course',
      'member'
    ],
    'view' => [
      'course',
      'member',
      'address',
      'logistics'
    ],
  ];


  /**
   * @api {get} /api/member/order/course/list?page={page} 01. 课程订单列表(分页)
   * @apiDescription 获取当前会员课程订单列表(分页)
   * @apiGroup 12. 课程订单模块
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
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {String} buy_total 销售数量
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
   * @apiSampleRequest /api/member/order/course/list
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
   * @api {get} /api/member/order/course/select 02. 课程订单列表(不分页)
   * @apiDescription 获取当前会员课程订单列表(不分页)
   * @apiGroup 12. 课程订单模块
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
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {String} buy_total 销售数量
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
   * @apiSampleRequest /api/member/order/course/select
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
   * @api {get} /api/member/order/course/view/{id} 03. 课程订单详情
   * @apiDescription 获取当前会员课程订单的详情
   * @apiGroup 12. 课程订单模块
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
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} pay_money 支付金额
   * @apiSuccess (basic params) {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   * @apiSuccess (basic params) {Number} order_status 订单状态 0 待发货 1 待签收 2 已签收
   * @apiSuccess (basic params) {Number} create_time 支付时间
   *
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {String} buy_total 销售数量
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
   * @apiSuccess (logistics params) {String} present_name 礼包名称
   * @apiSuccess (logistics params) {String} semester 礼包周期
   * @apiSuccess (logistics params) {String} company_name 物流公司名称
   * @apiSuccess (logistics params) {String} logistics_no 物流单号
   * @apiSuccess (logistics params) {Number} logistics_status 物流状态 0 待发货 1 待签收 2 已签收
   *
   * @apiSampleRequest /api/member/order/course/view/{id}
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
   * @api {post} /api/member/order/course/handle 04. 创建课程订单
   * @apiDescription 当前会员购买课程后，创建课程订单
   * @apiGroup 12. 课程订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} course_id 课程编号
   * @apiParam {Number} courseware_id 课件编号
   * @apiParam {Number} level_id 课件级别编号
   * @apiParam {Number} address_id 收货地址编号
   * @apiParam {String} pay_money 支付金额
   * @apiParam {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   *
   * @apiSampleRequest /api/member/order/course/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'courseware_id.required' => '请您输入课件编号',
      'level_id.required'      => '请您输入课件级别编号',
      'address_id.required'    => '请您输入收货地址编号',
      'pay_money.required'     => '请您输入支付金额',
      'pay_type.required'      => '请您选择支付类型',
    ];

    $rule = [
      'course_id'     => 'required',
      'courseware_id' => 'required',
      'level_id'      => 'required',
      'address_id'    => 'required',
      'pay_money'     => 'required',
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
      DB::beginTransaction();

      try
      {
        // 判断课程是否存在
        $course = Course::getRow(['id' => $request->course_id]);

        if(empty($course))
        {
          return self::error(Code::COURSE_EMPTY);
        }

        // 如果报名时间还未到
        if(time() < strtotime($course->apply_start_time))
        {
          return self::error(Code::COURSE_APPLY_WAIT);
        }

        // 如果报名时间已结束
        if(time() > strtotime($course->apply_end_time))
        {
          return self::error(Code::COURSE_APPLY_END);
        }

        // 判断课件是否存在
        $courseware = Courseware::getRow(['id' => $request->courseware_id]);

        if(empty($courseware))
        {
          return self::error(Code::COURSEWARE_EMPTY);
        }

        // 判断课件是否存在
        $level = Level::getRow(['id' => $request->level_id]);

        if(empty($level))
        {
          return self::error(Code::COURSEWARE_LEVEL_EMPTY);
        }

        // 判断收货地址是否存在
        $address = Address::getRow(['id' => $request->address_id]);

        if(empty($address))
        {
          return self::error(Code::ADDRESS_EMPTY);
        }

        $where = [
          'member_id'     => self::getCurrentId(),
          'course_id'     => $request->course_id,
          'courseware_id' => $request->courseware_id,
          'level_id'      => $request->level_id,
        ];

        $memberCourse = MemberCourse::getRow($where);

        // 一门课程只能购买一次
        if(!empty($memberCourse->id))
        {
          return self::error(Code::COURSE_EXITS);
        }

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        if(empty($request->id))
        {
          $rand = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

          $model->order_no = date('YmdHis') . $rand;
        }

        $model->organization_id = self::getOrganizationId();
        $model->member_id       = self::getCurrentId();
        $model->course_id       = $request->course_id;
        $model->courseware_id   = $request->courseware_id;
        $model->level_id        = $request->level_id;
        $model->address_id      = $request->address_id;
        $model->pay_money       = $request->pay_money;
        $model->pay_type        = $request->pay_type;

        $model->save();

        DB::commit();

        return self::success($model);
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
   * @api {post} /api/member/order/course/change 08. 修改课程订单
   * @apiDescription 当前会员修改课程订单
   * @apiGroup 12. 课程订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {Number} order_id 订单编号
   * @apiParam {Number} address_id 收货地址编号
   * @apiParam {Number} pay_type 支付类型 1 支付宝 2 微信 4 苹果
   *
   * @apiSampleRequest /api/member/order/course/change
   * @apiVersion 1.0.0
   */
  public function change(Request $request)
  {
    $messages = [
      'order_id.required'   => '请您输入课程编号',
      'address_id.required' => '请您输入收货地址编号',
      'pay_type.required'   => '请您选择支付类型',
    ];

    $rule = [
      'order_id'   => 'required',
      'address_id' => 'required',
      'pay_type'   => 'required',
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

        // 判断订单是否存在
        $course = Order::getRow($where);

        if(empty($course))
        {
          return self::error(Code::CURRENT_ORDER_EMPTY);
        }

        if(0 != $course->pay_status['value'])
        {
          return self::error(Code::CURRENT_ORDER_NO_CHANGE);
        }

        $course->address_id = $request->address_id;
        $course->pay_type   = $request->pay_type;

        $course->save();

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
   * @api {post} /api/member/order/course/pay 05. 订单支付确认
   * @apiDescription 当前会员支付完成后，调用接口更改订单支付状态
   * @apiGroup 12. 课程订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} order_id 订单编号
   * @apiParam {int} is_h5 是否是h5订单 true false
   *
   * @apiSampleRequest /api/member/order/course/pay
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
        $is_h5 = $request->is_h5 ?? false;

        $condition = self::getCurrentWhereData();

        $where = ['id' => $request->order_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        // 支付
        $result = event(new PayEvent($model, $is_h5));

        if(empty($result[0]))
        {
          return self::error(Code::PAY_ERROR);
        }

        $response = $result[0];

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
   * @api {post} /api/member/order/course/finish 06. 课程订单完成
   * @apiDescription 当前会员收到货物后，点击完成课程订单
   * @apiGroup 12. 课程订单模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} order_id 订单编号
   *
   * @apiSampleRequest /api/member/order/course/finish
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
   * @api {post} /api/member/order/course/cancel 07. 课程订单取消
   * @apiDescription 当前会员取消课程订单
   * @apiGroup 12. 课程订单模块
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
