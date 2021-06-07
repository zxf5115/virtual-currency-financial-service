<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
  'namespace'  =>  'Api',
  'middleware'  =>  'serializer:array'
], function ($api)
{
  $api->group([
    'middleware'  =>  'api.throttle', // 启用节流限制
    'limit'  =>  1000, // 允许次数
    'expires'  =>  1, // 分钟
  ], function ($api)
  {
    $api->group(['namespace' => 'System'], function ($api) {
      $api->post('login', 'LoginController@login'); // 密码登录
      $api->post('sms_login', 'LoginController@sms_login'); // 短信登录
      $api->post('sms_code', 'LoginController@sms_code'); // 登录验证码
      $api->post('weixin_login', 'LoginController@weixin_login'); // 微信登录
      $api->post('apple_login', 'LoginController@apple_login'); // 苹果登录
      $api->post('h5_login', 'LoginController@h5_login'); // H5登录
      $api->get('weixin_redirect', 'LoginController@weixin_redirect');
      $api->post('register', 'LoginController@register');
      $api->post('bind_mobile', 'LoginController@bind_mobile');
      $api->post('apple_bind_mobile', 'LoginController@apple_bind_mobile');
      $api->post('bind_code', 'LoginController@bind_code');
      $api->post('apple_bind_code', 'LoginController@apple_bind_code');
      $api->get('logout', 'LoginController@logout'); // 退出
      $api->post('h5_sms_code', 'LoginController@h5_sms_code'); // 登录验证码

      $api->get('weixin', 'LoginController@weixin'); // 微信登录
      $api->get('callback', 'LoginController@callback'); // 微信回调

      // 系统基础数据路由
      $api->group(['prefix' => 'system'], function ($api) {
        $api->get('kernel', 'SystemController@kernel'); // 系统信息路由
      });

      // 文件上传路由（必须先进行身份认证，默认人不可以上传）
      $api->group(['prefix' => 'file'], function ($api) {
        $api->post('avatar', 'FileController@avatar'); // 上传头像
        $api->post('picture', 'FileController@picture')->middleware(['auth:api', 'refresh.token', 'failure']); // 上传图片
        $api->post('file', 'FileController@file')->middleware(['auth:api', 'refresh.token', 'failure']); // 上传文件
        $api->post('audio', 'FileController@audio')->middleware(['auth:api', 'refresh.token', 'failure']); // 上传音频
        $api->post('movie', 'FileController@movie')->middleware(['auth:api', 'refresh.token', 'failure']); // 上传视频
      });
    });



    $api->group(['namespace' => 'Module'], function ($api) {

      // 公共路由
      $api->group(['namespace' => 'Common', 'prefix' => 'common'], function ($api) {

        // 省市县路由
        $api->group(['prefix' => 'area'], function ($api) {
          $api->get('list', 'AreaController@list');
        });

        // 成为老师目标路由
        $api->group(['prefix' => 'target'], function ($api) {
          $api->get('data', 'TargetController@data');
        });

        // 系统协议路由
        $api->group(['prefix' => 'agreement'], function ($api) {
          $api->get('user', 'AgreementController@user');
          $api->get('about', 'AgreementController@about');
        });

        // 微信支付回调路由
        $api->group(['prefix' => 'wechat'], function ($api) {
          $api->any('notify', 'WechatController@notify');
        });

        // 支付宝支付回调路由
        $api->group(['prefix' => 'alipay'], function ($api) {
          $api->any('notify', 'AlipayController@notify');
        });

        // 苹果支付回调路由
        $api->group(['prefix' => 'apple'], function ($api) {
          $api->any('notify', 'AppleController@notify');
        });

        // 棒棒糖路由
        $api->group(['prefix' => 'lollipop'], function ($api) {
          $api->get('data', 'LollipopController@data');
        });

        // 老师分红路由
        $api->group(['prefix' => 'bonus'], function ($api) {
          $api->post('data', 'BonusController@data');
        });

        // 红包路由
        $api->group(['prefix' => 'redenvelope'], function ($api) {
          $api->post('data', 'RedEnvelopeController@data');
        });

        // 分享路由
        $api->group(['prefix' => 'share'], function ($api) {
          $api->post('data', 'ShareController@data');
        });

        // 分享二维码路由
        $api->group(['prefix' => 'qrcode', 'middleware' => ['auth:api', 'refresh.token', 'failure']], function ($api) {
          $api->post('share', 'QrcodeController@share');
        });

        // 快递路由
        $api->group(['prefix' => 'express'], function ($api) {
          $api->post('data', 'ExpressController@data');
        });

        // 快递路由
        $api->group(['prefix' => 'service'], function ($api) {
          $api->post('data', 'ServiceController@data');
        });

        // 会员棒棒糖路由
        $api->group(['prefix'  => 'problem'], function ($api) {
          $api->get('list', 'ProblemController@list');
          $api->get('select', 'ProblemController@select');
          $api->get('view/{id}', 'ProblemController@view');

          // 常见问题分类路由
          $api->group(['namespace' => 'Problem', 'prefix'  => 'category'], function ($api) {
            $api->get('select', 'CategoryController@select');
          });
        });


        // 支付类型路由
        $api->group(['prefix' => 'pay'], function ($api) {
          $api->post('data', 'PayController@data');
        });
      });



      // 会员路由
      $api->group(['namespace' => 'Member', 'prefix'  => 'member', 'middleware' => ['auth:api', 'refresh.token', 'failure']], function ($api) {
        $api->get('archive', 'MemberController@archive');
        $api->get('view/{id}', 'MemberController@view');
        $api->post('handle', 'MemberController@handle');
        $api->post('teacher', 'MemberController@teacher');
        $api->get('status', 'MemberController@status');

        // 会员角色路由
        $api->group(['prefix'  => 'role'], function ($api) {
          $api->get('info', 'RoleController@info');
        });




        // 会员投诉路由
        $api->group(['prefix'  => 'complain'], function ($api) {
          $api->get('list', 'ComplainController@list');
          $api->get('select', 'ComplainController@select');
          $api->get('view/{id}', 'ComplainController@view');
          $api->post('handle', 'ComplainController@handle');
        });








        // 会员关联内容路由
        $api->group(['namespace' => 'Relevance'], function ($api) {

          // 会员资产路由
          $api->group(['prefix'  => 'asset'], function ($api) {
            $api->get('center', 'AssetController@center');
            $api->get('lollipop', 'AssetController@lollipop');
            $api->get('money', 'AssetController@money');
            $api->get('production', 'AssetController@production');
          });

          // 会员棒棒糖路由
          $api->group(['prefix'  => 'lollipop'], function ($api) {
            $api->get('list', 'LollipopController@list');
            $api->get('select', 'LollipopController@select');
            $api->post('status', 'LollipopController@status');
            $api->post('receive', 'LollipopController@receive');
          });

          // 会员红包路由
          $api->group(['prefix'  => 'money'], function ($api) {
            $api->get('list', 'MoneyController@list');
            $api->get('select', 'MoneyController@select');
            $api->post('handle', 'MoneyController@handle');
          });

          // 会员作品路由
          $api->group(['prefix'  => 'production'], function ($api) {
            $api->get('list', 'ProductionController@list');
            $api->get('select', 'ProductionController@select');
            $api->get('view/{id}', 'ProductionController@view');
            $api->post('handle', 'ProductionController@handle');
            $api->post('share', 'ProductionController@share');
            $api->post('status', 'ProductionController@status');
          });

          // 会员送货地址路由
          $api->group(['prefix'  => 'address'], function ($api) {
            $api->get('list', 'AddressController@list');
            $api->get('select', 'AddressController@select');
            $api->get('view/{id}', 'AddressController@view');
            $api->get('default', 'AddressController@default');
            $api->post('handle', 'AddressController@handle');
            $api->post('delete', 'AddressController@delete');
          });

          // 会员点赞路由
          $api->group(['prefix'  => 'approval'], function ($api) {
            $api->get('list', 'ApprovalController@list');
            $api->get('select', 'ApprovalController@select');
            $api->post('status', 'ApprovalController@status');
            $api->post('handle', 'ApprovalController@handle');
          });

          // 会员课程路由
          $api->group(['prefix'  =>  'course'], function ($api) {
            $api->get('list', 'CourseController@list');
            $api->get('select', 'CourseController@select');
            $api->get('center', 'CourseController@center');
            $api->get('view/{id}', 'CourseController@view');
            $api->get('status/{id}', 'CourseController@status');
            $api->get('addition/{id}', 'CourseController@addition');
            $api->post('apply', 'CourseController@apply');
            $api->post('finish', 'CourseController@finish');

            // 会员课程单元路由
            $api->group(['namespace' => 'Relevance', 'prefix'  =>  'unit'], function ($api) {
              $api->get('list', 'UnitController@list');
              $api->get('select', 'UnitController@select');
              $api->get('view/{id}', 'UnitController@view');

              // 会员课程单元知识点路由
              $api->group(['namespace' => 'Relevance', 'prefix'  =>  'point'], function ($api) {
                $api->get('list', 'PointController@list');
                $api->get('select', 'PointController@select');
                $api->get('view/{id}', 'PointController@view');
                $api->get('status/{id}', 'PointController@status');
                $api->post('finish', 'PointController@finish');
              });
            });
          });

          // 会员任务指标路由
          $api->group(['prefix'  =>  'target'], function ($api) {
            $api->get('progress', 'TargetController@progress');
          });

          // 会员评论路由
          $api->group(['prefix'  => 'comment'], function ($api) {
            $api->get('list', 'CommentController@list');
            $api->get('select', 'CommentController@select');
            $api->post('handle', 'CommentController@handle');
          });

          // 会员关注路由
          $api->group(['prefix'  => 'attention'], function ($api) {
            $api->get('list', 'AttentionController@list');
            $api->get('select', 'AttentionController@select');
            $api->post('status', 'AttentionController@status');
            $api->post('handle', 'AttentionController@handle');
          });

          // 会员邀请路由
          $api->group(['prefix'  => 'invitation'], function ($api) {
            $api->get('list', 'InvitationController@list');
            $api->get('select', 'InvitationController@select');
            $api->post('status', 'InvitationController@status');
            $api->post('handle', 'InvitationController@handle');
          });

          // 会员订单路由
          $api->group(['namespace' => 'Order', 'prefix'  => 'order'], function ($api) {

            // 会员课程订单路由
            $api->group(['prefix'  => 'course'], function ($api) {
              $api->get('list', 'CourseController@list');
              $api->get('select', 'CourseController@select');
              $api->get('view/{id}', 'CourseController@view');
              $api->post('handle', 'CourseController@handle');
              $api->post('change', 'CourseController@change');
              $api->post('pay', 'CourseController@pay');
              $api->post('finish', 'CourseController@finish');
              $api->post('cancel', 'CourseController@cancel');

              // 会员课程订单物流路由
              $api->group(['namespace'  => 'Course', 'prefix' => 'logistics'], function ($api) {
                $api->get('list', 'LogisticsController@list');
                $api->get('select', 'LogisticsController@select');
                $api->get('view/{id}', 'LogisticsController@view');
              });
            });

            // 会员商品订单路由
            $api->group(['prefix'  => 'goods'], function ($api) {
              $api->get('list', 'GoodsController@list');
              $api->get('select', 'GoodsController@select');
              $api->get('view/{id}', 'GoodsController@view');
              $api->post('handle', 'GoodsController@handle');
              $api->post('change', 'GoodsController@change');
              $api->post('pay', 'GoodsController@pay');
              $api->post('finish', 'GoodsController@finish');
              $api->post('cancel', 'GoodsController@cancel');

              // 会员商品订单物流路由
              $api->group(['namespace'  => 'Goods', 'prefix' => 'logistics'], function ($api) {
                $api->get('list', 'LogisticsController@list');
                $api->get('select', 'LogisticsController@select');
                $api->get('view/{id}', 'LogisticsController@view');
              });
            });
          });
        });
      });



      // 老师路由
      $api->group(['namespace' => 'Teacher', 'prefix'  => 'teacher', 'middleware' => ['auth:api', 'refresh.token', 'failure']], function ($api) {

        // 管理老师路由
        $api->group(['namespace' => 'Management', 'prefix'  => 'management'], function ($api) {
          $api->get('archive', 'TeacherController@archive');
          $api->post('handle', 'TeacherController@handle');

          $api->group(['namespace' => 'Relevance'], function ($api) {
            // 管理老师课程路由
            $api->group(['prefix'  =>  'course'], function ($api) {
              $api->get('list', 'CourseController@list');
              $api->get('select', 'CourseController@select');
              $api->get('view/{id}', 'CourseController@view');
              $api->post('confirm', 'CourseController@confirm');
            });

            // 管理老师学员路由
            $api->group(['prefix'  =>  'member'], function ($api) {
              $api->get('list', 'MemberController@list');
              $api->get('view/{id}', 'MemberController@view');
              $api->get('production', 'MemberController@production');
            });

            // 管理老师班级路由
            $api->group(['prefix'  =>  'squad'], function ($api) {
              $api->get('list', 'SquadController@list');
              $api->get('student', 'SquadController@student');
            });
          });
        });

        // 招聘老师路由
        $api->group(['namespace' => 'Recruitment', 'prefix'  => 'recruitment'], function ($api) {
          $api->get('archive', 'TeacherController@archive');
          $api->get('status', 'TeacherController@status');
          $api->post('handle', 'TeacherController@handle');
          $api->post('confirm', 'TeacherController@confirm');


          // 招聘老师分红路由
          $api->group(['namespace' => 'Relevance', 'prefix'  =>  'money'], function ($api) {
            $api->get('center', 'MoneyController@center');

            // 招聘老师分红详情路由
            $api->group(['namespace' => 'Relevance'], function ($api) {
              // 获取
              $api->group(['prefix'  =>  'obtain'], function ($api) {
                $api->get('list', 'ObtainController@list');
              });

              // 提取
              $api->group(['prefix'  =>  'extract'], function ($api) {
                $api->get('list', 'ExtractController@list');
              });
            });
          });
        });
      });


      // 广告路由
      $api->group(['prefix' => 'advertising'], function ($api) {
        $api->get('select', 'AdvertisingController@select');

        $api->group(['namespace' => 'Advertising', 'prefix' => 'position'], function ($api) {
          $api->get('list', 'PositionController@list');
          $api->get('select', 'PositionController@select');
          $api->get('view/{id}', 'PositionController@view');
        });
      });


      // 教育中心路由
      $api->group(['namespace' => 'Education', 'prefix' => 'education'], function ($api) {

        // 课件路由
        $api->group(['namespace' => 'Courseware', 'prefix' => 'courseware'], function ($api) {
          $api->any('list', 'CoursewareController@list');
          $api->get('select', 'CoursewareController@select');
          $api->get('view/{id}', 'CoursewareController@view');
          $api->get('index', 'CoursewareController@index');

          // 课件级别
          $api->group(['namespace' => 'Relevance', 'prefix' => 'level'], function ($api) {
            $api->any('list', 'LevelController@list');
            $api->get('select', 'LevelController@select');
            $api->get('view/{id}', 'LevelController@view');

            // 课件单元
            $api->group(['namespace' => 'Relevance', 'prefix' => 'unit'], function ($api) {
              $api->any('list', 'UnitController@list');
              $api->get('select', 'UnitController@select');
              $api->get('unlock', 'UnitController@unlock');
              $api->get('view/{id}', 'UnitController@view');

              // 课件知识点
              $api->group(['namespace' => 'Relevance', 'prefix' => 'point'], function ($api) {
                $api->any('list', 'PointController@list');
                $api->get('select', 'PointController@select');
                $api->get('view/{id}', 'PointController@view');
              });
            });
          });
        });


        // 课程路由
        $api->group(['namespace' => 'Course', 'prefix' => 'course'], function ($api) {
          $api->any('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('view/{id}', 'CourseController@view');

          $api->group(['namespace' => 'Relevance'], function ($api) {

            // 课程老师路由
            $api->group(['prefix' => 'teacher'], function ($api) {
              $api->any('list', 'TeacherController@list');
              $api->get('select', 'TeacherController@select');
              $api->get('view/{id}', 'TeacherController@view');
            });

            // 课程礼包路由
            $api->group(['prefix' => 'present'], function ($api) {
              $api->any('list', 'PresentController@list');
              $api->get('select', 'PresentController@select');
              $api->get('view/{id}', 'PresentController@view');
            });

            // 课程解锁路由
            $api->group(['prefix' => 'unlock'], function ($api) {
              $api->any('list', 'UnlockController@list');
              $api->get('select', 'UnlockController@select');
              $api->get('view/{id}', 'UnlockController@view');
            });

            // 课程分享路由
            $api->group(['prefix' => 'share'], function ($api) {
              $api->get('data', 'ShareController@data');
            });
          });
        });
      });



      // 作品路由
      $api->group(['namespace' => 'Production', 'prefix' => 'production'], function ($api) {
        $api->get('list', 'ProductionController@list');
        $api->get('select', 'ProductionController@select');
        $api->get('view/{id}', 'ProductionController@view');

        $api->group(['namespace' => 'Relevance'], function ($api) {
          // 作品评论路由
          $api->group(['prefix' => 'comment'], function ($api) {
            $api->get('list', 'CommentController@list');
            $api->get('select', 'CommentController@select');
            $api->get('view/{id}', 'CommentController@view');
          });

          // 作品点赞路由
          $api->group(['prefix' => 'approval'], function ($api) {
            $api->get('list', 'ApprovalController@list');
            $api->get('select', 'ApprovalController@select');
            $api->get('view/{id}', 'ApprovalController@view');
          });
        });
      });


      // 模板路由
      $api->group(['namespace' => 'Template', 'prefix' => 'template'], function ($api) {
        $api->get('list', 'TemplateController@list');
        $api->get('select', 'TemplateController@select');
        $api->get('view/{id}', 'TemplateController@view');
      });


      // 商品路由
      $api->group(['namespace' => 'Goods', 'prefix' => 'goods'], function ($api) {
        $api->get('list', 'GoodsController@list');
        $api->get('select', 'GoodsController@select');
        $api->get('view/{id}', 'GoodsController@view');
      });

      // 投诉路由
      $api->group(['namespace' => 'Complain', 'prefix' => 'complain'], function ($api) {
        $api->group(['prefix' => 'category'], function ($api) {
          // 投诉分类路由
          $api->get('select', 'CategoryController@select');
        });
      });
    });
  });
});
