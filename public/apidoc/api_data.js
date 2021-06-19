define({ "api": [
  {
    "type": "get",
    "url": "/api/logout",
    "title": "11. 退出",
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
        "字段说明|令牌": [
          {
            "group": "字段说明|令牌",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "字段说明|用户": [
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ],
        "字段说明|角色": [
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "字段说明|角色",
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
    "url": "/api/back_mobile",
    "title": "10. 手机找回密码",
    "description": "<p>通过手机号码找回密码</p>",
    "group": "01._登录模块",
    "parameter": {
      "fields": {
        "Parameter": [
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
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/back_mobile"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiBack_mobile"
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
        "字段说明|令牌": [
          {
            "group": "字段说明|令牌",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "字段说明|用户": [
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ],
        "字段说明|角色": [
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "字段说明|角色",
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
            "type": "string",
            "optional": true,
            "field": "open_id",
            "description": "<p>微信app编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
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
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "sex",
            "description": "<p>会员性别</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "age",
            "description": "<p>会员性别</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "address",
            "description": "<p>详细地址</p>"
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
    "url": "/api/reset_code",
    "title": "09. 重置验证码",
    "description": "<p>获取重置验证码</p>",
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
    "success": {
      "fields": {
        "响应": [
          {
            "group": "响应",
            "type": "String",
            "optional": false,
            "field": "data",
            "description": "<p>验证码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/reset_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/System/LoginController.php",
    "groupTitle": "01._登录模块",
    "name": "PostApiReset_code"
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
        "字段说明|令牌": [
          {
            "group": "字段说明|令牌",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "字段说明|用户": [
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ],
        "字段说明|角色": [
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "字段说明|角色",
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
        "字段说明|令牌": [
          {
            "group": "字段说明|令牌",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>身份令牌</p>"
          }
        ],
        "字段说明|用户": [
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "open_id",
            "description": "<p>微信编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "apply_id",
            "description": "<p>苹果编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "Number",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|用户",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ],
        "字段说明|角色": [
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|角色",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>角色名称</p>"
          },
          {
            "group": "字段说明|角色",
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
    "title": "03. 关于我们",
    "description": "<p>获取关于我们协议</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
    "url": "/api/common/agreement/employ",
    "title": "05. 使用协议",
    "description": "<p>获取使用协议</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
        "url": "/api/common/agreement/employ"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementEmploy"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/liability",
    "title": "08. 免责声明",
    "description": "<p>获取免责声明</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
        "url": "/api/common/agreement/liability"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementLiability"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/privacy",
    "title": "06. 隐私协议",
    "description": "<p>获取使用协议</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
        "url": "/api/common/agreement/privacy"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementPrivacy"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/specification",
    "title": "07. 账户使用规范",
    "description": "<p>获取账户使用规范</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
        "url": "/api/common/agreement/specification"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/AgreementController.php",
    "groupTitle": "02._公共模块",
    "name": "GetApiCommonAgreementSpecification"
  },
  {
    "type": "get",
    "url": "/api/common/agreement/user",
    "title": "04. 用户协议",
    "description": "<p>获取用户协议</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "basic params": [
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
    "title": "02. 地区列表",
    "description": "<p>获取全国地区列表</p>",
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
    "url": "/api/system/kernel",
    "title": "01. 系统信息",
    "description": "<p>获取系统配置内容信息</p>",
    "group": "02._公共模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_chinese_name",
            "description": "<p>网站中文名称</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_english_name",
            "description": "<p>网站英文名字</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_url",
            "description": "<p>站点链接</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "keywords",
            "description": "<p>网站关键字</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "description",
            "description": "<p>网站描述</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "logo",
            "description": "<p>网站logo</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "mobile",
            "description": "<p>公司电话</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>公司邮箱</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "copyright",
            "description": "<p>备案号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "web_status",
            "description": "<p>站点状态</p>"
          },
          {
            "group": "字段说明",
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
    "url": "/api/common/notify/alipay",
    "title": "15. 支付宝支付回调",
    "description": "<p>获取支付宝支付回调</p>",
    "group": "02._公共模块",
    "sampleRequest": [
      {
        "url": "/api/common/notify/alipay"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/NotifyController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonNotifyAlipay"
  },
  {
    "type": "post",
    "url": "/api/common/notify/apple",
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
        "url": "/api/common/notify/apple"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/NotifyController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonNotifyApple"
  },
  {
    "type": "post",
    "url": "/api/common/notify/wechat",
    "title": "14. 微信支付回调",
    "description": "<p>获取微信支付回调</p>",
    "group": "02._公共模块",
    "sampleRequest": [
      {
        "url": "/api/common/notify/wechat"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/NotifyController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonNotifyWechat"
  },
  {
    "type": "post",
    "url": "/api/common/pay/data",
    "title": "09. 支付类型",
    "description": "<p>获取支付类型</p>",
    "group": "02._公共模块",
    "sampleRequest": [
      {
        "url": "/api/common/pay/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Common/PayController.php",
    "groupTitle": "02._公共模块",
    "name": "PostApiCommonPayData"
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
    "url": "/api/file/file",
    "title": "01. 上传文件",
    "description": "<p>通过base64的内容进行文件上传</p>",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "category",
            "description": "<p>文件分类 excel word pdf video audio ...</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>文件地址</p>"
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
    "url": "/api/file/picture",
    "title": "02. 上传图片",
    "description": "<p>通过base64的内容进行图片上传</p>",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "category",
            "description": "<p>图片分类 picture avatar ...</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "string",
            "optional": false,
            "field": "data",
            "description": "<p>图片地址</p>"
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
    "url": "/api/advertising/position/select",
    "title": "01. 广告位数据",
    "description": "<p>获取广告位不分页列表数据</p>",
    "group": "04._广告位模块",
    "success": {
      "fields": {
        "响应|广告位": [
          {
            "group": "响应|广告位",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "响应|广告位",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
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
    "filename": "app/Http/Controllers/Api/Module/Advertising/PositionController.php",
    "groupTitle": "04._广告位模块",
    "name": "GetApiAdvertisingPositionSelect"
  },
  {
    "type": "get",
    "url": "/api/advertising/position/view/{id}",
    "title": "02. 广告位详情",
    "description": "<p>获取广告位详情</p>",
    "group": "04._广告位模块",
    "success": {
      "fields": {
        "响应|广告位": [
          {
            "group": "响应|广告位",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "响应|广告位",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>广告位名称</p>"
          }
        ],
        "响应|广告": [
          {
            "group": "响应|广告",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "响应|广告",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "响应|广告",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告链接</p>"
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
    "filename": "app/Http/Controllers/Api/Module/Advertising/PositionController.php",
    "groupTitle": "04._广告位模块",
    "name": "GetApiAdvertisingPositionViewId"
  },
  {
    "type": "get",
    "url": "/api/advertising/select",
    "title": "01. 广告数据",
    "description": "<p>获取广告不分页列表</p>",
    "group": "05._广告模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "position_id",
            "description": "<p>广告位编号</p>"
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": true,
            "field": "total",
            "description": "<p>显示广告数量，默认显示5条</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>广告标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>广告图片</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "link",
            "description": "<p>广告链接</p>"
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
    "filename": "app/Http/Controllers/Api/Module/AdvertisingController.php",
    "groupTitle": "05._广告模块",
    "name": "GetApiAdvertisingSelect"
  },
  {
    "type": "get",
    "url": "/api/complain/category/select",
    "title": "01. 投诉分类数据",
    "description": "<p>获取投诉分类不分页列表数据</p>",
    "group": "06._投诉分类模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉分类编号</p>"
          },
          {
            "group": "字段说明",
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
    "filename": "app/Http/Controllers/Api/Module/Complain/CategoryController.php",
    "groupTitle": "06._投诉分类模块",
    "name": "GetApiComplainCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/problem/category/select",
    "title": "01. 常见问题分类数据",
    "description": "<p>获取常见问题分类不分页列表数据</p>",
    "group": "07._常见问题分类模块",
    "success": {
      "fields": {
        "字段说明|问题分类": [
          {
            "group": "字段说明|问题分类",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题分类编号</p>"
          },
          {
            "group": "字段说明|问题分类",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题分类标题</p>"
          }
        ],
        "字段说明|问题": [
          {
            "group": "字段说明|问题",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "字段说明|问题",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/problem/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Problem/CategoryController.php",
    "groupTitle": "07._常见问题分类模块",
    "name": "GetApiProblemCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/problem/list?page={page}",
    "title": "01. 常见问题列表",
    "description": "<p>获取常见问题分页列表</p>",
    "group": "08._常见问题模块",
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
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/problem/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/ProblemController.php",
    "groupTitle": "08._常见问题模块",
    "name": "GetApiProblemListPagePage"
  },
  {
    "type": "get",
    "url": "/api/problem/select",
    "title": "02. 常见问题数据",
    "description": "<p>获取常见问题不分页列表数据</p>",
    "group": "08._常见问题模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/problem/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/ProblemController.php",
    "groupTitle": "08._常见问题模块",
    "name": "GetApiProblemSelect"
  },
  {
    "type": "get",
    "url": "/api/problem/view/{id}",
    "title": "03. 常见问题详情",
    "description": "<p>获取常见问题详情</p>",
    "group": "08._常见问题模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>常见问题编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>常见问题标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>常见问题内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/problem/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/ProblemController.php",
    "groupTitle": "08._常见问题模块",
    "name": "GetApiProblemViewId"
  },
  {
    "type": "get",
    "url": "/api/notice/category/select",
    "title": "01. 通知分类数据",
    "description": "<p>获取通知分类不分页列表数据</p>",
    "group": "09._通知分类模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员通知分类编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>会员通知分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/notice/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Notice/CategoryController.php",
    "groupTitle": "09._通知分类模块",
    "name": "GetApiNoticeCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/project/category/select",
    "title": "01. 项目分类数据",
    "description": "<p>获取项目分类不分页列表数据</p>",
    "group": "10._项目分类模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>项目分类编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>项目分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/project/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Project/CategoryController.php",
    "groupTitle": "10._项目分类模块",
    "name": "GetApiProjectCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/member/archive",
    "title": "01. 当前会员档案",
    "description": "<p>获取当前会员的档案信息</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明|会员": [
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          }
        ],
        "字段说明|档案": [
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "attention_total",
            "description": "<p>关注总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "fans_total",
            "description": "<p>粉丝总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "accepted_total",
            "description": "<p>获赞总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "字段说明|档案",
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
        "url": "/api/member/archive"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "GetApiMemberArchive"
  },
  {
    "type": "get",
    "url": "/api/member/asset",
    "title": "02. 当前会员资产",
    "description": "<p>获取当前会员的资产信息</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明|会员": [
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          }
        ],
        "字段说明|资产": [
          {
            "group": "字段说明|资产",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>充值金额</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "GetApiMemberAsset"
  },
  {
    "type": "get",
    "url": "/api/member/data",
    "title": "03. 会员数据",
    "description": "<p>根据会员编号获取会员数据</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "description": "<p>会员编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明|会员": [
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "role_id",
            "description": "<p>角色编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "inviter_id",
            "description": "<p>邀请人编号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "member_no",
            "description": "<p>会员号</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>登录账户</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          }
        ],
        "字段说明|档案": [
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "sex",
            "description": "<p>性别</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "age",
            "description": "<p>年龄</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "attention_total",
            "description": "<p>关注总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "fans_total",
            "description": "<p>粉丝总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "approval_total",
            "description": "<p>点赞总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "accepted_total",
            "description": "<p>获赞总数</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "字段说明|档案",
            "type": "String",
            "optional": false,
            "field": "region_id",
            "description": "<p>县</p>"
          },
          {
            "group": "字段说明|档案",
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
        "url": "/api/member/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "GetApiMemberData"
  },
  {
    "type": "get",
    "url": "/api/member/status",
    "title": "04. 当前会员是否填写资料",
    "description": "<p>获取当前会员是否填写资料信息</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
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
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "GetApiMemberStatus"
  },
  {
    "type": "post",
    "url": "/api/member/change_code",
    "title": "07. 修改验证码",
    "description": "<p>获取当前会员的修改验证码</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "username",
            "description": "<p>旧手机号码（18201018888）</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/change_code"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "PostApiMemberChange_code"
  },
  {
    "type": "post",
    "url": "/api/member/change_mobile",
    "title": "08. 修改手机号码",
    "description": "<p>修改当前会员的手机号码</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "username",
            "description": "<p>手机号码</p>"
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
        "url": "/api/change_mobile"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "PostApiMemberChange_mobile"
  },
  {
    "type": "post",
    "url": "/api/member/handle",
    "title": "05. 编辑会员信息",
    "description": "<p>编辑会员信息</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "description": "<p>会员头像</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员姓名</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "sex",
            "description": "<p>会员性别</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "age",
            "description": "<p>会员性别</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "province_id",
            "description": "<p>省</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "city_id",
            "description": "<p>市</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "region_id",
            "description": "<p>县</p>"
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
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "PostApiMemberHandle"
  },
  {
    "type": "post",
    "url": "/api/member/password",
    "title": "06. 修改会员密码",
    "description": "<p>修改会员密码</p>",
    "group": "20._会员模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "old_password",
            "description": "<p>旧密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>新密码</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password_confirmation",
            "description": "<p>确认密码</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/password"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/MemberController.php",
    "groupTitle": "20._会员模块",
    "name": "PostApiMemberPassword"
  },
  {
    "type": "get",
    "url": "/api/member/asset/list",
    "title": "01. 我的收支记录",
    "description": "<p>获取当前会员的收支记录</p>",
    "group": "21._会员资产模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "type",
            "description": "<p>收支类型</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>收支金额</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>收支时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/AssetController.php",
    "groupTitle": "21._会员资产模块",
    "name": "GetApiMemberAssetList"
  },
  {
    "type": "post",
    "url": "/api/member/asset/expend",
    "title": "03. 我的消费记录",
    "description": "<p>获取当前会员的消费记录</p>",
    "group": "21._会员资产模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>收支金额</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>收支时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/expend"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/AssetController.php",
    "groupTitle": "21._会员资产模块",
    "name": "PostApiMemberAssetExpend"
  },
  {
    "type": "post",
    "url": "/api/member/asset/income",
    "title": "02. 我的充值记录",
    "description": "<p>获取当前会员的充值记录</p>",
    "group": "21._会员资产模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "money",
            "description": "<p>收支金额</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>收支时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/asset/income"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/AssetController.php",
    "groupTitle": "21._会员资产模块",
    "name": "PostApiMemberAssetIncome"
  },
  {
    "type": "get",
    "url": "/api/member/attention/list?page={page}",
    "title": "01. 会员关注列表",
    "description": "<p>获取当前会员关注分页列表</p>",
    "group": "22._会员关注模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明|基础": [
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员关注编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "attention_member_id",
            "description": "<p>关注会员编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>关注时间</p>"
          }
        ],
        "字段说明|关注人": [
          {
            "group": "字段说明|关注人",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "字段说明|关注人",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
          }
        ],
        "字段说明|被关注人": [
          {
            "group": "字段说明|被关注人",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "字段说明|被关注人",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
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
    "filename": "app/Http/Controllers/Api/Module/Member/AttentionController.php",
    "groupTitle": "22._会员关注模块",
    "name": "GetApiMemberAttentionListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/attention/handle",
    "title": "03. 关注操作",
    "description": "<p>当前会员执行关注操作, 已经关注过，再次点击取消关注</p>",
    "group": "22._会员关注模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "description": "<p>关注编号</p>"
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
    "filename": "app/Http/Controllers/Api/Module/Member/AttentionController.php",
    "groupTitle": "22._会员关注模块",
    "name": "PostApiMemberAttentionHandle"
  },
  {
    "type": "post",
    "url": "/api/member/attention/status",
    "title": "02. 是否关注会员",
    "description": "<p>获取当前会员是否关注指定会员</p>",
    "group": "22._会员关注模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明": [
          {
            "group": "字段说明",
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
    "filename": "app/Http/Controllers/Api/Module/Member/AttentionController.php",
    "groupTitle": "22._会员关注模块",
    "name": "PostApiMemberAttentionStatus"
  },
  {
    "type": "get",
    "url": "/api/member/invitation/list?page={page}",
    "title": "01. 会员邀请列表",
    "description": "<p>获取当前会员邀请分页列表</p>",
    "group": "23._会员邀请模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明|基础": [
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员邀请编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "invitation_member_id",
            "description": "<p>邀请会员编号</p>"
          },
          {
            "group": "字段说明|基础",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>邀请时间</p>"
          }
        ],
        "字段说明|邀请人": [
          {
            "group": "字段说明|邀请人",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "字段说明|邀请人",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
          }
        ],
        "字段说明|被邀请人": [
          {
            "group": "字段说明|被邀请人",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>头像</p>"
          },
          {
            "group": "字段说明|被邀请人",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>昵称</p>"
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
    "filename": "app/Http/Controllers/Api/Module/Member/InvitationController.php",
    "groupTitle": "23._会员邀请模块",
    "name": "GetApiMemberInvitationListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/invitation/handle",
    "title": "03. 邀请操作",
    "description": "<p>当前会员执行邀请操作, 已经邀请过，再次点击取消邀请</p>",
    "group": "23._会员邀请模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
    "filename": "app/Http/Controllers/Api/Module/Member/InvitationController.php",
    "groupTitle": "23._会员邀请模块",
    "name": "PostApiMemberInvitationHandle"
  },
  {
    "type": "post",
    "url": "/api/member/invitation/status",
    "title": "02. 是否邀请会员",
    "description": "<p>获取当前会员邀请的详情</p>",
    "group": "23._会员邀请模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明": [
          {
            "group": "字段说明",
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
    "filename": "app/Http/Controllers/Api/Module/Member/InvitationController.php",
    "groupTitle": "23._会员邀请模块",
    "name": "PostApiMemberInvitationStatus"
  },
  {
    "type": "get",
    "url": "/api/member/notice/list?page={page}",
    "title": "我的通知列表",
    "description": "<p>获取当前会员通知分页列表</p>",
    "group": "24._会员通知模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "message_category_id",
            "description": "<p>通知分类编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>会员通知编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>通知内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>通知时间</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/notice/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/NoticeController.php",
    "groupTitle": "24._会员通知模块",
    "name": "GetApiMemberNoticeListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/notice/finish",
    "title": "我的通知已阅读",
    "description": "<p>当前会员通知标记已阅读</p>",
    "group": "24._会员通知模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "message_id",
            "description": "<p>会员通知编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/notice/finish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/NoticeController.php",
    "groupTitle": "24._会员通知模块",
    "name": "PostApiMemberNoticeFinish"
  },
  {
    "type": "get",
    "url": "/api/member/complain/list?page={page}",
    "title": "01. 我的投诉列表",
    "description": "<p>获取我的投诉分页列表</p>",
    "group": "25._会员投诉模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "category_id",
            "description": "<p>投诉位编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明|投诉": [
          {
            "group": "字段说明|投诉",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉编号</p>"
          },
          {
            "group": "字段说明|投诉",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>投诉内容</p>"
          },
          {
            "group": "字段说明|投诉",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>投诉时间</p>"
          }
        ],
        "字段说明|投诉分类": [
          {
            "group": "字段说明|投诉分类",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>投诉分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/complain/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/ComplainController.php",
    "groupTitle": "25._会员投诉模块",
    "name": "GetApiMemberComplainListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/complain/view/{id}",
    "title": "02. 我的投诉详情",
    "description": "<p>获取我的投诉详情</p>",
    "group": "25._会员投诉模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明|投诉": [
          {
            "group": "字段说明|投诉",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>投诉编号</p>"
          },
          {
            "group": "字段说明|投诉",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>投诉内容</p>"
          },
          {
            "group": "字段说明|投诉",
            "type": "Number",
            "optional": false,
            "field": "create_time",
            "description": "<p>投诉时间</p>"
          }
        ],
        "字段说明|投诉分类": [
          {
            "group": "字段说明|投诉分类",
            "type": "Number",
            "optional": false,
            "field": "title",
            "description": "<p>投诉分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/complain/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/ComplainController.php",
    "groupTitle": "25._会员投诉模块",
    "name": "GetApiMemberComplainViewId"
  },
  {
    "type": "post",
    "url": "/api/member/complain/handle",
    "title": "03. 提交投诉信息",
    "description": "<p>提交投诉信息</p>",
    "group": "25._会员投诉模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "url": "/api/member/complain/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/ComplainController.php",
    "groupTitle": "25._会员投诉模块",
    "name": "PostApiMemberComplainHandle"
  },
  {
    "type": "post",
    "url": "/api/member/contact/handle",
    "title": "01. 提交联系客服信息",
    "description": "<p>提交联系客服信息信息</p>",
    "group": "26._会员客服模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "title",
            "description": "<p>投诉类型</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>投诉内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "name",
            "description": "<p>投诉内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": "<p>投诉内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/contact/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/ContactController.php",
    "groupTitle": "26._会员客服模块",
    "name": "PostApiMemberContactHandle"
  },
  {
    "type": "get",
    "url": "/api/member/information/list?page={page}",
    "title": "01. 我的资讯列表",
    "description": "<p>获取我的资讯分页列表</p>",
    "group": "27._会员资讯模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/member/information/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/InformationController.php",
    "groupTitle": "27._会员资讯模块",
    "name": "GetApiMemberInformationListPagePage"
  },
  {
    "type": "get",
    "url": "/api/member/information/view/{id}",
    "title": "02. 我的资讯详情",
    "description": "<p>获取我的资讯详情</p>",
    "group": "27._会员资讯模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/member/information/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/InformationController.php",
    "groupTitle": "27._会员资讯模块",
    "name": "GetApiMemberInformationViewId"
  },
  {
    "type": "post",
    "url": "/api/member/information/handle",
    "title": "03. 资讯发布",
    "description": "<p>当前会员资讯发布</p>",
    "group": "27._会员资讯模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "description": "<p>资讯分类</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/InformationController.php",
    "groupTitle": "27._会员资讯模块",
    "name": "PostApiMemberInformationHandle"
  },
  {
    "type": "get",
    "url": "/api/member/setting/data",
    "title": "01. 我的设置",
    "description": "<p>获取我的设置详情</p>",
    "group": "28._会员设置模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "order_switch",
            "description": "<p>订单开关</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "activity_switch",
            "description": "<p>活动开关</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/setting/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/SettingController.php",
    "groupTitle": "28._会员设置模块",
    "name": "GetApiMemberSettingData"
  },
  {
    "type": "post",
    "url": "/api/member/setting/handle",
    "title": "03. 推送设置",
    "description": "<p>当前会员设置推送开关</p>",
    "group": "28._会员设置模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "order_switch",
            "description": "<p>订单开关</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "activity_switch",
            "description": "<p>活动开关</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/setting/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/SettingController.php",
    "groupTitle": "28._会员设置模块",
    "name": "PostApiMemberSettingHandle"
  },
  {
    "type": "post",
    "url": "/api/member/certification/company",
    "title": "03. 企业认证",
    "description": "<p>当前会员企业认证</p>",
    "group": "29._会员认证模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "company_name",
            "description": "<p>企业名称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "business_license_no",
            "description": "<p>营业执照号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "business_license_picture",
            "description": "<p>营业执照图片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification/company"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/CertificationController.php",
    "groupTitle": "29._会员认证模块",
    "name": "PostApiMemberCertificationCompany"
  },
  {
    "type": "post",
    "url": "/api/member/certification/data",
    "title": "05. 我的认证",
    "description": "<p>当前会员认证信息</p>",
    "group": "29._会员认证模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明|个人": [
          {
            "group": "字段说明|个人",
            "type": "string",
            "optional": false,
            "field": "id_card_front_picture",
            "description": "<p>身份证正面照片</p>"
          },
          {
            "group": "字段说明|个人",
            "type": "string",
            "optional": false,
            "field": "id_card_behind_picture",
            "description": "<p>身份证反面照片</p>"
          }
        ],
        "字段说明|企业": [
          {
            "group": "字段说明|企业",
            "type": "string",
            "optional": false,
            "field": "company_name",
            "description": "<p>企业名称</p>"
          },
          {
            "group": "字段说明|企业",
            "type": "string",
            "optional": false,
            "field": "business_license_no",
            "description": "<p>营业执照号</p>"
          },
          {
            "group": "字段说明|企业",
            "type": "string",
            "optional": false,
            "field": "business_license_picture",
            "description": "<p>营业执照图片</p>"
          }
        ],
        "字段说明|项目": [
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_name",
            "description": "<p>项目名称</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_logo",
            "description": "<p>项目logo</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "realname",
            "description": "<p>联系人</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "category_id",
            "description": "<p>项目类型</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_website",
            "description": "<p>项目官网</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_document",
            "description": "<p>白皮书地址</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_social",
            "description": "<p>社交媒体</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_report",
            "description": "<p>审计报告</p>"
          },
          {
            "group": "字段说明|项目",
            "type": "string",
            "optional": false,
            "field": "project_github",
            "description": "<p>github地址</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification/data"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/CertificationController.php",
    "groupTitle": "29._会员认证模块",
    "name": "PostApiMemberCertificationData"
  },
  {
    "type": "post",
    "url": "/api/member/certification/personal",
    "title": "02. 个人认证",
    "description": "<p>当前会员个人认证</p>",
    "group": "29._会员认证模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "id_card_front_picture",
            "description": "<p>身份证正面照片</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id_card_behind_picture",
            "description": "<p>身份证反面照片</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification/personal"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/CertificationController.php",
    "groupTitle": "29._会员认证模块",
    "name": "PostApiMemberCertificationPersonal"
  },
  {
    "type": "post",
    "url": "/api/member/certification/project",
    "title": "04. 项目认证",
    "description": "<p>当前会员项目认证</p>",
    "group": "29._会员认证模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "project_name",
            "description": "<p>项目名称</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "project_logo",
            "description": "<p>项目logo</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "realname",
            "description": "<p>联系人</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "mobile",
            "description": "<p>联系人手机号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "category_id",
            "description": "<p>项目类型</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "project_website",
            "description": "<p>项目官网</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "project_document",
            "description": "<p>白皮书地址</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "project_social",
            "description": "<p>社交媒体</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "project_report",
            "description": "<p>审计报告</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "project_github",
            "description": "<p>github地址</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification/project"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/CertificationController.php",
    "groupTitle": "29._会员认证模块",
    "name": "PostApiMemberCertificationProject"
  },
  {
    "type": "post",
    "url": "/api/member/certification/status",
    "title": "01. 会员是否认证",
    "description": "<p>当前会员是否认证</p>",
    "group": "29._会员认证模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Boolean",
            "optional": false,
            "field": "status",
            "description": "<p>是否认证</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/certification/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/CertificationController.php",
    "groupTitle": "29._会员认证模块",
    "name": "PostApiMemberCertificationStatus"
  },
  {
    "type": "get",
    "url": "/api/flash/category/select",
    "title": "01. 快讯分类数据",
    "description": "<p>获取快讯分类不分页列表数据</p>",
    "group": "50._快讯分类模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>快讯分类编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>快讯分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/flash/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Flash/CategoryController.php",
    "groupTitle": "50._快讯分类模块",
    "name": "GetApiFlashCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/flash/list?page={page}",
    "title": "01. 快讯列表",
    "description": "<p>获取快讯分页列表</p>",
    "group": "51._快讯模块",
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
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>快讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>快讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>快讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bullish_total",
            "description": "<p>利多总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bearish_total",
            "description": "<p>利空总数</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/flash/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/FlashController.php",
    "groupTitle": "51._快讯模块",
    "name": "GetApiFlashListPagePage"
  },
  {
    "type": "get",
    "url": "/api/flash/view/{id}",
    "title": "02. 快讯详情",
    "description": "<p>获取快讯详情</p>",
    "group": "51._快讯模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>快讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>快讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>快讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bullish_total",
            "description": "<p>利多总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bearish_total",
            "description": "<p>利空总数</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/flash/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/FlashController.php",
    "groupTitle": "51._快讯模块",
    "name": "GetApiFlashViewId"
  },
  {
    "type": "get",
    "url": "/api/flash/comment/select",
    "title": "01. 快讯评论数据",
    "description": "<p>获取快讯评论不分页列表数据</p>",
    "group": "52._快讯评论模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "flash_id",
            "description": "<p>快讯编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明|评论": [
          {
            "group": "字段说明|评论",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "字段说明|评论",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ],
        "字段说明|评论人": [
          {
            "group": "字段说明|评论人",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>评论人头像</p>"
          },
          {
            "group": "字段说明|评论人",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>评论人昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/flash/comment/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Flash/CommentController.php",
    "groupTitle": "52._快讯评论模块",
    "name": "GetApiFlashCommentSelect"
  },
  {
    "type": "post",
    "url": "/api/member/flash/comment/handle",
    "title": "02. 快讯评论操作",
    "description": "<p>当前会员执行快讯评论操作</p>",
    "group": "52._快讯评论模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "flash_id",
            "description": "<p>快讯编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "parent_id",
            "description": "<p>上级评论编号, 0为初始评论</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/flash/comment/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Flash/CommentController.php",
    "groupTitle": "52._快讯评论模块",
    "name": "PostApiMemberFlashCommentHandle"
  },
  {
    "type": "get",
    "url": "/api/member/flash/benefit/bearish",
    "title": "02. 会员点赞列表(不分页)",
    "description": "<p>获取当前会员点赞列表(不分页)</p>",
    "group": "54._会员快讯利益模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>会员点赞编号</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "member_id",
            "description": "<p>会员编号</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "course_id",
            "description": "<p>课程编号</p>"
          },
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "production_id",
            "description": "<p>作品编号</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/member/flash/benefit/bearish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Flash/BenefitController.php",
    "groupTitle": "54._会员快讯利益模块",
    "name": "GetApiMemberFlashBenefitBearish"
  },
  {
    "type": "get",
    "url": "/api/member/flash/benefit/bullish",
    "title": "01. 会员利多操作",
    "description": "<p>当前会员会员快讯利多操作</p>",
    "group": "54._会员快讯利益模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "flash_id",
            "description": "<p>快讯编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/flash/benefit/bullish"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Flash/BenefitController.php",
    "groupTitle": "54._会员快讯利益模块",
    "name": "GetApiMemberFlashBenefitBullish"
  },
  {
    "type": "get",
    "url": "/api/information/category/select",
    "title": "01. 资讯分类数据",
    "description": "<p>获取资讯分类不分页列表数据</p>",
    "group": "60._资讯分类模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯分类编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯分类标题</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/information/category/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Information/CategoryController.php",
    "groupTitle": "60._资讯分类模块",
    "name": "GetApiInformationCategorySelect"
  },
  {
    "type": "get",
    "url": "/api/information/list?page={page}",
    "title": "01. 资讯列表",
    "description": "<p>获取资讯分页列表</p>",
    "group": "61._资讯模块",
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
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/information/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/InformationController.php",
    "groupTitle": "61._资讯模块",
    "name": "GetApiInformationListPagePage"
  },
  {
    "type": "get",
    "url": "/api/information/recommend?page={page}",
    "title": "02. 推荐资讯列表",
    "description": "<p>获取推荐资讯分页列表</p>",
    "group": "61._资讯模块",
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
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/information/recommend"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/InformationController.php",
    "groupTitle": "61._资讯模块",
    "name": "GetApiInformationRecommendPagePage"
  },
  {
    "type": "get",
    "url": "/api/information/related?page={page}",
    "title": "03. 相关资讯列表",
    "description": "<p>获取相关资讯分页列表</p>",
    "group": "61._资讯模块",
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
            "field": "label_id",
            "description": "<p>标签编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/information/related"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/InformationController.php",
    "groupTitle": "61._资讯模块",
    "name": "GetApiInformationRelatedPagePage"
  },
  {
    "type": "get",
    "url": "/api/information/view/{id}",
    "title": "04. 资讯详情",
    "description": "<p>获取资讯详情</p>",
    "group": "61._资讯模块",
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bullish_total",
            "description": "<p>利多总数</p>"
          },
          {
            "group": "字段说明",
            "type": "String",
            "optional": false,
            "field": "bearish_total",
            "description": "<p>利空总数</p>"
          },
          {
            "group": "字段说明",
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
        "url": "/api/information/view/{id}"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/InformationController.php",
    "groupTitle": "61._资讯模块",
    "name": "GetApiInformationViewId"
  },
  {
    "type": "get",
    "url": "/api/information/comment/select",
    "title": "01. 资讯评论数据",
    "description": "<p>获取资讯评论不分页列表数据</p>",
    "group": "62._资讯评论模块",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "字段说明|评论": [
          {
            "group": "字段说明|评论",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          },
          {
            "group": "字段说明|评论",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>评论时间</p>"
          }
        ],
        "字段说明|评论人": [
          {
            "group": "字段说明|评论人",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>评论人头像</p>"
          },
          {
            "group": "字段说明|评论人",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>评论人昵称</p>"
          }
        ],
        "字段说明|被评论人": [
          {
            "group": "字段说明|被评论人",
            "type": "String",
            "optional": false,
            "field": "avatar",
            "description": "<p>被评论人头像</p>"
          },
          {
            "group": "字段说明|被评论人",
            "type": "String",
            "optional": false,
            "field": "nickname",
            "description": "<p>被评论人昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/information/comment/select"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Information/CommentController.php",
    "groupTitle": "62._资讯评论模块",
    "name": "GetApiInformationCommentSelect"
  },
  {
    "type": "post",
    "url": "/api/member/information/comment/handle",
    "title": "02. 资讯评论操作",
    "description": "<p>当前会员执行评论操作</p>",
    "group": "62._资讯评论模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": true,
            "field": "parent_id",
            "description": "<p>上级评论编号, 0为初始评论</p>"
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "content",
            "description": "<p>评论内容</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/comment/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/CommentController.php",
    "groupTitle": "62._资讯评论模块",
    "name": "PostApiMemberInformationCommentHandle"
  },
  {
    "type": "get",
    "url": "/api/member/information/approval/list?page={page}",
    "title": "01. 会员点赞列表",
    "description": "<p>获取当前会员点赞分页列表</p>",
    "group": "63._资讯点赞模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明|资讯": [
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "字段说明|会员": [
          {
            "group": "字段说明|会员",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/approval/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/ApprovalController.php",
    "groupTitle": "63._资讯点赞模块",
    "name": "GetApiMemberInformationApprovalListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/information/approval/handle",
    "title": "03. 点赞操作",
    "description": "<p>当前会员执行资讯点赞操作, 已经点赞过，再次点击取消点赞</p>",
    "group": "63._资讯点赞模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/approval/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/ApprovalController.php",
    "groupTitle": "63._资讯点赞模块",
    "name": "PostApiMemberInformationApprovalHandle"
  },
  {
    "type": "post",
    "url": "/api/member/information/approval/status",
    "title": "02. 资讯是否点赞",
    "description": "<p>获取当前会员点赞的详情</p>",
    "group": "63._资讯点赞模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/approval/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/ApprovalController.php",
    "groupTitle": "63._资讯点赞模块",
    "name": "PostApiMemberInformationApprovalStatus"
  },
  {
    "type": "get",
    "url": "/api/member/information/collection/list?page={page}",
    "title": "01. 我的收藏列表",
    "description": "<p>获取当前会员收藏分页列表</p>",
    "group": "64._资讯收藏模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明|资讯": [
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "create_time",
            "description": "<p>发布时间</p>"
          }
        ],
        "字段说明|会员": [
          {
            "group": "字段说明|会员",
            "type": "Number",
            "optional": false,
            "field": "avatar",
            "description": "<p>会员头像</p>"
          },
          {
            "group": "字段说明|会员",
            "type": "Number",
            "optional": false,
            "field": "nickname",
            "description": "<p>会员昵称</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/collection/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/CollectionController.php",
    "groupTitle": "64._资讯收藏模块",
    "name": "GetApiMemberInformationCollectionListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/information/collection/handle",
    "title": "03. 收藏操作",
    "description": "<p>当前会员执行资讯收藏操作, 已经收藏过，再次点击取消收藏</p>",
    "group": "64._资讯收藏模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/collection/handle"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/CollectionController.php",
    "groupTitle": "64._资讯收藏模块",
    "name": "PostApiMemberInformationCollectionHandle"
  },
  {
    "type": "post",
    "url": "/api/member/information/collection/status",
    "title": "02. 资讯是否收藏",
    "description": "<p>获取当前会员资讯收藏的详情</p>",
    "group": "64._资讯收藏模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "字段说明": [
          {
            "group": "字段说明",
            "type": "Number",
            "optional": false,
            "field": "information_id",
            "description": "<p>资讯编号</p>"
          }
        ]
      }
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/collection/status"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/CollectionController.php",
    "groupTitle": "64._资讯收藏模块",
    "name": "PostApiMemberInformationCollectionStatus"
  },
  {
    "type": "get",
    "url": "/api/member/information/browse/list?page={page}",
    "title": "01. 我的浏览历史列表",
    "description": "<p>获取我的浏览历史分页列表</p>",
    "group": "65._资讯浏览历史模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
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
        "字段说明|资讯": [
          {
            "group": "字段说明|资讯",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>资讯编号</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>资讯标题</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "picture",
            "description": "<p>资讯封面</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "content",
            "description": "<p>资讯内容</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "source",
            "description": "<p>资讯来源</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "author",
            "description": "<p>资讯作者</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "read_total",
            "description": "<p>阅读总数</p>"
          },
          {
            "group": "字段说明|资讯",
            "type": "String",
            "optional": false,
            "field": "is_recommend",
            "description": "<p>是否推荐</p>"
          },
          {
            "group": "字段说明|资讯",
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
        "url": "/api/member/information/browse/list"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/BrowseController.php",
    "groupTitle": "65._资讯浏览历史模块",
    "name": "GetApiMemberInformationBrowseListPagePage"
  },
  {
    "type": "post",
    "url": "/api/member/information/browse/clear",
    "title": "02. 清除浏览历史",
    "description": "<p>当前会员清除浏览历史</p>",
    "group": "65._资讯浏览历史模块",
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
          "content": "{\n  \"Authorization\": \"Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiO\"\n}",
          "type": "json"
        }
      ]
    },
    "sampleRequest": [
      {
        "url": "/api/member/information/browse/clear"
      }
    ],
    "version": "1.0.0",
    "filename": "app/Http/Controllers/Api/Module/Member/Information/BrowseController.php",
    "groupTitle": "65._资讯浏览历史模块",
    "name": "PostApiMemberInformationBrowseClear"
  }
] });
