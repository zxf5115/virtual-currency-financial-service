<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Events\Api\Member\TargetEvent;
use App\Events\Api\Member\LollipopEvent;
use App\Events\Api\Member\ProductionEvent;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Member\Relevance\Archive;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-24
 *
 * 会员作品控制器类
 */
class ProductionController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Production';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'course',
      'courseware',
      'level',
      'member',
      'archive'
    ],
    'view' => [
      'course',
      'courseware',
      'level',
      'member',
      'archive'
    ]
  ];

  /**
   * @api {get} /api/member/production/list?page={page} 01. 会员作品列表(分页)
   * @apiDescription 获取当前会员作品的列表(分页)
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} semester 课程周期
   *
   * @apiSuccess (courseware params) {String} title 课件名称
   * @apiSuccess (courseware params) {String} description 课件描述
   * @apiSuccess (courseware params) {String} is_permanent 课件类型
   *
   * @apiSuccess (level params) {String} level 课件级别
   * @apiSuccess (level params) {String} minimum_age 最小年龄
   * @apiSuccess (level params) {String} largest_age 最大年龄
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/member/production/list
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
   * @api {get} /api/member/production/select 02. 会员作品列表(不分页)
   * @apiDescription 获取当前会员作品的列表(不分页)
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} semester 课程周期
   *
   * @apiSuccess (courseware params) {String} title 课件名称
   * @apiSuccess (courseware params) {String} description 课件描述
   * @apiSuccess (courseware params) {String} is_permanent 课件类型
   *
   * @apiSuccess (level params) {String} level 课件级别
   * @apiSuccess (level params) {String} minimum_age 最小年龄
   * @apiSuccess (level params) {String} largest_age 最大年龄
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/member/production/select
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
   * @api {get} /api/member/production/view/{id} 03. 会员作品详情
   * @apiDescription 获取当前会员作品的详情
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} id 作品编号
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (course params) {String} title 课程名称
   * @apiSuccess (course params) {String} semester 课程周期
   *
   * @apiSuccess (courseware params) {String} title 课件名称
   * @apiSuccess (courseware params) {String} description 课件描述
   * @apiSuccess (courseware params) {String} is_permanent 课件类型
   *
   * @apiSuccess (level params) {String} level 课件级别
   * @apiSuccess (level params) {String} minimum_age 最小年龄
   * @apiSuccess (level params) {String} largest_age 最大年龄
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/member/production/view/{id}
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
   * @api {post} /api/member/production/handle 04. 上传作品
   * @apiDescription 当前会员上传他的作品
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {String} course_id 课程编号
   * @apiParam {String} courseware_id 课件编号
   * @apiParam {String} level_id 课件级别编号
   * @apiParam {String} unit_id 课件单元编号
   * @apiParam {String} picture 作品图片
   * @apiParam {String} description 作品描述
   * @apiParam {String} duration 内容时长
   *
   * @apiSampleRequest /api/member/production/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'courseware_id.required' => '请您输入课件编号',
      'level_id.required'      => '请您输入课件级别编号',
      'unit_id.required'       => '请您输入课件单元编号',
      'picture.required'       => '请您上传作品',
    ];

    $rule = [
      'course_id'     => 'required',
      'courseware_id' => 'required',
      'level_id'      => 'required',
      'unit_id'       => 'required',
      'picture'       => 'required',
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
        $member_id = self::getCurrentId();

        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id = self::getOrganizationId();
        $model->member_id       = $member_id;
        $model->course_id       = $request->course_id;
        $model->courseware_id   = $request->courseware_id;
        $model->level_id        = $request->level_id;
        $model->unit_id         = $request->unit_id;
        $model->picture         = $request->picture;
        $model->description     = $request->description ?? '';
        $model->duration        = $request->duration ?? 0;

        $archive = Archive::getRow(['member_id' => $member_id]);

        if(empty($archive))
        {
          return self::error(Code::MEMBER_ARCHIVE_EMPTY);
        }

        $model->archive_id = $archive->id;

        $response = $model->save();

        // 上传作品获取棒棒糖
        event(new LollipopEvent($request->course_id, $request->unit_id, 2, 1));

        // 记录上传作品总数
        event(new ProductionEvent());

        // 成为老师目标
        event(new TargetEvent($member_id, 3));

        DB::commit();

        return self::success($model->id);
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
   * @api {post} /api/member/production/share 05. 分享作品
   * @apiDescription 当前会员分享他的作品
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {String} id 作品编号
   *
   * @apiSampleRequest /api/member/production/share
   * @apiVersion 1.0.0
   */
  public function share(Request $request)
  {
    $messages = [
      'id.required' => '请您输入作品编号',
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
        $model = $this->_model::getRow(['id' => $request->id]);

        // 分享作品获取棒棒糖
        event(new LollipopEvent($model->course_id, $model->unit_id, 3, 1));

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
   * @api {post} /api/member/production/status 06. 会员作品是否上传
   * @apiDescription 获取当前会员作品的详情
   * @apiGroup 07. 会员作品模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   * @apiParam {int} unit_id 课件单元编号
   *
   * @apiSuccess (basic params) {Number} data true|false
   *
   * @apiSampleRequest /api/member/production/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'courseware_id.required' => '请您输入课件编号',
      'level_id.required'      => '请您输入课件级别编号',
      'unit_id.required'       => '请您输入课件单元编号',
    ];

    $rule = [
      'course_id'     => 'required',
      'courseware_id' => 'required',
      'level_id'      => 'required',
      'unit_id'       => 'required',
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
        $response = false;

        $condition = self::getCurrentWhereData();

        $where = [
          'course_id'     => $request->course_id,
          'courseware_id' => $request->courseware_id,
          'level_id'      => $request->level_id,
          'unit_id'       => $request->unit_id,
        ];

        $condition = array_merge($condition, $where);

        $result = $this->_model::getRow($condition);

        if(!empty($result))
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
  }
}
