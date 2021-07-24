<?php
namespace App\Http\Controllers\Api\Module\Member\Community;

use Illuminate\Http\Request;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Community\Category;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-07-01
 *
 * 会员关注控制器类
 */
class AttentionController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Community\Attention';


  /**
   * @api {get} /api/member/community/attention/list?page={page} 01. 我的关注列表
   * @apiDescription 获取当前会员关注分页列表
   * @apiGroup 75. 社区关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (字段说明) {Number} id 社区分类编号
   * @apiSuccess (字段说明) {String} title 社区分类标题
   *
   * @apiSampleRequest /api/member/community/attention/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $result = $this->_model::getPluck('category_id', $condition, false, false, true);

      $where = [
        ['id', $result]
      ];

      $condition = array_merge($condition, $this->_where, $filter, $where);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      $response = Category::getPaging($condition, $relevance, $this->_order);

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
   * @api {post} /api/member/community/attention/status 02. 是否关注社区
   * @apiDescription 获取当前会员是否关注指定社区
   * @apiGroup 75. 社区关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {Number} category_id 社区分类编号
   *
   * @apiSuccess (字段说明) {Boolean} status 是否关注
   *
   * @apiSampleRequest /api/member/community/attention/status
   * @apiVersion 1.0.0
   */
  public function status(Request $request)
  {
    $messages = [
      'category_id.required' => '请您输入社区分类编号',
    ];

    $rule = [
      'category_id' => 'required',
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
        $status = true;

        $condition = self::getCurrentWhereData();

        $where = ['category_id' => $request->category_id];

        $condition = array_merge($condition, $where);

        $response = $this->_model::getRow($condition);

        if(empty($response->id))
        {
          $status = false;
        }

        return self::success($status);
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::ERROR);
      }
    }
  }


  /**
   * @api {post} /api/member/community/attention/handle 03. 关注操作
   * @apiDescription 当前会员执行关注操作, 已经关注过，再次点击取消关注
   * @apiGroup 75. 社区关注模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} category_id 社区分类编号
   *
   * @apiSampleRequest /api/member/community/attention/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'category_id.required' => '请您输入社区分类编号',
    ];

    $rule = [
      'category_id' => 'required',
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
        $response = $this->_model::createOrDelete([
          'member_id'   => self::getCurrentId(),
          'category_id' => $request->category_id
        ]);

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
