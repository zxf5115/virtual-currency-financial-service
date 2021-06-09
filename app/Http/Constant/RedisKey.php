<?php
namespace App\Http\Constant;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-15
 *
 * Redis 键值常量类
 */
class RedisKey
{
  // 平台核心数据
  const KERNEL = 'kernel';

  // 系统协议
  const AGREEMENT = 'agreement';

  // 平台菜单键名
  const PLATFORM_MENU = 'platform_menus';


  // 短信登录验证码键名
  const SMS_LOGIN_CODE = 'sms_login_code';

  // 短信注册验证码键名
  const SMS_REGISTERR_CODE = 'sms_registere_code';

  // 短信绑定验证码键名
  const SMS_BIND_CODE = 'sms_bind_code';

  // 短信重置验证码键名
  const SMS_RESET_CODE = 'sms_reset_code';

  // 短信修改验证码键名
  const SMS_CHANGE_CODE = 'sms_change_code';


}
