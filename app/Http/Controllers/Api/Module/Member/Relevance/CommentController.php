<?php
namespace App\Http\Controllers\Api\Module\Member\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Events\Api\Member\Production\CommentEvent;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-13
 *
 * 会员评论控制器类
 */
class CommentController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Comment';

  protected $_where = [];

  protected $_params = [];

  protected $_order = [
    ['key' => 'is_top', 'value' => 'desc'],
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/comment/list?page={page} 01. 会员评论列表(分页)
   * @apiDescription 获取当前会员评论列表(分页)
   * @apiGroup 13. 会员评论模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 会员评论编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} production_id 作品编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} suffix 内容类型 1 文本内容 2 音频内容
   * @apiSuccess (basic params) {String} content 评论内容
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {String} create_time 评论时间
   *
   * @apiSampleRequest /api/member/comment/list
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
   * @api {get} /api/member/comment/select 02. 会员评论列表(不分页)
   * @apiDescription 获取当前会员评论列表(不分页)
   * @apiGroup 13. 会员评论模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 会员评论编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} production_id 作品编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} suffix 内容类型 1 文本内容 2 音频内容
   * @apiSuccess (basic params) {String} content 评论内容
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {String} create_time 评论时间
   *
   * @apiSampleRequest /api/member/comment/select
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
   * @api {post} /api/member/comment/handle 04. 评论操作
   * @apiDescription 当前会员执行评论操作
   * @apiGroup 13. 会员评论模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} course_id 课程编号
   * @apiParam {string} production_id 作品编号
   * @apiParam {string} suffix 评论内容类型 1 文本内容 2 音频内容
   * @apiParam {string} content 评论内容
   * @apiParam {String} duration 内容时长
   *
   * @apiSampleRequest /api/member/comment/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'course_id.required'     => '请您输入课程编号',
      'production_id.required' => '请您输入作品编号',
      'suffix.required'        => '请您输入评论类型',
      'content.required'       => '请您输入评论内容',
    ];

    $rule = [
      'course_id'     => 'required',
      'production_id' => 'required',
      'suffix'        => 'required',
      'content'       => 'required',
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
        $model = new $this->_model();

        $model->member_id     = self::getCurrentId();
        $model->course_id     = $request->course_id;
        $model->production_id = $request->production_id;
        $model->suffix        = $request->suffix;
        $model->content       = $request->content;
        $model->duration      = $request->duration ?? 0;

        // 老师评论置顶
        if(3 != self::getCurrentRoleId())
        {
          $model->is_top = 1;
        }

        $model->save();

        // 记录评论作品总数
        event(new CommentEvent($request->production_id));

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
