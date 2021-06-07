<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Enum\Common\TimeEnum;
use App\Events\Api\Member\Share\MoneyEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Relevance\Asset;
use App\Models\Api\Module\Member\Relevance\Relevance\Unit;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 会员课程控制器类
 */
class CourseController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Course';

  protected $_where = [];

  protected $_params = [
    'is_finish'
  ];

  protected $_order = [];

  protected $_relevance = [
    'list' => [
      'teacher',
      'member',
      'course',
      'level',
    ],
    'select' => [
      'teacher',
      'member',
      'course',
      'level',
    ],
    'view' => [
      'teacher.archive',
      'member',
      'course',
    ],
    'center' => [
      'courseware',
      'level'
    ]
  ];


  /**
   * @api {get} /api/member/course/list?page={page} 01. 会员课程列表(分页)
   * @apiDescription 获取当前会员订阅的课程列表(分页)
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
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
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {Number} semester 课程学期
   * @apiSuccess (course params) {Number} title 课程名称
   * @apiSuccess (course params) {Number} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/list
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
   * @api {get} /api/member/course/select 02. 会员课程列表(不分页)
   * @apiDescription 获取当前会员订阅的课程列表(不分页)
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
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
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {Number} semester 课程学期
   * @apiSuccess (course params) {Number} title 课程名称
   * @apiSuccess (course params) {Number} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/select
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
   * @api {get} /api/member/course/view/{id} 03. 当前会员课程详情
   * @apiDescription 获取当前会员课程详情
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 课程编号
   *
   * @apiSuccess (basic params) {Number} id 自增编号
   * @apiSuccess (basic params) {Number} member_id 学员编号
   * @apiSuccess (basic params) {Number} teacher_id 管理老师编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} is_add 家长微信是否被添加 1 是 2 否
   * @apiSuccess (basic params) {Number} apply_time 报名时间
   * @apiSuccess (basic params) {Number} apply_status 报名状态 0 待确认 1 已确认
   * @apiSuccess (basic params) {Number} confirm_time 报名确认时间
   * @apiSuccess (basic params) {Number} is_finish 是否完成学习 0 未完成 1 已完成
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSuccess (teacher params) {Number} id 老师编号
   * @apiSuccess (teacher params) {Number} organization_id 老师所属机构编号（暂时用不上）
   * @apiSuccess (teacher params) {String} open_id 第三方登录编号
   * @apiSuccess (teacher params) {Number} member_no 会员号
   * @apiSuccess (teacher params) {String} avatar 老师头像
   * @apiSuccess (teacher params) {String} qr_code 老师二维码
   * @apiSuccess (teacher params) {String} username 登录账户
   * @apiSuccess (teacher params) {String} nickname 老师姓名
   * @apiSuccess (teacher params) {Number} condition 成为条件 1 系统添加 2 完成任务
   * @apiSuccess (teacher params) {Number} create_time 注册时间
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
   * @apiSuccess (course params) {Number} id 课程编号
   * @apiSuccess (course params) {Number} semester 课程学期
   * @apiSuccess (course params) {Number} title 课程名称
   * @apiSuccess (course params) {Number} description 课程描述
   * @apiSuccess (course params) {String} picture 课程封面
   * @apiSuccess (course params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/member/course/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $where = ['course_id' => $id];

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
   * @api {get} /api/member/course/status/{id} 04. 当前课程是否被订阅
   * @apiDescription 获取当前课程是否被当前会员订阅
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 课程编号
   *
   * @apiSuccess (basic params) {Boolean} true|false 是否订阅
   *
   * @apiSampleRequest /api/member/course/status/{id}
   * @apiVersion 1.0.0
   */
  public function status(Request $request, $id)
  {
    try
    {
      $response = true;

      $condition = self::getCurrentWhereData();

      $where = ['course_id' => $id];

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition);

      if(empty($result->id))
      {
        $response = false;
      }

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
   * @api {get} /api/member/course/addition/{id} 05. 当前课程是否添加老师
   * @apiDescription 获取当前课程是否被当前会员订阅
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 课程编号
   *
   * @apiSuccess (basic params) {Boolean} true|false 是否添加
   *
   * @apiSampleRequest /api/member/course/addition/{id}
   * @apiVersion 1.0.0
   */
  public function addition(Request $request, $id)
  {
    try
    {
      $response = false;

      $condition = self::getCurrentWhereData();

      $where = ['course_id' => $id];

      $condition = array_merge($condition, $where);

      $result = $this->_model::getRow($condition);

      if(!empty($result) && 1 == $result->is_add['value'])
      {
        $response = true;
      }

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
   * @api {post} /api/member/course/apply 06. 课程报名
   * @apiDescription 当前会员进行课程报名
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} course_id 课程编号
   *
   * @apiSampleRequest /api/member/course/apply
   * @apiVersion 1.0.0
   */
  public function apply(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入课程编号'
    ];

    $rule = [
      'course_id' => 'required'
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

        $where = ['course_id' => $request->course_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        $model->apply_time      = time();
        $model->apply_status    = 1;

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
   * @api {post} /api/member/course/finish 07. 完成课程
   * @apiDescription 当前会员学习完成了课程
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} course_id 课程编号
   *
   * @apiSampleRequest /api/member/course/finish
   * @apiVersion 1.0.0
   */
  public function finish(Request $request)
  {
    $messages = [
      'course_id.required' => '请您输入课程编号'
    ];

    $rule = [
      'course_id' => 'required'
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

        $where = ['course_id' => $request->course_id];

        $condition = array_merge($condition, $where);

        $model = $this->_model::getRow($condition);

        if(1 == $model->is_finish['value'])
        {
          return self::error(Code::COURSE_FINISH);
        }

        $model->is_finish = 1;

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
   * @api {get} /api/member/course/center 08. 当前会员课程中心
   * @apiDescription 获取当前会员课程详情
   * @apiGroup 10. 会员课程模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (course params) {String} title 课件名称
   * @apiSuccess (course params) {String} level 课件级别名称
   * @apiSuccess (course params) {Number} unit_total 课程章节总数
   * @apiSuccess (course params) {String} unlock_unit_total 已解锁课程章节数
   *
   * @apiSuccess (course params) {String} register_day_number 注册天数
   * @apiSuccess (course params) {String} study_day_number 正在学习
   * @apiSuccess (course params) {String} production_number 累计作品
   *
   * @apiSampleRequest /api/member/course/center
   * @apiVersion 1.0.0
   */
  public function center(Request $request)
  {
    try
    {
      $response = [];

      $order = [['key' => 'create_time', 'value' => 'asc']];

      $condition = self::getCurrentWhereData();

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'center');

      $result = $this->_model::getList($condition, $relevance);

      foreach($result as $key => $course)
      {
        // 获取课件名称
        $response['course'][$key]['title'] = $course->courseware->title ?? '';
        // 获取课件级别名称
        $response['course'][$key]['level'] = $course->level->level ?? '';

        $where = [
          'member_id'     => $course->member_id,
          'course_id'     => $course->course_id,
          'courseware_id' => $course->courseware_id,
          'level_id'      => $course->level_id,
        ];

        // 获取知识点
        $unit = Unit::getPluck('is_unlock', $where, false, false, true);

        $value = array_column($unit, 'value');
        $unlock = array_count_values($value);

        $response['course'][$key]['unit_total'] = array_sum($unlock);
        $response['course'][$key]['unlock_unit_total'] = $unlock[1] ?? 0;
      }

      // 获得学员注册时间
      $create_time = $this->user->create_time;

      $create_time = time() - $create_time;

      $response['register_day_number'] = TimeEnum::getDayNumber($create_time);

      // 获得学员购买课程信息
      $result = $this->_model::getRow($condition, false, false, $order);

      // 获得学员学习时间
      $create_time = $result->create_time->timestamp ?? 0;

      if(0 != $create_time)
      {
        $create_time = time() - $create_time;
      }

      $response['study_day_number'] = TimeEnum::getDayNumber($create_time);

      // 获取学员累计作品数
      $result = Asset::getPluck('production', $condition);

      $response['production_number'] = $result[0] ?? 0;

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
