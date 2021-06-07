<?php
namespace App\Http\Controllers\Api\System;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 状态值接口控制器类
 */
class CodeController extends BaseController
{

  /**
   * @api {post} /api/code/code 999. 系统状态值说明
   * @apiDescription 系统全局状态值说明
   * @apiGroup 状态值模块
   *
   * @apiSuccess {Number} 200 成功
   * @apiSuccess {Number} 1000 未知错误
   * @apiSuccess {Number} 1001 没有权限
   * @apiSuccess {Number} 1002 删除成功
   * @apiSuccess {Number} 1003 删除失败
   * @apiSuccess {Number} 1004 操作成功
   * @apiSuccess {Number} 1005 操作失败
   * @apiSuccess {Number} 1006 您请求太频繁了，请休息一会
   * @apiSuccess {Number} 1007 清除失败
   * @apiSuccess {Number} 2000 服务器错误
   * @apiSuccess {Number} 2001 用户不存在
   * @apiSuccess {Number} 2002 用户无权限
   * @apiSuccess {Number} 2003 请输入正确密码
   * @apiSuccess {Number} 2004 输错密码次数太多，请一小时后再试！
   * @apiSuccess {Number} 2005 会员不存在
   * @apiSuccess {Number} 2006 会员已失效
   * @apiSuccess {Number} 2007 验证码错误
   * @apiSuccess {Number} -100 请先登录
   * @apiSuccess {Number} -101 Token丢失
   * @apiSuccess {Number} -102 请从新登录
   * @apiSuccess {Number} -103 非法账户，无法解析
   *
   */
  public function code(Request $request)
  {

  }
}
