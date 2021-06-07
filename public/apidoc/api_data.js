define({ "api": [
  {
    "type": "get",
    "url": "/api/logout",
    "title": "09. 退出",
    "description": "<p>退出登录状态</p>",
    "group": "01._登录模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/logout"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "GetApiLogout"
  },
  {
    "type": "post",
    "url": "/api/apple_bind_code",
    "title": "11. 获取苹果绑定验证码",
    "description": "<p>获取登录手机号的苹果绑定验证码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018888）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/apple_bind_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiApple_bind_code"
  },
  {
    "type": "post",
    "url": "/api/apple_bind_mobile",
    "title": "12. 苹果绑定手机号码",
    "description": "<p>苹果绑定手机号码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果登录编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/apple_bind_mobile"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiApple_bind_mobile"
  },
  {
    "type": "post",
    "url": "/api/apple_login",
    "title": "05. 苹果登录",
    "description": "<p>通过第三方软件-苹果，进行登录</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果AppleID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "user_info params": [
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>会员二维码</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/apple_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiApple_login"
  },
  {
    "type": "post",
    "url": "/api/bind_code",
    "title": "08. 获取绑定验证码",
    "description": "<p>获取登录手机号的绑定验证码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018888）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/bind_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiBind_code"
  },
  {
    "type": "post",
    "url": "/api/bind_mobile",
    "title": "07. 绑定手机号码",
    "description": "<p>绑定用的的手机号码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信登录编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录手机号码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>验证码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/bind_mobile"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiBind_mobile"
  },
  {
    "type": "post",
    "url": "/api/callback",
    "title": "14. 微信回调",
    "description": "<p>微信回调</p>",
    "group": "01._登录模块",
    "sampleRequest": [
      {
        "url": "/api/callback"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiCallback"
  },
  {
    "type": "post",
    "url": "/api/h5_login",
    "title": "10. H5登录",
    "description": "<p>短信登录</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>短信验证码（7777）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "user_info params": [
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>会员二维码</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/h5_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiH5_login"
  },
  {
    "type": "post",
    "url": "/api/h5_sms_code",
    "title": "10. H5登录验证码",
    "description": "<p>获取H5短信登录验证码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/h5_sms_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiH5_sms_code"
  },
  {
    "type": "post",
    "url": "/api/login",
    "title": "01. 密码登录",
    "description": "<p>通过账户密码进行登录操作</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>登录密码（123456）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "user_info params": [
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>会员二维码</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiLogin"
  },
  {
    "type": "post",
    "url": "/api/register",
    "title": "06. 用户注册",
    "description": "<p>注册用户信息</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信app编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "union_id",
            "description": "<p>微信唯一编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果登录编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "username",
            "description": "<p>登录手机号码（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sex",
            "description": "<p>会员性别（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "birthday",
            "description": "<p>会员生日（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "skill_level",
            "description": "<p>绘画基础 0 无基础 1 1年以下 2 1年以上（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/register"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiRegister"
  },
  {
    "type": "post",
    "url": "/api/sms_code",
    "title": "03. 登录验证码",
    "description": "<p>获取短信登录验证码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/sms_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiSms_code"
  },
  {
    "type": "post",
    "url": "/api/sms_login",
    "title": "02. 短信登录",
    "description": "<p>短信登录</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sms_code",
            "description": "<p>短信验证码（7777）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "user_info params": [
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>会员二维码</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/sms_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiSms_login"
  },
  {
    "type": "post",
    "url": "/api/weixin",
    "title": "13. 微信登录",
    "description": "<p>微信登录</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户（18201018926）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/weixin"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiWeixin"
  },
  {
    "type": "post",
    "url": "/api/weixin_login",
    "title": "04. 微信登录",
    "description": "<p>通过第三方软件-微信，进行登录</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信OpenID</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "user_info params": [
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>会员二维码</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "user_info params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "user_info params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/weixin_login"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiWeixin_login"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/about",
    "title": "06. 关于我们",
    "description": "<p>获取系统的关于我们</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>协议名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>协议内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/agreement/about"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementAbout"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/user",
    "title": "05. 用户协议",
    "description": "<p>获取系统的用户协议</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>协议名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>协议内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/agreement/user"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementUser"
  },
  {
    "type": "get",
    "url": "/api/common/area/list",
    "title": "02. 获取地区列表",
    "description": "<p>获取地区列表</p>",
    "group": "02._公共模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "parent_id",
            "description": "<p>上级地区编号（为空：获取省，省编号: 获取市，市编号: 获取县）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/area/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AreaController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAreaList"
  },
  {
    "type": "get",
    "url": "/api/common/lollipop/data",
    "title": "09. 棒棒糖配置数据",
    "description": "<p>获取棒棒糖配置数据</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "finish_course",
            "description": "<p>完成每节课程(个)</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "upload_production",
            "description": "<p>上传作品(个)</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "share_production",
            "description": "<p>分享自己作品(个)</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_rule",
            "description": "<p>棒棒糖使用规则说明</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/lollipop/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/LollipopController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonLollipopData"
  },
  {
    "type": "get",
    "url": "/api/common/target/data",
    "title": "04. 任务指标",
    "description": "<p>获取成为招生老师的任务指标</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_total",
            "description": "<p>购买课程目标总数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "invitation_total",
            "description": "<p>邀请他人购买课程目标总数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "upload_total",
            "description": "<p>上传作品目标总数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/target/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/TargetController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonTargetData"
  },
  {
    "type": "get",
    "url": "/api/system/kernel",
    "title": "01. 获取系统信息",
    "description": "<p>获取系统配置内容信息</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "Fields Explain": [
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "web_chinese_name",
            "description": "<p>网站中文名称</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "web_english_name",
            "description": "<p>网站英文名字</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "web_url",
            "description": "<p>站点链接</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "keywords",
            "description": "<p>网站关键字</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>网站描述</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "logo",
            "description": "<p>网站logo</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>公司电话</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>公司邮箱</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "copyright",
            "description": "<p>备案号</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "web_status",
            "description": "<p>站点状态</p>"
          },
          {
            "group": "Fields Explain",
            "type": "String",
            "optional": false,
            "field": "web_close_info",
            "description": "<p>站点关闭原因</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/system/kernel"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/SystemController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiSystemKernel"
  },
  {
    "type": "post",
    "url": "/api/common/alipay/notify",
    "title": "08. 支付宝支付回调",
    "description": "<p>获取支付宝支付回调</p>",
    "group": "02._公共模块",
    "sampleRequest": [
      {
        "url": "/api/common/alipay/notify"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AlipayController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonAlipayNotify"
  },
  {
    "type": "post",
    "url": "/api/common/apple/notify",
    "title": "16. 苹果支付回调",
    "description": "<p>获取微信支付回调</p>",
    "group": "02._公共模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/apple/notify"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AppleController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonAppleNotify"
  },
  {
    "type": "post",
    "url": "/api/common/bonus/data",
    "title": "15. 老师分红配置",
    "description": "<p>获取老师分红配置</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "student_buy_course",
            "description": "<p>学生购买系统课老师可得分红(元/人)</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "share_money_rule",
            "description": "<p>分红规则</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/bonus/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/BonusController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonBonusData"
  },
  {
    "type": "post",
    "url": "/api/common/express/data",
    "title": "10. 快递查询",
    "description": "<p>根据快递单号查询快递信息</p>",
    "group": "02._公共模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>订单类型 1 课程订单 2 商品订单</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "express_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "company_code",
            "description": "<p>物流公司编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/express/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ExpressController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonExpressData"
  },
  {
    "type": "post",
    "url": "/api/common/qrcode/share",
    "title": "13. 分享二维码图片",
    "description": "<p>获取分享二维码图片</p>",
    "group": "02._公共模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>base64加密后的二维码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/qrcode/share"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/QrcodeController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonQrcodeShare"
  },
  {
    "type": "post",
    "url": "/api/common/redenvelope/data",
    "title": "12. 红包配置",
    "description": "<p>获取学员红包配置</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "invitation_money",
            "description": "<p>邀请用户购买体验课奖励红包(元)</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "withdrawal_total",
            "description": "<p>红包每天最多提现(次)</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "withdrawal_money",
            "description": "<p>红包每次最多提现(元)</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "withdrawal_rule",
            "description": "<p>红包提现规则说明</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/redenvelope/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/RedEnvelopeController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonRedenvelopeData"
  },
  {
    "type": "post",
    "url": "/api/common/service/data",
    "title": "11. 客服联系方式",
    "description": "<p>获取客服联系方式</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "service_mobile",
            "description": "<p>客服电话</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "service_wechat",
            "description": "<p>客服微信号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "service_qrcode",
            "description": "<p>客服微信二维码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/service/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ServiceController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonServiceData"
  },
  {
    "type": "post",
    "url": "/api/common/share/data",
    "title": "14. 分享配置",
    "description": "<p>获取学员分享配置</p>",
    "group": "02._公共模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "share_picture",
            "description": "<p>分享图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "share_rule",
            "description": "<p>分享活动规则</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "qrcode",
            "description": "<p>二维码图片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/share/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ShareController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonShareData"
  },
  {
    "type": "post",
    "url": "/api/common/wechat/notify",
    "title": "07. 微信支付回调",
    "description": "<p>获取微信支付回调</p>",
    "group": "02._公共模块",
    "sampleRequest": [
      {
        "url": "/api/common/wechat/notify"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/WechatController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonWechatNotify"
  },
  {
    "type": "post",
    "url": "/api/file/audio",
    "title": "04. 上传音频(base64)",
    "description": "<p>把音频转换为base64进行上传</p>",
    "group": "03._上传模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>音频数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/audio"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "03._上传模块",
    "name": "PostApiFileAudio"
  },
  {
    "type": "post",
    "url": "/api/file/avatar",
    "title": "01. 上传头像(base64)",
    "description": "<p>把头像图片转换为base64进行上传</p>",
    "group": "03._上传模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>头像数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/avatar"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "03._上传模块",
    "name": "PostApiFileAvatar"
  },
  {
    "type": "post",
    "url": "/api/file/file",
    "title": "03. 上传文件(base64)",
    "description": "<p>把文件转换为base64进行上传</p>",
    "group": "03._上传模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>文件数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/file"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "03._上传模块",
    "name": "PostApiFileFile"
  },
  {
    "type": "post",
    "url": "/api/file/movie",
    "title": "05. 上传视频(base64)",
    "description": "<p>把视频转换为base64进行上传</p>",
    "group": "03._上传模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>视频数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/movie"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "03._上传模块",
    "name": "PostApiFileMovie"
  },
  {
    "type": "post",
    "url": "/api/file/picture",
    "title": "02. 上传图片(base64)",
    "description": "<p>把图片转换为base64进行上传</p>",
    "group": "03._上传模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "file",
            "description": "<p>图片数据</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/file/picture"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/FileController.php",
    "groupTitle": "03._上传模块",
    "name": "PostApiFilePicture"
  },
  {
    "type": "get",
    "url": "/api/member/archive",
    "title": "01. 获取当前会员档案",
    "description": "<p>获取当前会员的档案信息</p>",
    "group": "04._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "skill_level",
            "description": "<p>绘画基础</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>生日</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          }
        ],
        "asset params": [
          {
            "group": "asset params",
            "type": "String",
            "optional": false,
            "field": "red_envelope",
            "description": "<p>红包金额</p>"
          },
          {
            "group": "asset params",
            "type": "String",
            "optional": false,
            "field": "lollipop",
            "description": "<p>棒棒糖数</p>"
          },
          {
            "group": "asset params",
            "type": "String",
            "optional": false,
            "field": "production",
            "description": "<p>作品数</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/archive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "04._会员模块",
    "name": "GetApiMemberArchive"
  },
  {
    "type": "get",
    "url": "/api/member/status",
    "title": "05. 当前会员是否填写资料",
    "description": "<p>获取当前会员是否填写资料信息</p>",
    "group": "04._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "data",
            "description": "<p>true|false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "04._会员模块",
    "name": "GetApiMemberStatus"
  },
  {
    "type": "get",
    "url": "/api/member/view/{id}",
    "title": "04. 获取会员详情",
    "description": "<p>获取会员详情</p>",
    "group": "04._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "skill_level",
            "description": "<p>绘画基础</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>生日</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "04._会员模块",
    "name": "GetApiMemberViewId"
  },
  {
    "type": "post",
    "url": "/api/member/handle",
    "title": "02. 编辑会员信息",
    "description": "<p>编辑会员信息</p>",
    "group": "04._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sex",
            "description": "<p>会员性别（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "birthday",
            "description": "<p>会员生日（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "skill_level",
            "description": "<p>绘画基础 0 无基础 1 1年以下 2 1年以上（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "04._会员模块",
    "name": "PostApiMemberHandle"
  },
  {
    "type": "post",
    "url": "/api/member/teacher",
    "title": "03. 成为招聘老师",
    "description": "<p>将满足条件的当前会员的身份变成招聘老师</p>",
    "group": "04._会员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/member/teacher"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/MemberController.php",
    "groupTitle": "04._会员模块",
    "name": "PostApiMemberTeacher"
  },
  {
    "type": "get",
    "url": "/api/member/lollipop/list?page={page}",
    "title": "01. 会员帮帮糖列表(分页)",
    "description": "<p>获取当前会员的帮帮糖列表(分页)</p>",
    "group": "05._会员棒棒糖模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>棒棒糖类型 1:获取 2:消费</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>棒棒糖编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>棒棒糖类型 1: 获取 2: 消费</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>棒棒糖描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "number",
            "description": "<p>棒棒糖数量</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>获取时间|消费时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/lollipop/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/LollipopController.php",
    "groupTitle": "05._会员棒棒糖模块",
    "name": "GetApiMemberLollipopListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/lollipop/select",
    "title": "02. 会员帮帮糖列表(不分页)",
    "description": "<p>获取当前会员的帮帮糖列表(不分页)</p>",
    "group": "05._会员棒棒糖模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>棒棒糖类型 1:获取 2:消费</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>棒棒糖编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>棒棒糖类型 1: 获取 2: 消费</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>棒棒糖描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "number",
            "description": "<p>棒棒糖数量</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>获取时间|消费时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/lollipop/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/LollipopController.php",
    "groupTitle": "05._会员棒棒糖模块",
    "name": "GetApiMemberLollipopSelect"
  },
  {
    "type": "post",
    "url": "/api/member/lollipop/receive",
    "title": "04. 领取棒棒糖",
    "description": "<p>当前会员领取棒棒糖</p>",
    "group": "05._会员棒棒糖模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "data",
            "description": "<p>true|false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/lollipop/receive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/LollipopController.php",
    "groupTitle": "05._会员棒棒糖模块",
    "name": "PostApiMemberLollipopReceive"
  },
  {
    "type": "post",
    "url": "/api/member/lollipop/status",
    "title": "03. 是否领取了棒棒糖",
    "description": "<p>获取当前会员是否领取了棒棒糖</p>",
    "group": "05._会员棒棒糖模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "data",
            "description": "<p>true|false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/lollipop/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/LollipopController.php",
    "groupTitle": "05._会员棒棒糖模块",
    "name": "PostApiMemberLollipopStatus"
  },
  {
    "type": "get",
    "url": "/api/member/money/list?page={page}",
    "title": "01. 会员红包列表(分页)",
    "description": "<p>获取当前会员的红包列表(分页)</p>",
    "group": "06._会员红包模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>红包类型 1:收入 2: 提现</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>红包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>红包类型 1: 收入 2: 提现</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>红包描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "money",
            "description": "<p>红包金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>收入时间|提现时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/money/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/MoneyController.php",
    "groupTitle": "06._会员红包模块",
    "name": "GetApiMemberMoneyListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/money/select",
    "title": "02. 会员红包列表(不分页)",
    "description": "<p>获取当前会员的红包列表(不分页)</p>",
    "group": "06._会员红包模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>红包类型 1: 收入 2: 提现</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>红包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>红包类型 1: 收入 2: 提现</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>红包描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "money",
            "description": "<p>红包金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>收入时间|提现时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/money/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/MoneyController.php",
    "groupTitle": "06._会员红包模块",
    "name": "GetApiMemberMoneySelect"
  },
  {
    "type": "post",
    "url": "/api/member/money/handle",
    "title": "03. 会员红包提现",
    "description": "<p>提现当前会员的红包金额</p>",
    "group": "06._会员红包模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "double",
            "optional": false,
            "field": "money",
            "description": "<p>提现金额</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "alipay_account",
            "description": "<p>支付宝账户</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "alipay_name",
            "description": "<p>支付宝姓名</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/money/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/MoneyController.php",
    "groupTitle": "06._会员红包模块",
    "name": "PostApiMemberMoneyHandle"
  },
  {
    "type": "get",
    "url": "/api/member/production/list?page={page}",
    "title": "01. 会员作品列表(分页)",
    "description": "<p>获取当前会员作品的列表(分页)</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          }
        ],
        "courseware params": [
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件描述</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "is_permanent",
            "description": "<p>课件类型</p>"
          }
        ],
        "level params": [
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "GetApiMemberProductionListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/production/select",
    "title": "02. 会员作品列表(不分页)",
    "description": "<p>获取当前会员作品的列表(不分页)</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          }
        ],
        "courseware params": [
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件描述</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "is_permanent",
            "description": "<p>课件类型</p>"
          }
        ],
        "level params": [
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "GetApiMemberProductionSelect"
  },
  {
    "type": "get",
    "url": "/api/member/production/view/{id}",
    "title": "03. 会员作品详情",
    "description": "<p>获取当前会员作品的详情</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          }
        ],
        "courseware params": [
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件描述</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "is_permanent",
            "description": "<p>课件类型</p>"
          }
        ],
        "level params": [
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "level params",
            "type": "String",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "GetApiMemberProductionViewId"
  },
  {
    "type": "post",
    "url": "/api/member/production/handle",
    "title": "04. 上传作品",
    "description": "<p>当前会员上传他的作品</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "PostApiMemberProductionHandle"
  },
  {
    "type": "post",
    "url": "/api/member/production/share",
    "title": "05. 分享作品",
    "description": "<p>当前会员分享他的作品</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/share"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "PostApiMemberProductionShare"
  },
  {
    "type": "post",
    "url": "/api/member/production/status",
    "title": "06. 会员作品是否上传",
    "description": "<p>获取当前会员作品的详情</p>",
    "group": "07._会员作品模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "data",
            "description": "<p>true|false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/production/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ProductionController.php",
    "groupTitle": "07._会员作品模块",
    "name": "PostApiMemberProductionStatus"
  },
  {
    "type": "get",
    "url": "/api/member/address/default",
    "title": "06. 当前用户默认地址",
    "description": "<p>获取当前用户默认地址详情</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>收货人姓名</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>收货人电话</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_default",
            "description": "<p>是否为默认地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/default"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "GetApiMemberAddressDefault"
  },
  {
    "type": "get",
    "url": "/api/member/address/list?page={page}",
    "title": "01. 会员地址列表(分页)",
    "description": "<p>获取当前会员送货地址列表(分页)</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>收货人姓名</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>收货人电话</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_default",
            "description": "<p>是否为默认地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "GetApiMemberAddressListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/address/select",
    "title": "02. 会员地址列表(不分页)",
    "description": "<p>获取当前会员送货地址列表(不分页)</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>收货人姓名</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>收货人电话</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_default",
            "description": "<p>是否为默认地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "GetApiMemberAddressSelect"
  },
  {
    "type": "get",
    "url": "/api/member/address/view/{id}",
    "title": "03. 当前用户地址详情",
    "description": "<p>获取当前用户地址详情</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>收货人姓名</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>收货人电话</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_default",
            "description": "<p>是否为默认地址</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "GetApiMemberAddressViewId"
  },
  {
    "type": "post",
    "url": "/api/member/address/delete",
    "title": "05. 删除会员地址",
    "description": "<p>删除当前会员的送货地址信息</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/delete"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "PostApiMemberAddressDelete"
  },
  {
    "type": "post",
    "url": "/api/member/address/handle",
    "title": "04. 新建(编辑)会员地址",
    "description": "<p>新建或者编辑当前会员的送货地址信息</p>",
    "group": "08._会员地址模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>会员地址编号（不存在：新增，存在：编辑）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>收货人姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>收货人电话</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "is_default",
            "description": "<p>是否为默认地址 0 不是 1 是</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/address/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AddressController.php",
    "groupTitle": "08._会员地址模块",
    "name": "PostApiMemberAddressHandle"
  },
  {
    "type": "get",
    "url": "/api/member/approval/list?page={page}",
    "title": "01. 会员点赞列表(分页)",
    "description": "<p>获取当前会员点赞列表(分页)</p>",
    "group": "09._会员点赞模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员点赞编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>点赞时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/approval/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ApprovalController.php",
    "groupTitle": "09._会员点赞模块",
    "name": "GetApiMemberApprovalListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/approval/select",
    "title": "02. 会员点赞列表(不分页)",
    "description": "<p>获取当前会员点赞列表(不分页)</p>",
    "group": "09._会员点赞模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员点赞编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>点赞时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/approval/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ApprovalController.php",
    "groupTitle": "09._会员点赞模块",
    "name": "GetApiMemberApprovalSelect"
  },
  {
    "type": "post",
    "url": "/api/member/approval/handle",
    "title": "04. 点赞操作",
    "description": "<p>当前会员执行点赞操作, 已经点赞过，再次点击取消点赞</p>",
    "group": "09._会员点赞模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/approval/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ApprovalController.php",
    "groupTitle": "09._会员点赞模块",
    "name": "PostApiMemberApprovalHandle"
  },
  {
    "type": "post",
    "url": "/api/member/approval/status",
    "title": "03. 作品是否点赞",
    "description": "<p>获取当前会员点赞的详情</p>",
    "group": "09._会员点赞模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/approval/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/ApprovalController.php",
    "groupTitle": "09._会员点赞模块",
    "name": "PostApiMemberApprovalStatus"
  },
  {
    "type": "get",
    "url": "/api/member/course/addition/{id}",
    "title": "05. 当前课程是否添加老师",
    "description": "<p>获取当前课程是否被当前会员订阅</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>|false 是否添加</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/addition/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseAdditionId"
  },
  {
    "type": "get",
    "url": "/api/member/course/center",
    "title": "08. 当前会员课程中心",
    "description": "<p>获取当前会员课程详情</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别名称</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "unit_total",
            "description": "<p>课程章节总数</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "unlock_unit_total",
            "description": "<p>已解锁课程章节数</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "register_day_number",
            "description": "<p>注册天数</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "study_day_number",
            "description": "<p>正在学习</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "production_number",
            "description": "<p>累计作品</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/center"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseCenter"
  },
  {
    "type": "get",
    "url": "/api/member/course/list?page={page}",
    "title": "01. 会员课程列表(分页)",
    "description": "<p>获取当前会员订阅的课程列表(分页)</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程学期</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/course/select",
    "title": "02. 会员课程列表(不分页)",
    "description": "<p>获取当前会员订阅的课程列表(不分页)</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程学期</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/member/course/status/{id}",
    "title": "04. 当前课程是否被订阅",
    "description": "<p>获取当前课程是否被当前会员订阅</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>|false 是否订阅</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/status/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseStatusId"
  },
  {
    "type": "get",
    "url": "/api/member/course/view/{id}",
    "title": "03. 当前会员课程详情",
    "description": "<p>获取当前会员课程详情</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程学期</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "GetApiMemberCourseViewId"
  },
  {
    "type": "post",
    "url": "/api/member/course/apply",
    "title": "06. 课程报名",
    "description": "<p>当前会员进行课程报名</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/apply"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "PostApiMemberCourseApply"
  },
  {
    "type": "post",
    "url": "/api/member/course/finish",
    "title": "07. 完成课程",
    "description": "<p>当前会员学习完成了课程</p>",
    "group": "10._会员课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CourseController.php",
    "groupTitle": "10._会员课程模块",
    "name": "PostApiMemberCourseFinish"
  },
  {
    "type": "get",
    "url": "/api/member/target/progress",
    "title": "01. 会员任务指标进度",
    "description": "<p>获取当前会员成为招生老师的任务指标进度</p>",
    "group": "11._会员任务指标模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_total",
            "description": "<p>购买课程总数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "invitation_total",
            "description": "<p>邀请他人购买体验课程总数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "upload_total",
            "description": "<p>上传作品总数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/target/progress"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/TargetController.php",
    "groupTitle": "11._会员任务指标模块",
    "name": "GetApiMemberTargetProgress"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/list?page={page}",
    "title": "01. 课程订单列表(分页)",
    "description": "<p>获取当前会员课程订单列表(分页)</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "buy_total",
            "description": "<p>销售数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "GetApiMemberOrderCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/select",
    "title": "02. 课程订单列表(不分页)",
    "description": "<p>获取当前会员课程订单列表(不分页)</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "buy_total",
            "description": "<p>销售数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "GetApiMemberOrderCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/view/{id}",
    "title": "03. 课程订单详情",
    "description": "<p>获取当前会员课程订单的详情</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课程描述</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程封面</p>"
          },
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "buy_total",
            "description": "<p>销售数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "logistics params": [
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单物流编号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "present_name",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>礼包周期</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司名称</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态 0 待发货 1 待签收 2 已签收</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "GetApiMemberOrderCourseViewId"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/cancel",
    "title": "07. 课程订单取消",
    "description": "<p>当前会员取消课程订单</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/cancel"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "PostApiMemberOrderCourseCancel"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/change",
    "title": "08. 修改课程订单",
    "description": "<p>当前会员修改课程订单</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address_id",
            "description": "<p>收货地址编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/change"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "PostApiMemberOrderCourseChange"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/finish",
    "title": "06. 课程订单完成",
    "description": "<p>当前会员收到货物后，点击完成课程订单</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "PostApiMemberOrderCourseFinish"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/handle",
    "title": "04. 创建课程订单",
    "description": "<p>当前会员购买课程后，创建课程订单</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address_id",
            "description": "<p>收货地址编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "PostApiMemberOrderCourseHandle"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/pay",
    "title": "05. 订单支付确认",
    "description": "<p>当前会员支付完成后，调用接口更改订单支付状态</p>",
    "group": "12._课程订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "is_h5",
            "description": "<p>是否是h5订单 true false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/pay"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/CourseController.php",
    "groupTitle": "12._课程订单模块",
    "name": "PostApiMemberOrderCoursePay"
  },
  {
    "type": "get",
    "url": "/api/member/comment/list?page={page}",
    "title": "01. 会员评论列表(分页)",
    "description": "<p>获取当前会员评论列表(分页)</p>",
    "group": "13._会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员评论编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "suffix",
            "description": "<p>内容类型 1 文本内容 2 音频内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CommentController.php",
    "groupTitle": "13._会员评论模块",
    "name": "GetApiMemberCommentListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/comment/select",
    "title": "02. 会员评论列表(不分页)",
    "description": "<p>获取当前会员评论列表(不分页)</p>",
    "group": "13._会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员评论编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "suffix",
            "description": "<p>内容类型 1 文本内容 2 音频内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CommentController.php",
    "groupTitle": "13._会员评论模块",
    "name": "GetApiMemberCommentSelect"
  },
  {
    "type": "post",
    "url": "/api/member/comment/handle",
    "title": "04. 评论操作",
    "description": "<p>当前会员执行评论操作</p>",
    "group": "13._会员评论模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "suffix",
            "description": "<p>评论内容类型 1 文本内容 2 音频内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/comment/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/CommentController.php",
    "groupTitle": "13._会员评论模块",
    "name": "PostApiMemberCommentHandle"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/archive",
    "title": "01. 当前管理老师档案",
    "description": "<p>获取当前管理老师的档案信息</p>",
    "group": "15._管理老师模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色内容</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/archive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/TeacherController.php",
    "groupTitle": "15._管理老师模块",
    "name": "GetApiTeacherManagementArchive"
  },
  {
    "type": "post",
    "url": "/api/teacher/management/handle",
    "title": "02. 编辑管理老师信息",
    "description": "<p>编辑管理老师的信息</p>",
    "group": "15._管理老师模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sex",
            "description": "<p>会员性别（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号码（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号码（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "qr_code",
            "description": "<p>二维码（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/TeacherController.php",
    "groupTitle": "15._管理老师模块",
    "name": "PostApiTeacherManagementHandle"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/course/list?page={page}",
    "title": "01. 课程列表(分页)",
    "description": "<p>获取当前管理老师的课程列表(分页)</p>",
    "group": "16._管理老师课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/course/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/CourseController.php",
    "groupTitle": "16._管理老师课程模块",
    "name": "GetApiTeacherManagementCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/course/select",
    "title": "02. 课程列表(不分页)",
    "description": "<p>获取当前管理老师的课程列表(不分页)</p>",
    "group": "16._管理老师课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/CourseController.php",
    "groupTitle": "16._管理老师课程模块",
    "name": "GetApiTeacherManagementCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/course/view/{id}",
    "title": "03. 课程详情",
    "description": "<p>获取当前管理老师的课程详情</p>",
    "group": "16._管理老师课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/course/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/CourseController.php",
    "groupTitle": "16._管理老师课程模块",
    "name": "GetApiTeacherManagementCourseViewId"
  },
  {
    "type": "post",
    "url": "/api/teacher/management/course/confirm",
    "title": "04. 确认添加家长微信",
    "description": "<p>当前管理老师确认添加家长微信</p>",
    "group": "16._管理老师课程模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/course/confirm"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/CourseController.php",
    "groupTitle": "16._管理老师课程模块",
    "name": "PostApiTeacherManagementCourseConfirm"
  },
  {
    "type": "get",
    "url": "/api/teacher/recruitment/archive",
    "title": "01. 当前招聘老师档案",
    "description": "<p>获取当前招聘老师的档案信息</p>",
    "group": "17._招聘老师模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          }
        ],
        "role params": [
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "role params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色内容</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/recruitment/archive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/TeacherController.php",
    "groupTitle": "17._招聘老师模块",
    "name": "GetApiTeacherRecruitmentArchive"
  },
  {
    "type": "get",
    "url": "/api/teacher/recruitment/status",
    "title": "03. 当前老师是否填写资料",
    "description": "<p>获取当前老师是否填写资料信息</p>",
    "group": "17._招聘老师模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "data",
            "description": "<p>true|false</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/recruitment/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/TeacherController.php",
    "groupTitle": "17._招聘老师模块",
    "name": "GetApiTeacherRecruitmentStatus"
  },
  {
    "type": "post",
    "url": "/api/teacher/recruitment/handle",
    "title": "02. 编辑招聘老师信息",
    "description": "<p>编辑招聘老师的信息</p>",
    "group": "17._招聘老师模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "sex",
            "description": "<p>会员性别（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号码（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "province_id",
            "description": "<p>省（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "city_id",
            "description": "<p>市（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "region_id",
            "description": "<p>县（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号码（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "qr_code",
            "description": "<p>二维码（可以为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/recruitment/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/TeacherController.php",
    "groupTitle": "17._招聘老师模块",
    "name": "PostApiTeacherRecruitmentHandle"
  },
  {
    "type": "get",
    "url": "/api/member/attention/list?page={page}",
    "title": "01. 会员关注列表(分页)",
    "description": "<p>获取当前会员关注列表(分页)</p>",
    "group": "19._会员关注模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员关注编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "attention_member_id",
            "description": "<p>关注会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>关注时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/attention/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AttentionController.php",
    "groupTitle": "19._会员关注模块",
    "name": "GetApiMemberAttentionListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/attention/select",
    "title": "02. 会员关注列表(不分页)",
    "description": "<p>获取当前会员关注列表(不分页)</p>",
    "group": "19._会员关注模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员关注编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "attention_member_id",
            "description": "<p>关注会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>关注时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/attention/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AttentionController.php",
    "groupTitle": "19._会员关注模块",
    "name": "GetApiMemberAttentionSelect"
  },
  {
    "type": "post",
    "url": "/api/member/attention/handle",
    "title": "04. 关注操作",
    "description": "<p>当前会员执行关注操作, 已经关注过，再次点击取消关注</p>",
    "group": "19._会员关注模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "attention_member_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/attention/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AttentionController.php",
    "groupTitle": "19._会员关注模块",
    "name": "PostApiMemberAttentionHandle"
  },
  {
    "type": "post",
    "url": "/api/member/attention/status",
    "title": "03. 是否关注会员",
    "description": "<p>获取当前会员关注的详情</p>",
    "group": "19._会员关注模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "attention_member_id",
            "description": "<p>关注会员编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>是否关注</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/attention/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AttentionController.php",
    "groupTitle": "19._会员关注模块",
    "name": "PostApiMemberAttentionStatus"
  },
  {
    "type": "get",
    "url": "/api/advertising/position/list?page={page}",
    "title": "1. 获取广告位列表(分页)",
    "description": "<p>获取广告位列表(分页)</p>",
    "group": "20._广告位模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>广告位宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>广告位高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/position/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/Relevance/PositionController.php",
    "groupTitle": "20._广告位模块",
    "name": "GetApiAdvertisingPositionListPagePage"
  },
  {
    "type": "get",
    "url": "/api/advertising/position/select",
    "title": "2. 获取广告位列表(不分页)",
    "description": "<p>获取广告位列表(不分页)</p>",
    "group": "20._广告位模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>广告位宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>广告位高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/position/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/Relevance/PositionController.php",
    "groupTitle": "20._广告位模块",
    "name": "GetApiAdvertisingPositionSelect"
  },
  {
    "type": "get",
    "url": "/api/advertising/position/view/{id}",
    "title": "3. 获取广告位详情",
    "description": "<p>获取广告位详情</p>",
    "group": "20._广告位模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>广告位宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>广告位高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/position/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/Relevance/PositionController.php",
    "groupTitle": "20._广告位模块",
    "name": "GetApiAdvertisingPositionViewId"
  },
  {
    "type": "get",
    "url": "/api/advertising/list?page={page}",
    "title": "1. 获取广告列表(分页)",
    "description": "<p>获取广告列表(分页)</p>",
    "group": "21._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>链接类型</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "21._广告模块",
    "name": "GetApiAdvertisingListPagePage"
  },
  {
    "type": "get",
    "url": "/api/advertising/select",
    "title": "2. 获取广告列表(不分页)",
    "description": "<p>获取广告列表(不分页)</p>",
    "group": "21._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>链接类型</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "21._广告模块",
    "name": "GetApiAdvertisingSelect"
  },
  {
    "type": "get",
    "url": "/api/advertising/view/{id}",
    "title": "3. 获取广告详情",
    "description": "<p>获取广告详情</p>",
    "group": "21._广告模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>广告其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>链接类型</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/advertising/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Advertising/AdvertisingController.php",
    "groupTitle": "21._广告模块",
    "name": "GetApiAdvertisingViewId"
  },
  {
    "type": "get",
    "url": "/api/production/list?page={page}",
    "title": "1. 获取作品列表(分页)",
    "description": "<p>获取作品列表(分页)</p>",
    "group": "22._作品模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>排序查询类型 1: 年龄 2: 城市 3: 点赞 4: 关注（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_approval",
            "description": "<p>当前用户是否点赞</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/ProductionController.php",
    "groupTitle": "22._作品模块",
    "name": "GetApiProductionListPagePage"
  },
  {
    "type": "get",
    "url": "/api/production/select",
    "title": "2. 获取作品列表(不分页)",
    "description": "<p>获取作品列表(不分页)</p>",
    "group": "22._作品模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "type",
            "description": "<p>排序查询类型 1: 年龄 2: 城市 3: 点赞 4: 关注（可以为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_approval",
            "description": "<p>当前用户是否点赞</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/ProductionController.php",
    "groupTitle": "22._作品模块",
    "name": "GetApiProductionSelect"
  },
  {
    "type": "get",
    "url": "/api/production/view/{id}",
    "title": "3. 获取作品详情",
    "description": "<p>获取作品详情</p>",
    "group": "22._作品模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_approval",
            "description": "<p>当前用户是否点赞</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>会员账户</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>会员年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>会员所在地</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/ProductionController.php",
    "groupTitle": "22._作品模块",
    "name": "GetApiProductionViewId"
  },
  {
    "type": "get",
    "url": "/api/production/comment/list?page={page}",
    "title": "1. 作品评论位列表(分页)",
    "description": "<p>获取作品评论位列表(分页)</p>",
    "group": "23._作品评论模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品评论位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "suffix",
            "description": "<p>作品评论类型 1 文本内容 2 音频内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/comment/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/Relevance/CommentController.php",
    "groupTitle": "23._作品评论模块",
    "name": "GetApiProductionCommentListPagePage"
  },
  {
    "type": "get",
    "url": "/api/production/comment/select",
    "title": "2. 作品评论位列表(不分页)",
    "description": "<p>获取作品评论位列表(不分页)</p>",
    "group": "23._作品评论模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品评论位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "suffix",
            "description": "<p>作品评论类型 1 文本内容 2 音频内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "duration",
            "description": "<p>内容时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/comment/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/Relevance/CommentController.php",
    "groupTitle": "23._作品评论模块",
    "name": "GetApiProductionCommentSelect"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/index",
    "title": "4. 获取课件列表(不分页，关联查询)",
    "description": "<p>获取课件列表(不分页，关联查询)</p>",
    "group": "24._课件模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "present_id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课件周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "present params": [
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>礼包描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/index"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/CoursewareController.php",
    "groupTitle": "24._课件模块",
    "name": "GetApiEducationCoursewareIndex"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/list?page={page}",
    "title": "1. 获取课件列表(分页)",
    "description": "<p>获取课件列表(分页)</p>",
    "group": "24._课件模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "present_id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课件周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "present params": [
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>礼包描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/courseware/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/CoursewareController.php",
    "groupTitle": "24._课件模块",
    "name": "GetApiEducationCoursewareListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/select",
    "title": "2. 获取课件列表(不分页)",
    "description": "<p>获取课件列表(不分页)</p>",
    "group": "24._课件模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "present_id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课件周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "present params": [
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>礼包描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/CoursewareController.php",
    "groupTitle": "24._课件模块",
    "name": "GetApiEducationCoursewareSelect"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/view/{id}",
    "title": "3. 获取课件详情",
    "description": "<p>获取课件详情</p>",
    "group": "24._课件模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "present_id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课件周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "detail params": [
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>课件详情编号</p>"
          },
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>课件内容</p>"
          },
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "plan",
            "description": "<p>课件安排</p>"
          }
        ],
        "present params": [
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>礼包编号</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "present params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>礼包描述</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/CoursewareController.php",
    "groupTitle": "24._课件模块",
    "name": "GetApiEducationCoursewareViewId"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/list?page={page}",
    "title": "1. 课件级别列表(分页)",
    "description": "<p>获取课件级别列表(分页)</p>",
    "group": "25._课件级别模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件级别描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/LevelController.php",
    "groupTitle": "25._课件级别模块",
    "name": "GetApiEducationCoursewareLevelListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/select",
    "title": "2. 课件级别列表(不分页)",
    "description": "<p>获取课件级别列表(不分页)</p>",
    "group": "25._课件级别模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件级别描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/LevelController.php",
    "groupTitle": "25._课件级别模块",
    "name": "GetApiEducationCoursewareLevelSelect"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/view/{id}",
    "title": "3. 课件级别详情",
    "description": "<p>获取课件级别详情</p>",
    "group": "25._课件级别模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "minimum_age",
            "description": "<p>最小年龄</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "largest_age",
            "description": "<p>最大年龄</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "level",
            "description": "<p>课件级别信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件级别描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/LevelController.php",
    "groupTitle": "25._课件级别模块",
    "name": "GetApiEducationCoursewareLevelViewId"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/list?page={page}",
    "title": "01. 课件单元列表(分页)",
    "description": "<p>获取课件单元列表(分页)</p>",
    "group": "26._课件单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件单元描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/UnitController.php",
    "groupTitle": "26._课件单元模块",
    "name": "GetApiEducationCoursewareLevelUnitListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/select",
    "title": "02. 课件单元列表(不分页)",
    "description": "<p>获取课件单元列表(不分页)</p>",
    "group": "26._课件单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件单元描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/UnitController.php",
    "groupTitle": "26._课件单元模块",
    "name": "GetApiEducationCoursewareLevelUnitSelect"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/unlock",
    "title": "04. 课件单元解锁数据",
    "description": "<p>获取课件单元列表(不分页)</p>",
    "group": "26._课件单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件单元描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "wait_unlock_time",
            "description": "<p>解锁时间</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_unlock",
            "description": "<p>是否已解锁</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/unlock"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/UnitController.php",
    "groupTitle": "26._课件单元模块",
    "name": "GetApiEducationCoursewareLevelUnitUnlock"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/view/{id}",
    "title": "03. 课件单元详情",
    "description": "<p>获取课件详情</p>",
    "group": "26._课件单元模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>课件单元描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/UnitController.php",
    "groupTitle": "26._课件单元模块",
    "name": "GetApiEducationCoursewareLevelUnitViewId"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/point/list?page={page}",
    "title": "1. 课件知识点列表(分页)",
    "description": "<p>获取课件知识点列表(分页)</p>",
    "group": "27._课件知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件知识点名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课件知识点封面</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课件知识点视频</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/point/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "27._课件知识点模块",
    "name": "GetApiEducationCoursewareLevelUnitPointListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/point/select",
    "title": "2. 课件知识点列表(不分页)",
    "description": "<p>获取课件知识点列表(不分页)</p>",
    "group": "27._课件知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件知识点名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课件知识点封面</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课件知识点视频</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/point/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "27._课件知识点模块",
    "name": "GetApiEducationCoursewareLevelUnitPointSelect"
  },
  {
    "type": "get",
    "url": "/api/education/courseware/level/unit/point/view/{id}",
    "title": "3. 课件知识点详情",
    "description": "<p>获取课件知识点详情</p>",
    "group": "27._课件知识点模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件知识点名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课件知识点封面</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课件知识点视频</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/courseware/level/unit/point/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Courseware/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "27._课件知识点模块",
    "name": "GetApiEducationCoursewareLevelUnitPointViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/list?page={page}",
    "title": "1. 获取课程列表(分页)",
    "description": "<p>获取课程列表(分页)</p>",
    "group": "28._课程模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present",
            "description": "<p>礼包信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "28._课程模块",
    "name": "GetApiEducationCourseListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/select",
    "title": "2. 获取课程列表(不分页)",
    "description": "<p>获取课程列表(不分页)</p>",
    "group": "28._课程模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present",
            "description": "<p>礼包信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "28._课程模块",
    "name": "GetApiEducationCourseSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/view/{id}",
    "title": "3. 获取课程详情",
    "description": "<p>获取课程详情</p>",
    "group": "28._课程模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "present",
            "description": "<p>礼包信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "detail params": [
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>课程详情编号</p>"
          },
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>课程内容</p>"
          },
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "plan",
            "description": "<p>课程安排</p>"
          }
        ],
        "picture params": [
          {
            "group": "picture params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>课程轮播图片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/CourseController.php",
    "groupTitle": "28._课程模块",
    "name": "GetApiEducationCourseViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/teacher/list?page={page}",
    "title": "1. 课程老师列表(分页)",
    "description": "<p>获取课程老师列表(分页)</p>",
    "group": "29._课程老师模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>课程老师名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/teacher/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/TeacherController.php",
    "groupTitle": "29._课程老师模块",
    "name": "GetApiEducationCourseTeacherListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/teacher/select",
    "title": "2. 课程老师列表(不分页)",
    "description": "<p>获取课程老师列表(不分页)</p>",
    "group": "29._课程老师模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>课程老师名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/teacher/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/TeacherController.php",
    "groupTitle": "29._课程老师模块",
    "name": "GetApiEducationCourseTeacherSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/teacher/view/{id}",
    "title": "3. 课程老师详情",
    "description": "<p>获取课程老师详情</p>",
    "group": "29._课程老师模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>课程老师名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/teacher/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/TeacherController.php",
    "groupTitle": "29._课程老师模块",
    "name": "GetApiEducationCourseTeacherViewId"
  },
  {
    "type": "get",
    "url": "/api/member/invitation/list?page={page}",
    "title": "01. 会员邀请列表(分页)",
    "description": "<p>获取当前会员邀请列表(分页)</p>",
    "group": "30._会员邀请模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员邀请编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "invitation_member_id",
            "description": "<p>邀请会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>邀请时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/invitation/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/InvitationController.php",
    "groupTitle": "30._会员邀请模块",
    "name": "GetApiMemberInvitationListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/invitation/select",
    "title": "02. 会员邀请列表(不分页)",
    "description": "<p>获取当前会员邀请列表(不分页)</p>",
    "group": "30._会员邀请模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员邀请编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "invitation_member_id",
            "description": "<p>邀请会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>邀请时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/invitation/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/InvitationController.php",
    "groupTitle": "30._会员邀请模块",
    "name": "GetApiMemberInvitationSelect"
  },
  {
    "type": "post",
    "url": "/api/member/invitation/handle",
    "title": "04. 邀请操作",
    "description": "<p>当前会员执行邀请操作, 已经邀请过，再次点击取消邀请</p>",
    "group": "30._会员邀请模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "invitation_member_id",
            "description": "<p>作品编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/invitation/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/InvitationController.php",
    "groupTitle": "30._会员邀请模块",
    "name": "PostApiMemberInvitationHandle"
  },
  {
    "type": "post",
    "url": "/api/member/invitation/status",
    "title": "03. 是否邀请会员",
    "description": "<p>获取当前会员邀请的详情</p>",
    "group": "30._会员邀请模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "invitation_member_id",
            "description": "<p>邀请会员编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>是否邀请</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/invitation/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/InvitationController.php",
    "groupTitle": "30._会员邀请模块",
    "name": "PostApiMemberInvitationStatus"
  },
  {
    "type": "get",
    "url": "/api/education/course/unlock/list?page={page}",
    "title": "1. 课程解锁列表(分页)",
    "description": "<p>获取课程解锁列表(分页)</p>",
    "group": "31._课程解锁模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件解锁名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "section",
            "description": "<p>课程解锁章节</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>课程解锁时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>课程名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/unlock/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/UnlockController.php",
    "groupTitle": "31._课程解锁模块",
    "name": "GetApiEducationCourseUnlockListPagePage"
  },
  {
    "type": "get",
    "url": "/api/education/course/unlock/select",
    "title": "2. 课程解锁列表(不分页)",
    "description": "<p>获取课程解锁列表(不分页)</p>",
    "group": "31._课程解锁模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件解锁名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "section",
            "description": "<p>课程解锁章节</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>课程解锁时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>课程名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/unlock/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/UnlockController.php",
    "groupTitle": "31._课程解锁模块",
    "name": "GetApiEducationCourseUnlockSelect"
  },
  {
    "type": "get",
    "url": "/api/education/course/unlock/view/{id}",
    "title": "3. 课程解锁详情",
    "description": "<p>获取课程解锁详情</p>",
    "group": "31._课程解锁模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件解锁名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "section",
            "description": "<p>课程解锁章节</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>课程解锁时长</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>课程名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/unlock/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/UnlockController.php",
    "groupTitle": "31._课程解锁模块",
    "name": "GetApiEducationCourseUnlockViewId"
  },
  {
    "type": "post",
    "url": "/api/member/asset/center",
    "title": "01. 资产中心",
    "description": "<p>获取当前会员资产详情</p>",
    "group": "32._会员资产模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "red_envelope",
            "description": "<p>红包金额</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "lollipop",
            "description": "<p>棒棒糖数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "production",
            "description": "<p>作品数</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/center"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AssetController.php",
    "groupTitle": "32._会员资产模块",
    "name": "PostApiMemberAssetCenter"
  },
  {
    "type": "post",
    "url": "/api/member/asset/lollipop",
    "title": "02. 我的棒棒糖",
    "description": "<p>获取当前会员棒棒糖</p>",
    "group": "32._会员资产模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>棒棒糖数</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/lollipop"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AssetController.php",
    "groupTitle": "32._会员资产模块",
    "name": "PostApiMemberAssetLollipop"
  },
  {
    "type": "post",
    "url": "/api/member/asset/money",
    "title": "02. 我的红包",
    "description": "<p>获取当前会员棒棒糖</p>",
    "group": "32._会员资产模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>红包金额</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/money"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/AssetController.php",
    "groupTitle": "32._会员资产模块",
    "name": "PostApiMemberAssetMoney"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/member/list?page={page}",
    "title": "01. 学员列表(分页)",
    "description": "<p>获取当前管理老师的学员列表(分页)</p>",
    "group": "33._管理老师学员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/member/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/MemberController.php",
    "groupTitle": "33._管理老师学员模块",
    "name": "GetApiTeacherManagementMemberListPagePage"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/member/production",
    "title": "02. 作品列表(分页)",
    "description": "<p>获取当前管理老师学员的作品列表(分页)</p>",
    "group": "33._管理老师学员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "archive_id",
            "description": "<p>学员档案编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>作品名称</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "picture",
            "description": "<p>作品图片</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>作品描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "duration",
            "description": "<p>作品描述时长</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "comment_total",
            "description": "<p>评论数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐 0 为推荐 1 已推荐</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_approval",
            "description": "<p>是否点赞</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/member/production"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/MemberController.php",
    "groupTitle": "33._管理老师学员模块",
    "name": "GetApiTeacherManagementMemberProduction"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/member/view/{id}",
    "title": "03. 学员课程详情",
    "description": "<p>获取当前管理老师的课程详情</p>",
    "group": "33._管理老师学员模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>自增编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "teacher_id",
            "description": "<p>管理老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_add",
            "description": "<p>家长微信是否被添加 1 是 2 否</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_time",
            "description": "<p>报名时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态 0 待确认 1 已确认</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "confirm_time",
            "description": "<p>报名确认时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "teacher params": [
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "organization_id",
            "description": "<p>老师所属机构编号（暂时用不上）</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>老师头像</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "qr_code",
            "description": "<p>老师二维码</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "teacher params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>老师姓名</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "condition",
            "description": "<p>成为条件 1 系统添加 2 完成任务</p>"
          },
          {
            "group": "teacher params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/member/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/MemberController.php",
    "groupTitle": "33._管理老师学员模块",
    "name": "GetApiTeacherManagementMemberViewId"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/list?page={page}",
    "title": "01. 会员课程单元列表(分页)",
    "description": "<p>获取当前会员订阅的课程单元列表(分页)</p>",
    "group": "34._会员课程单元模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "unit params": [
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程单元描述</p>"
          },
          {
            "group": "unit params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/UnitController.php",
    "groupTitle": "34._会员课程单元模块",
    "name": "GetApiMemberCourseUnitListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/select",
    "title": "02. 会员课程单元列表(不分页)",
    "description": "<p>获取当前会员订阅的课程单元列表(不分页)</p>",
    "group": "34._会员课程单元模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "unit params": [
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程单元描述</p>"
          },
          {
            "group": "unit params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/UnitController.php",
    "groupTitle": "34._会员课程单元模块",
    "name": "GetApiMemberCourseUnitSelect"
  },
  {
    "type": "get",
    "url": "/api/member/course/view/unit/{id}",
    "title": "03. 当前会员课程单元详情",
    "description": "<p>获取当前会员课程单元详情</p>",
    "group": "34._会员课程单元模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "unit params": [
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元名称</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "description",
            "description": "<p>课程单元描述</p>"
          },
          {
            "group": "unit params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "unit params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/UnitController.php",
    "groupTitle": "34._会员课程单元模块",
    "name": "GetApiMemberCourseViewUnitId"
  },
  {
    "type": "get",
    "url": "/api/template/list?page={page}",
    "title": "1. 获取模板列表(分页)",
    "description": "<p>获取模板列表(分页)</p>",
    "group": "35._模板模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>模板编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>模板名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>模板图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_top",
            "description": "<p>左上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_bottom",
            "description": "<p>左下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_top",
            "description": "<p>右上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_bottom",
            "description": "<p>右下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>模板排序</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/template/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Template/TemplateController.php",
    "groupTitle": "35._模板模块",
    "name": "GetApiTemplateListPagePage"
  },
  {
    "type": "get",
    "url": "/api/template/select",
    "title": "2. 获取模板列表(不分页)",
    "description": "<p>获取模板列表(不分页)</p>",
    "group": "35._模板模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>模板编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>模板名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>模板图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_top",
            "description": "<p>左上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_bottom",
            "description": "<p>左下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_top",
            "description": "<p>右上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_bottom",
            "description": "<p>右下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>模板排序</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/template/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Template/TemplateController.php",
    "groupTitle": "35._模板模块",
    "name": "GetApiTemplateSelect"
  },
  {
    "type": "get",
    "url": "/api/template/view/{id}",
    "title": "3. 获取模板详情",
    "description": "<p>获取模板详情</p>",
    "group": "35._模板模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>模板编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>模板名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>模板图片</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_top",
            "description": "<p>左上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "left_bottom",
            "description": "<p>左下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_top",
            "description": "<p>右上坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "right_bottom",
            "description": "<p>右下坐标点</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "sort",
            "description": "<p>模板排序</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/template/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Template/TemplateController.php",
    "groupTitle": "35._模板模块",
    "name": "GetApiTemplateViewId"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/point/list?page={page}",
    "title": "01. 会员课程知识点列表(分页)",
    "description": "<p>获取当前会员订阅的课程列表(分页)</p>",
    "group": "36._会员课程知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课程单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "point_id",
            "description": "<p>课件单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_unlock",
            "description": "<p>是否解锁 0 未解锁 1 已解锁</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_time",
            "description": "<p>解锁时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "point params": [
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程单元知识点编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件级别单元编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元知识点名称</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "picture",
            "description": "<p>课程单元知识点图片</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课程单元知识点资源地址</p>"
          },
          {
            "group": "point params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/point/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "36._会员课程知识点模块",
    "name": "GetApiMemberCourseUnitPointListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/point/select",
    "title": "02. 会员课程知识点列表(不分页)",
    "description": "<p>获取当前会员订阅的课程知识点列表(不分页)</p>",
    "group": "36._会员课程知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课程单元编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "point_id",
            "description": "<p>课件单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_unlock",
            "description": "<p>是否解锁 0 未解锁 1 已解锁</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_time",
            "description": "<p>解锁时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "point params": [
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程单元知识点编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件级别单元编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元知识点名称</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "picture",
            "description": "<p>课程单元知识点图片</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课程单元知识点资源地址</p>"
          },
          {
            "group": "point params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/point/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "36._会员课程知识点模块",
    "name": "GetApiMemberCourseUnitPointSelect"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/point/status/{id}",
    "title": "04. 当前课程知识点是否完成",
    "description": "<p>获取当前课程知识点是否完成</p>",
    "group": "36._会员课程知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Boolean",
            "optional": false,
            "field": "true",
            "description": "<p>|false 是否完成</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/point/status/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "36._会员课程知识点模块",
    "name": "GetApiMemberCourseUnitPointStatusId"
  },
  {
    "type": "get",
    "url": "/api/member/course/unit/point/view/{id}",
    "title": "03. 当前会员课程知识点详情",
    "description": "<p>获取当前会员课程知识点详情</p>",
    "group": "36._会员课程知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>学员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件单元编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "point_id",
            "description": "<p>课件单元知识点编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_unlock",
            "description": "<p>是否解锁 0 未解锁 1 已解锁</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_time",
            "description": "<p>解锁时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_finish",
            "description": "<p>是否完成学习 0 未完成 1 已完成</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ],
        "point params": [
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程单元知识点编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "unit_id",
            "description": "<p>课件级别单元编号</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>课件单元知识点名称</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "picture",
            "description": "<p>课程单元知识点图片</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "url",
            "description": "<p>课程单元知识点资源地址</p>"
          },
          {
            "group": "point params",
            "type": "String",
            "optional": false,
            "field": "sort",
            "description": "<p>排序</p>"
          },
          {
            "group": "point params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/point/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "36._会员课程知识点模块",
    "name": "GetApiMemberCourseUnitPointViewId"
  },
  {
    "type": "post",
    "url": "/api/member/course/unit/point/finish",
    "title": "05. 完成课程知识点",
    "description": "<p>当前会员学习完成了课程知识点</p>",
    "group": "36._会员课程知识点模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": "<p>学员课程单元知识点编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/course/unit/point/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Relevance/Relevance/PointController.php",
    "groupTitle": "36._会员课程知识点模块",
    "name": "PostApiMemberCourseUnitPointFinish"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/squad/list?page={page}",
    "title": "01. 班级列表(分页)",
    "description": "<p>获取当前管理老师的班级列表(分页)</p>",
    "group": "37._管理老师班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present",
            "description": "<p>礼包信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_start_time",
            "description": "<p>开课时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "line_price",
            "description": "<p>划线价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "real_price",
            "description": "<p>销售价格</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_status",
            "description": "<p>报名状态</p>"
          }
        ],
        "courseware params": [
          {
            "group": "courseware params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/squad/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/SquadController.php",
    "groupTitle": "37._管理老师班级模块",
    "name": "GetApiTeacherManagementSquadListPagePage"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/squad/student?page={page}",
    "title": "02. 班级学员列表(分页)",
    "description": "<p>获取当前管理老师的班级学员列表(分页)</p>",
    "group": "37._管理老师班级模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "archive params",
            "type": "Number",
            "optional": false,
            "field": "skill_level",
            "description": "<p>绘画基础</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "id_card_no",
            "description": "<p>身份证号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "weixin",
            "description": "<p>微信号</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "birthday",
            "description": "<p>生日</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "address",
            "description": "<p>详细地址</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/squad/student"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Management/Relevance/SquadController.php",
    "groupTitle": "37._管理老师班级模块",
    "name": "GetApiTeacherManagementSquadStudentPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/role/info",
    "title": "01. 获取会员角色信息",
    "description": "<p>获取会员角色信息</p>",
    "group": "38._会员角色模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>角色描述</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>创建时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/role/info"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/RoleController.php",
    "groupTitle": "38._会员角色模块",
    "name": "GetApiMemberRoleInfo"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/money/center",
    "title": "01. 分红中心",
    "description": "<p>获取当前招聘老师的课程详情</p>",
    "group": "39._招聘老师分红模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>分红编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>招聘老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "wait_money",
            "description": "<p>待分红金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "wait_number",
            "description": "<p>待分红人数</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "total_money",
            "description": "<p>总分红金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "total_number",
            "description": "<p>总分红人数</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/money/center"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/Relevance/MoneyController.php",
    "groupTitle": "39._招聘老师分红模块",
    "name": "GetApiTeacherManagementMoneyCenter"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/money/extract/list?page={page}",
    "title": "03. 获取分红提取列表(分页)",
    "description": "<p>获取当前招聘老师的分红提取列表(分页)</p>",
    "group": "39._招聘老师分红模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>老师分红提取编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "type",
            "description": "<p>提取类型</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "unlock_id",
            "description": "<p>解锁编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课程名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present",
            "description": "<p>礼包信息</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>优惠说明</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_start_time",
            "description": "<p>报名开始时间</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "apply_end_time",
            "description": "<p>报名结束时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/money/extract/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/Relevance/Relevance/ExtractController.php",
    "groupTitle": "39._招聘老师分红模块",
    "name": "GetApiTeacherManagementMoneyExtractListPagePage"
  },
  {
    "type": "get",
    "url": "/api/teacher/management/money/obtain/list?page={page}",
    "title": "02. 获取分红收益列表(分页)",
    "description": "<p>获取当前招聘老师的分红列表(分页)</p>",
    "group": "39._招聘老师分红模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>分红获取编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>老师编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "money_id",
            "description": "<p>分红编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "courseware_id",
            "description": "<p>课件编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "level_id",
            "description": "<p>课件级别编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>获取金额</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "settlement_status",
            "description": "<p>结算状态</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>获取时间</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          }
        ],
        "archive params": [
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "archive params",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>所在城市</p>"
          }
        ],
        "course params": [
          {
            "group": "course params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>课程周期</p>"
          }
        ],
        "courseware params": [
          {
            "group": "courseware params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>课件名称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/teacher/management/money/obtain/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Teacher/Recruitment/Relevance/Relevance/ObtainController.php",
    "groupTitle": "39._招聘老师分红模块",
    "name": "GetApiTeacherManagementMoneyObtainListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/logistics/list?page={page}",
    "title": "01. 商品订单物流列表(分页)",
    "description": "<p>获取当前会员商品订单物流列表(分页)</p>",
    "group": "40._商品订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/logistics/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Goods/LogisticsController.php",
    "groupTitle": "40._商品订单物流模块",
    "name": "GetApiMemberOrderGoodsLogisticsListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/logistics/select",
    "title": "02. 商品订单物流列表(不分页)",
    "description": "<p>获取当前会员商品订单物流列表(不分页)</p>",
    "group": "40._商品订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/logistics/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Goods/LogisticsController.php",
    "groupTitle": "40._商品订单物流模块",
    "name": "GetApiMemberOrderGoodsLogisticsSelect"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/logistics/view/{id}",
    "title": "03. 商品订单物流详情",
    "description": "<p>获取当前会员商品订单物流的详情</p>",
    "group": "40._商品订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/logistics/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Goods/LogisticsController.php",
    "groupTitle": "40._商品订单物流模块",
    "name": "GetApiMemberOrderGoodsLogisticsViewId"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/logistics/list?page={page}",
    "title": "01. 课程订单物流列表(分页)",
    "description": "<p>获取当前会员课程订单物流列表(分页)</p>",
    "group": "40._课程订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present_name",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>礼包周期</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/logistics/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Course/LogisticsController.php",
    "groupTitle": "40._课程订单物流模块",
    "name": "GetApiMemberOrderCourseLogisticsListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/logistics/select",
    "title": "02. 课程订单物流列表(不分页)",
    "description": "<p>获取当前会员课程订单物流列表(不分页)</p>",
    "group": "40._课程订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present_name",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>礼包周期</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/logistics/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Course/LogisticsController.php",
    "groupTitle": "40._课程订单物流模块",
    "name": "GetApiMemberOrderCourseLogisticsSelect"
  },
  {
    "type": "get",
    "url": "/api/member/order/course/logistics/view/{id}",
    "title": "03. 课程订单物流详情",
    "description": "<p>获取当前会员课程订单物流的详情</p>",
    "group": "40._课程订单物流模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "present_name",
            "description": "<p>礼包名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "semester",
            "description": "<p>礼包周期</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/logistics/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/Course/LogisticsController.php",
    "groupTitle": "40._课程订单物流模块",
    "name": "GetApiMemberOrderCourseLogisticsViewId"
  },
  {
    "type": "get",
    "url": "/api/goods/list?page={page}",
    "title": "1. 获取商品列表(分页)",
    "description": "<p>获取商品列表(分页)</p>",
    "group": "41._商品模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面图</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖兑换数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cash_money",
            "description": "<p>现金价格</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已经兑换数量</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/goods/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Goods/GoodsController.php",
    "groupTitle": "41._商品模块",
    "name": "GetApiGoodsListPagePage"
  },
  {
    "type": "get",
    "url": "/api/goods/select",
    "title": "2. 获取商品列表(不分页)",
    "description": "<p>获取商品列表(不分页)</p>",
    "group": "41._商品模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面图</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖兑换数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cash_money",
            "description": "<p>现金价格</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已经兑换数量</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/goods/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Goods/GoodsController.php",
    "groupTitle": "41._商品模块",
    "name": "GetApiGoodsSelect"
  },
  {
    "type": "get",
    "url": "/api/goods/view/{id}",
    "title": "3. 获取商品详情",
    "description": "<p>获取商品详情</p>",
    "group": "41._商品模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面图</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖兑换数</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "cash_money",
            "description": "<p>现金价格</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已经兑换数量</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "detail params": [
          {
            "group": "detail params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>商品详情</p>"
          }
        ],
        "picture params": [
          {
            "group": "picture params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>商品轮播图片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/goods/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Goods/GoodsController.php",
    "groupTitle": "41._商品模块",
    "name": "GetApiGoodsViewId"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/list?page={page}",
    "title": "01. 商品订单列表(分页)",
    "description": "<p>获取当前会员商品订单列表(分页)</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "goods_id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "exchange_type",
            "description": "<p>兑换方式 1 棒棒糖 2 现金</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖数量</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "goods params": [
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>兑换需要棒棒糖数量</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "cash_money",
            "description": "<p>兑换需要现金</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已兑换数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "GetApiMemberOrderGoodsListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/select",
    "title": "02. 商品订单列表(不分页)",
    "description": "<p>获取当前会员商品订单列表(不分页)</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "goods_id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "exchange_type",
            "description": "<p>兑换方式 1 棒棒糖 2 现金</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖数量</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "goods params": [
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>兑换需要棒棒糖数量</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "cash_money",
            "description": "<p>兑换需要现金</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已兑换数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "GetApiMemberOrderGoodsSelect"
  },
  {
    "type": "get",
    "url": "/api/member/order/goods/view/{id}",
    "title": "03. 商品订单详情",
    "description": "<p>获取当前会员商品订单的详情</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "order_no",
            "description": "<p>订单号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "goods_id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "exchange_type",
            "description": "<p>兑换方式 1 棒棒糖 2 现金</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖数量</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付宝 2 微信 4 苹果</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "order_status",
            "description": "<p>订单状态 0 待发货 1 待签收 2 已签收</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>支付时间</p>"
          }
        ],
        "goods params": [
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>商品名称</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "cover",
            "description": "<p>商品封面</p>"
          },
          {
            "group": "goods params",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>商品描述</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>兑换需要棒棒糖数量</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "cash_money",
            "description": "<p>兑换需要现金</p>"
          },
          {
            "group": "goods params",
            "type": "Number",
            "optional": false,
            "field": "exchange_total",
            "description": "<p>已兑换数量</p>"
          }
        ],
        "member params": [
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "open_id",
            "description": "<p>第三方登录编号</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "member params",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "is_freeze",
            "description": "<p>是否冻结 1 冻结 2 不冻结</p>"
          },
          {
            "group": "member params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>注册时间</p>"
          }
        ],
        "logistics params": [
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>订单物流编号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "company_name",
            "description": "<p>物流公司名称</p>"
          },
          {
            "group": "logistics params",
            "type": "String",
            "optional": false,
            "field": "logistics_no",
            "description": "<p>物流单号</p>"
          },
          {
            "group": "logistics params",
            "type": "Number",
            "optional": false,
            "field": "logistics_status",
            "description": "<p>物流状态 0 待发货 1 待签收 2 已签收</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "GetApiMemberOrderGoodsViewId"
  },
  {
    "type": "post",
    "url": "/api/member/order/course/cancel",
    "title": "07. 商品订单取消",
    "description": "<p>当前会员取消商品订单</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/course/cancel"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "PostApiMemberOrderCourseCancel"
  },
  {
    "type": "post",
    "url": "/api/member/order/goods/change",
    "title": "09. 修改商品订单",
    "description": "<p>当前会员修改修改商品订单</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address_id",
            "description": "<p>收货地址编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付包 2 微信 4 苹果</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/change"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "PostApiMemberOrderGoodsChange"
  },
  {
    "type": "post",
    "url": "/api/member/order/goods/finish",
    "title": "08. 商品订单完成",
    "description": "<p>当前会员收到货物后，点击完成商品订单</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "PostApiMemberOrderGoodsFinish"
  },
  {
    "type": "post",
    "url": "/api/member/order/goods/handle",
    "title": "04. 创建商品订单",
    "description": "<p>当前会员购买商品后，创建商品订单</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "goods_id",
            "description": "<p>商品编号</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "address_id",
            "description": "<p>收货地址编号</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "exchange_type",
            "description": "<p>兑换方式 1 棒棒糖 2 现金</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "lollipop_total",
            "description": "<p>棒棒糖数量（与支付金额只填写一个默认使用棒棒糖）</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "pay_money",
            "description": "<p>支付金额（与棒棒糖数量只填写一个默认使用棒棒糖）</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "pay_type",
            "description": "<p>支付类型 1 支付包 2 微信 3 棒棒糖 4 苹果</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "PostApiMemberOrderGoodsHandle"
  },
  {
    "type": "post",
    "url": "/api/member/order/goods/pay",
    "title": "05. 订单支付确认",
    "description": "<p>当前会员支付完成后，调用接口更改订单支付状态</p>",
    "group": "42._商品订单模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "order_id",
            "description": "<p>订单编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/order/goods/pay"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Relevance/Order/GoodsController.php",
    "groupTitle": "42._商品订单模块",
    "name": "PostApiMemberOrderGoodsPay"
  },
  {
    "type": "get",
    "url": "/api/complain/category/select",
    "title": "01. 获取投诉分类列表(不分页)",
    "description": "<p>获取投诉分类列表(不分页)</p>",
    "group": "43._投诉分类模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉分类编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>投诉分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/complain/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Complain/Relevance/CategoryController.php",
    "groupTitle": "43._投诉分类模块",
    "name": "GetApiComplainCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/complain/list?page={page}",
    "title": "01. 获取我的投诉列表(分页)",
    "description": "<p>获取我的投诉列表(分页)</p>",
    "group": "44._投诉模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "position_id",
            "description": "<p>投诉位编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>投诉位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>投诉标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>投诉图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>投诉其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>投诉链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/complain/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Complain/ComplainController.php",
    "groupTitle": "44._投诉模块",
    "name": "GetApiComplainListPagePage"
  },
  {
    "type": "get",
    "url": "/api/complain/select",
    "title": "02. 获取我的投诉列表(不分页)",
    "description": "<p>获取我的投诉列表(不分页)</p>",
    "group": "44._投诉模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "position_id",
            "description": "<p>投诉位编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>投诉位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>投诉标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>投诉图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>投诉其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>投诉链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/complain/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Complain/ComplainController.php",
    "groupTitle": "44._投诉模块",
    "name": "GetApiComplainSelect"
  },
  {
    "type": "get",
    "url": "/api/complain/view/{id}",
    "title": "03. 获取我的投诉详情",
    "description": "<p>获取我的投诉详情</p>",
    "group": "44._投诉模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>投诉位编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>投诉标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>投诉图片资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "url",
            "description": "<p>投诉其他资源</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>投诉链接</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/complain/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Complain/ComplainController.php",
    "groupTitle": "44._投诉模块",
    "name": "GetApiComplainViewId"
  },
  {
    "type": "post",
    "url": "/api/complain/handle",
    "title": "04. 编辑投诉信息",
    "description": "<p>编辑招聘老师的信息</p>",
    "group": "44._投诉模块",
    "permission": [
      {
        "name": "jwt"
      }
    ],
    "header": {
      "fields": {
        "Header": [
          {
            "group": "Header",
            "type": "String",
            "optional": false,
            "field": "Authorization",
            "description": "<p>身份令牌</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Header-Example:",
          "content": "{\n  \"Authorization\": \"eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN\"\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "category_id",
            "description": "<p>投诉类型（不可为空）</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>投诉内容（不可为空）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/complain/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Complain/ComplainController.php",
    "groupTitle": "44._投诉模块",
    "name": "PostApiComplainHandle"
  },
  {
    "type": "get",
    "url": "/api/production/approval/list?page={page}",
    "title": "1. 获取作品点赞列表(分页)",
    "description": "<p>获取作品点赞列表(分页)</p>",
    "group": "45._作品点赞模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品点赞编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>作品点赞名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>作品点赞宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>作品点赞高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/approval/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/Relevance/ApprovalController.php",
    "groupTitle": "45._作品点赞模块",
    "name": "GetApiProductionApprovalListPagePage"
  },
  {
    "type": "get",
    "url": "/api/production/approval/select",
    "title": "2. 获取作品点赞列表(不分页)",
    "description": "<p>获取作品点赞列表(不分页)</p>",
    "group": "45._作品点赞模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号（可以为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品点赞编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>作品点赞名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>作品点赞宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>作品点赞高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/approval/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/Relevance/ApprovalController.php",
    "groupTitle": "45._作品点赞模块",
    "name": "GetApiProductionApprovalSelect"
  },
  {
    "type": "get",
    "url": "/api/production/approval/view/{id}",
    "title": "3. 获取作品点赞详情",
    "description": "<p>获取作品点赞详情</p>",
    "group": "45._作品点赞模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>作品点赞编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>作品点赞名称</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "is_open",
            "description": "<p>是否开启 1 开启 2 未开启</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "width",
            "description": "<p>作品点赞宽度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "height",
            "description": "<p>作品点赞高度</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/production/approval/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Production/Relevance/ApprovalController.php",
    "groupTitle": "45._作品点赞模块",
    "name": "GetApiProductionApprovalViewId"
  },
  {
    "type": "get",
    "url": "/api/common/problem/list?page={page}",
    "title": "1. 获取常见问题列表(分页)",
    "description": "<p>获取常见问题列表(分页)</p>",
    "group": "46._常见问题模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "page",
            "description": "<p>当前页数</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "position_id",
            "description": "<p>常见问题位编号</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/problem/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ProblemController.php",
    "groupTitle": "46._常见问题模块",
    "name": "GetApiCommonProblemListPagePage"
  },
  {
    "type": "get",
    "url": "/api/common/problem/select",
    "title": "2. 获取常见问题列表(不分页)",
    "description": "<p>获取常见问题列表(不分页)</p>",
    "group": "46._常见问题模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题答案</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/problem/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ProblemController.php",
    "groupTitle": "46._常见问题模块",
    "name": "GetApiCommonProblemSelect"
  },
  {
    "type": "get",
    "url": "/api/common/problem/view/{id}",
    "title": "3. 获取常见问题详情",
    "description": "<p>获取常见问题详情</p>",
    "group": "46._常见问题模块",
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "basic params",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题答案</p>"
          },
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>添加时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/common/problem/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/ProblemController.php",
    "groupTitle": "46._常见问题模块",
    "name": "GetApiCommonProblemViewId"
  },
  {
    "type": "get",
    "url": "/api/education/course/share/data",
    "title": "01. 课程分享数据",
    "description": "<p>获取课程解锁详情</p>",
    "group": "47._课程分享模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号（不能为空）</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "basic params": [
          {
            "group": "basic params",
            "type": "Number",
            "optional": false,
            "field": "picture",
            "description": "<p>分享图片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/education/course/share/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Education/Course/Relevance/ShareController.php",
    "groupTitle": "47._课程分享模块",
    "name": "GetApiEducationCourseShareData"
  },
  {
    "type": "post",
    "url": "/api/code/code",
    "title": "999. 系统状态值说明",
    "description": "<p>系统全局状态值说明</p>",
    "group": "状态值模块",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "200",
            "description": "<p>成功</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1000",
            "description": "<p>未知错误</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1001",
            "description": "<p>没有权限</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1002",
            "description": "<p>删除成功</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1003",
            "description": "<p>删除失败</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1004",
            "description": "<p>操作成功</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1005",
            "description": "<p>操作失败</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1006",
            "description": "<p>您请求太频繁了，请休息一会</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "1007",
            "description": "<p>清除失败</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2000",
            "description": "<p>服务器错误</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2001",
            "description": "<p>用户不存在</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2002",
            "description": "<p>用户无权限</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2003",
            "description": "<p>请输入正确密码</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2004",
            "description": "<p>输错密码次数太多，请一小时后再试！</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2005",
            "description": "<p>会员不存在</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2006",
            "description": "<p>会员已失效</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "2007",
            "description": "<p>验证码错误</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "-100",
            "description": "<p>请先登录</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "-101",
            "description": "<p>Token丢失</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "-102",
            "description": "<p>请从新登录</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "-103",
            "description": "<p>非法账户，无法解析</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "app/Http/Controllers/Api/System/CodeController.php",
    "groupTitle": "状态值模块",
    "name": "PostApiCodeCode"
  }
] });
