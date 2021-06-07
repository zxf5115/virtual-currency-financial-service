<?php
namespace App\Http\Controllers\Api\Module\Complain;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 投诉控制器类
 */
class ComplainController extends BaseController
{
  /**
   * 模型
   */
  protected $_model = 'App\Models\Api\Module\Complain\Complain';

  protected $_where = [];

  protected $_params = [
    'category_id',
  ];

  /**
   * 排序条件
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [
    'list' => [
      'category'
    ],
    'select' => [
      'category'
    ],
    'view' => [
      'category'
    ]
  ];


  /**
   * @api {get} /api/complain/list?page={page} 01. 获取我的投诉列表(分页)
   * @apiDescription 获取我的投诉列表(分页)
   * @apiGroup 44. 投诉模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} position_id 投诉位编号
   *
   * @apiSuccess (basic params) {Number} id 投诉编号
   * @apiSuccess (basic params) {Number} position_id 投诉位编号
   * @apiSuccess (basic params) {String} title 投诉标题
   * @apiSuccess (basic params) {String} picture 投诉图片资源
   * @apiSuccess (basic params) {String} url 投诉其他资源
   * @apiSuccess (basic params) {String} link 投诉链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/complain/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('member_id');

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
   * @api {get} /api/complain/select 02. 获取我的投诉列表(不分页)
   * @apiDescription 获取我的投诉列表(不分页)
   * @apiGroup 44. 投诉模块
   *
   * @apiParam {int} position_id 投诉位编号
   *
   * @apiSuccess (basic params) {Number} id 投诉编号
   * @apiSuccess (basic params) {Number} position_id 投诉位编号
   * @apiSuccess (basic params) {String} title 投诉标题
   * @apiSuccess (basic params) {String} picture 投诉图片资源
   * @apiSuccess (basic params) {String} url 投诉其他资源
   * @apiSuccess (basic params) {String} link 投诉链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/complain/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

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
   * @api {get} /api/complain/view/{id} 03. 获取我的投诉详情
   * @apiDescription 获取我的投诉详情
   * @apiGroup 44. 投诉模块
   *
   * @apiSuccess (basic params) {Number} id 投诉编号
   * @apiSuccess (basic params) {Number} position_id 投诉位编号
   * @apiSuccess (basic params) {String} title 投诉标题
   * @apiSuccess (basic params) {String} picture 投诉图片资源
   * @apiSuccess (basic params) {String} url 投诉其他资源
   * @apiSuccess (basic params) {String} link 投诉链接
   * @apiSuccess (basic params) {Number} create_time 添加时间
   *
   * @apiSampleRequest /api/complain/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id);

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
   * @api {post} /api/complain/handle 04. 编辑投诉信息
   * @apiDescription 编辑招聘老师的信息
   * @apiGroup 44. 投诉模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} category_id 投诉类型（不可为空）
   * @apiParam {string} content 投诉内容（不可为空）
   *
   * @apiSampleRequest /api/complain/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'category_id.required' => '请您输入投诉类似',
      'content.required'     => '请您输入投诉内容',
    ];

    $rule = [
      'category_id' => 'required',
      'content' => 'required',
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
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->category_id = $request->category_id;
        $model->member_id   = self::getCurrentId();
        $model->content     = $request->content;

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
