<?php
namespace App\Http\Controllers\Api\Module\Member\Information;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Constant\Code;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Information\Sensitive;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-11
 *
 * 会员评论控制器类
 */
class CommentController extends BaseController
{
  // 模型名称
  protected $_model = 'App\Models\Api\Module\Information\Comment';


  /**
   * @api {post} /api/member/information/comment/handle 02. 资讯评论操作
   * @apiDescription 当前会员执行评论操作
   * @apiGroup 62. 资讯评论模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO"
   * }
   *
   * @apiParam {string} information_id 资讯编号
   * @apiParam {string} [parent_id] 上级评论编号, 0为初始评论
   * @apiParam {string} content 评论内容
   *
   * @apiSampleRequest /api/member/information/comment/handle
   * @apiVersion 1.0.0
   */
  public function handle(Request $request)
  {
    $messages = [
      'information_id.required' => '请您输入课程编号',
      'content.required'        => '请您输入评论内容',
    ];

    $rule = [
      'information_id' => 'required',
      'content'        => 'required',
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
        $model = new $this->_model();

        $model->member_id      = self::getCurrentId();
        $model->parent_id      = $request->parent_id ?? 0;
        $model->information_id = $request->information_id;
        $model->content        = Sensitive::shield($request->content);
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
