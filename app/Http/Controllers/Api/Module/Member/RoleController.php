<?php
namespace App\Http\Controllers\Api\Module\Member;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Http\Controllers\Api\BaseController;
use App\Models\Common\Module\Member\Relevance\Role;
/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 会员角色控制器类
 */
class RoleController extends BaseController
{
  protected $_model = 'App\Models\Api\Module\Member\Role';

  protected $_where = [];

  protected $_params = [];

  protected $_addition = [];

  protected $_order = [
    ['key' => 'id', 'value' => 'asc'],
  ];

  protected $_relevance = [];


  /**
   * @api {get} /api/member/role/info 01. 获取会员角色信息
   * @apiDescription 获取会员角色信息
   * @apiGroup 38. 会员角色模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiSuccess (basic params) {Number} id 角色编号
   * @apiSuccess (basic params) {Number} title 角色名称
   * @apiSuccess (basic params) {String} content 角色描述
   * @apiSuccess (basic params) {Number} create_time 创建时间
   *
   * @apiSampleRequest /api/member/role/info
   * @apiVersion 1.0.0
   */
  public function info(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData();

      $result = Role::getRow($condition);

      if(empty($result))
      {
        return self::error(Code::MEMBER_ROLE_EMPTY);
      }

      $where = [
        'id' => $result->role_id
      ];

      $response = $this->_model::getRow($where);

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
