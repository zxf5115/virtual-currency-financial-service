<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
  'namespace'  =>  'Platform',
  'middleware'  =>  'serializer:array'
], function ($api)
{
  $api->group([
    'middleware'  =>  'api.throttle', // 启用节流限制
    'limit'  =>  1000, // 允许次数
    'expires'  =>  1, // 分钟
  ], function ($api)
  {
    // --------------------------------------------------
    // 核心路由
    $api->group(['namespace' => 'System'], function ($api) {

      // 登录路由
      $api->post('login', 'LoginController@login');
      $api->post('register', 'LoginController@register');
      $api->get('logout', 'LoginController@logout');
      $api->get('check_user_login', 'LoginController@check_user_login'); // 验证是否登录

      $api->post('kernel', 'SystemController@kernel');
      $api->post('clear', 'SystemController@clear');

      // 首页路由
      $api->group(['prefix' => 'index'], function ($api) {
        $api->get('data', 'IndexController@data');
      });

      // 文件上传路由
      $api->group(['prefix' => 'file'], function ($api) {
        $api->post('avatar', 'FileController@avatar');
        $api->post('picture', 'FileController@picture');
        $api->post('file', 'FileController@file');
        $api->post('data', 'FileController@data');
        $api->post('advertising', 'FileController@advertising');
        $api->post('course', 'FileController@course');
        $api->post('batchRichText', 'FileController@batchRichText');
      });


      // 平台用户路由
      $api->group(['prefix'  =>  'user'], function ($api) {
        $api->any('list', 'UserController@list');
        $api->get('select', 'UserController@select');
        $api->get('view/{id}', 'UserController@view');
        $api->get('action', 'UserController@action');
        $api->post('handle', 'UserController@handle');
        $api->post('delete', 'UserController@delete');
        $api->get('tree', 'UserController@tree');
        $api->any('password', 'UserController@password');
        $api->any('change_password', 'UserController@change_password');

        // 平台用户消息路由
        $api->group(['namespace' => 'User', 'prefix'  =>  'message'], function ($api) {
          $api->any('list', 'MessageController@list');
          $api->post('unread', 'MessageController@unread');
          $api->post('readed', 'MessageController@readed');
          $api->post('delete', 'MessageController@delete');
        });
      });


      // 平台角色路由
      $api->group(['prefix'  =>  'role'], function ($api) {
        $api->any('list', 'RoleController@list');
        $api->get('select', 'RoleController@select');
        $api->get('view/{id}', 'RoleController@view');
        $api->post('handle', 'RoleController@handle');
        $api->post('delete', 'RoleController@delete');
        $api->any('permission/{id}', 'RoleController@permission');
      });


      // 平台菜单路由
      $api->group(['prefix'  =>  'menu'], function ($api) {
        $api->any('list', 'MenuController@list');
        $api->get('select', 'MenuController@select');
        $api->get('view/{id}', 'MenuController@view');
        $api->post('handle', 'MenuController@handle');
        $api->post('delete', 'MenuController@delete');

        $api->any('level', 'MenuController@level');
        $api->post('active', 'MenuController@active');
        $api->post('track', 'MenuController@track');
      });


       // 系统配置路由
      $api->group(['prefix'  =>  'config'], function ($api) {
        // 配置管理路由
        $api->any('list', 'ConfigController@list');
        $api->get('select', 'ConfigController@select');
        $api->get('view/{id}', 'ConfigController@view');
        $api->post('handle', 'ConfigController@handle');
        $api->post('delete/{id?}', 'ConfigController@delete');

        // 配置分类管理路由
        $api->group(['namespace' => 'Config', 'prefix'  =>  'category'], function ($api) {
          $api->any('list', 'CategoryController@list');
          $api->get('select', 'CategoryController@select');
          $api->get('view/{id}', 'CategoryController@view');
          $api->get('level', 'CategoryController@level');
          $api->post('handle', 'CategoryController@handle');
          $api->post('delete/{id?}', 'CategoryController@delete');
        });
      });


      // 系统设置路由
      $api->group(['prefix'  =>  'setting'], function ($api) {
        $api->any('data', 'SettingController@data');
        $api->any('agreement', 'SettingController@agreement');
        $api->any('about', 'SettingController@about');
      });


      // 系统消息路由
      $api->group(['prefix'  =>  'message'], function ($api) {
        $api->any('list', 'MessageController@list');
        $api->get('view/{id}', 'MessageController@view');
        $api->post('handle', 'MessageController@handle');
        $api->get('type', 'MessageController@type');
        $api->post('readed', 'MessageController@readed');
        $api->post('delete', 'MessageController@delete');
      });

      // 系统日志路由
      $api->group(['namespace' => 'Log', 'prefix'  =>  'log'], function ($api) {
        $api->group(['prefix'  =>  'action'], function ($api) {
          $api->any('list', 'ActionController@list');
          $api->get('view/{id}', 'ActionController@view');
          $api->post('delete', 'ActionController@delete');
        });
      });
    });


    // --------------------------------------------------
    // 模块路由
    $api->group(['namespace' => 'Module'], function ($api) {

      // 公共路由
      $api->group(['namespace' => 'Common', 'prefix'  =>  'common'], function ($api) {
        $api->get('education/degree', 'EducationController@degree'); // 教育程度路由
        $api->get('national/list', 'NationalController@list'); // 民族路由
        $api->get('area/list', 'AreaController@list'); // 民族路由

        // 快递路由
        $api->group(['namespace' => 'Express', 'prefix' => 'express'], function ($api) {
          $api->group(['prefix' => 'company'], function ($api) {
            $api->get('list', 'CompanyController@list'); // 快递公司路由
          });
        });

        // 常见问题路由
        $api->group(['prefix' => 'problem'], function ($api) {
          $api->any('list', 'ProblemController@list');
          $api->get('select', 'ProblemController@select');
          $api->get('view/{id}', 'ProblemController@view');
          $api->post('handle', 'ProblemController@handle');
          $api->post('delete', 'ProblemController@delete');
        });
      });

      // 机构路由
      $api->group(['namespace' => 'Organization', 'prefix' => 'organization'], function ($api) {
        $api->any('list', 'OrganizationController@list');
        $api->get('select', 'OrganizationController@select');
        $api->get('view/{id}', 'OrganizationController@view');
        $api->post('handle', 'OrganizationController@handle');
        $api->post('audit', 'OrganizationController@audit');
        $api->post('export', 'OrganizationController@export');
        $api->post('delete', 'OrganizationController@delete');

        // 班级路由
        $api->group(['namespace' => 'Squad', 'prefix' => 'squad'], function ($api) {
          $api->any('list', 'SquadController@list');
          $api->get('view/{id}', 'SquadController@view');
          $api->get('label/{id}', 'SquadController@label');
          $api->post('handle', 'SquadController@handle');
          $api->post('audit', 'SquadController@audit');
          $api->post('delete/{id?}', 'SquadController@delete');
        });
      });


      // 会员路由
      $api->group(['namespace' => 'Member', 'prefix'  =>  'member'], function ($api) {
        $api->any('list', 'MemberController@list');
        $api->get('select', 'MemberController@select');
        $api->get('view/{id}', 'MemberController@view');
        $api->post('handle', 'MemberController@handle');
        $api->post('freeze', 'MemberController@freeze');
        $api->post('enable', 'MemberController@enable');
        $api->post('delete', 'MemberController@delete');

        $api->group(['namespace'  =>  'Relevance'], function ($api) {

          // 会员课程路由
          $api->group(['prefix'  =>  'course'], function ($api) {
            $api->get('list', 'CourseController@list');
          });

          // 会员订单路由
          $api->group(['namespace'  =>  'Order', 'prefix'  =>  'order'], function ($api) {

            // 会员课程订单路由
            $api->group(['prefix'  =>  'course'], function ($api) {
              $api->get('select', 'CourseController@select');
            });
          });
        });

        // 会员角色路由
        $api->group(['prefix'  =>  'role'], function ($api) {
          $api->any('list', 'RoleController@list');
          $api->get('select', 'RoleController@select');
          $api->get('view/{id}', 'RoleController@view');
          $api->post('handle', 'RoleController@handle');
          $api->post('delete', 'RoleController@delete');
          $api->any('permission/{id}', 'RoleController@permission');
        });
      });


      // 老师路由
      $api->group(['namespace' => 'Teacher', 'prefix'  =>  'teacher'], function ($api) {

        // 管理老师路由
        $api->group(['namespace' => 'Management', 'prefix'  =>  'management'], function ($api) {
          $api->any('list', 'TeacherController@list');
          $api->get('select', 'TeacherController@select');
          $api->get('view/{id}', 'TeacherController@view');
          $api->post('handle', 'TeacherController@handle');
          $api->post('enable', 'TeacherController@enable');
          $api->post('delete', 'TeacherController@delete');
        });

        // 招聘老师路由
        $api->group(['namespace' => 'Recruitment', 'prefix'  =>  'recruitment'], function ($api) {
          $api->any('list', 'TeacherController@list');
          $api->get('select', 'TeacherController@select');
          $api->get('view/{id}', 'TeacherController@view');
          $api->post('handle', 'TeacherController@handle');
          $api->post('enable', 'TeacherController@enable');
          $api->post('delete', 'TeacherController@delete');

          $api->group(['namespace'  =>  'Relevance'], function ($api) {
            // 招聘老师分红路由
            $api->group(['prefix'  =>  'money'], function ($api) {
              $api->get('view/{id}', 'MoneyController@view');
              $api->post('handle', 'MoneyController@handle');

              // 招聘老师分红详情路由
              $api->group(['namespace' => 'Relevance', 'prefix' => 'obtain'], function ($api) {
                $api->any('list', 'ObtainController@list');
              });

              // 招聘老师分红详情路由
              $api->group(['namespace'  =>  'Relevance', 'prefix'  =>  'extract'], function ($api) {
                $api->any('list', 'ExtractController@list');
                $api->get('select', 'ExtractController@select');
                $api->get('view/{id}', 'ExtractController@view');
                $api->post('handle', 'ExtractController@handle');
                $api->post('delete', 'ExtractController@delete');
              });
            });
          });
        });
      });


      // 作品路由
      $api->group(['namespace' => 'Production', 'prefix' => 'production'], function ($api) {
        $api->any('list', 'ProductionController@list');
        $api->get('select', 'ProductionController@select');
        $api->get('view/{id}', 'ProductionController@view');
        $api->post('delete', 'ProductionController@delete');

        $api->group(['namespace' => 'Relevance'], function ($api) {

          // 作品评论路由
          $api->group(['prefix' => 'comment'], function ($api) {
            $api->any('list', 'CommentController@list');
          });
        });
      });


      // 模板路由
      $api->group(['namespace' => 'Template', 'prefix' => 'template'], function ($api) {
        $api->any('list', 'TemplateController@list');
        $api->get('select', 'TemplateController@select');
        $api->get('view/{id}', 'TemplateController@view');
        $api->post('handle', 'TemplateController@handle');
        $api->post('delete', 'TemplateController@delete');
      });


      // 广告路由
      $api->group(['namespace' => 'Advertising', 'prefix' => 'advertising'], function ($api) {
        // 广告路由
        $api->any('list', 'AdvertisingController@list');
        $api->get('select', 'AdvertisingController@select');
        $api->get('view/{id}', 'AdvertisingController@view');
        $api->post('handle', 'AdvertisingController@handle');
        $api->post('delete', 'AdvertisingController@delete');

        // 广告位路由
        $api->group(['namespace' => 'Relevance', 'prefix' => 'position'], function ($api) {
          $api->any('list', 'PositionController@list');
          $api->get('select', 'PositionController@select');
          $api->get('view/{id}', 'PositionController@view');
          $api->post('handle', 'PositionController@handle');
          $api->post('delete/{id?}', 'PositionController@delete');
        });
      });


      // 投诉路由
      $api->group(['namespace' => 'Complain', 'prefix' => 'complain'], function ($api) {
        // 投诉路由
        $api->any('list', 'ComplainController@list');
        $api->post('read', 'ComplainController@read');
        $api->post('delete', 'ComplainController@delete');

        // 投诉分类路由
        $api->group(['namespace' => 'Relevance', 'prefix' => 'category'], function ($api) {
          $api->any('list', 'CategoryController@list');
          $api->get('select', 'CategoryController@select');
          $api->post('status', 'CategoryController@status');
          $api->post('handle', 'CategoryController@handle');
          $api->post('delete/{id?}', 'CategoryController@delete');
        });
      });


      // 教育中心路由
      $api->group(['namespace' => 'Education', 'prefix' => 'education'], function ($api) {

        // 课件路由
        $api->group(['namespace' => 'Courseware', 'prefix' => 'courseware'], function ($api) {
          $api->any('list', 'CoursewareController@list');
          $api->get('select', 'CoursewareController@select');
          $api->get('view/{id}', 'CoursewareController@view');
          $api->post('handle', 'CoursewareController@handle');
          $api->post('status', 'CoursewareController@status');
          $api->post('delete/{id?}', 'CoursewareController@delete');

          $api->group(['namespace' => 'Relevance'], function ($api) {
            // 课件级别路由
            $api->group(['prefix'  => 'level'], function ($api) {
              $api->any('list', 'LevelController@list');
              $api->get('select', 'LevelController@select');
              $api->get('view/{id}', 'LevelController@view');
              $api->post('handle', 'LevelController@handle');
              $api->post('status', 'LevelController@status');
              $api->post('delete/{id?}', 'LevelController@delete');

              $api->group(['namespace' => 'Relevance'], function ($api) {
                // 课件单元路由
                $api->group(['prefix'  => 'unit'], function ($api) {
                  $api->any('list', 'UnitController@list');
                  $api->get('select', 'UnitController@select');
                  $api->get('view/{id}', 'UnitController@view');
                  $api->post('handle', 'UnitController@handle');
                  $api->post('delete/{id?}', 'UnitController@delete');

                  $api->group(['namespace' => 'Relevance'], function ($api) {
                    // 课件知识点路由
                    $api->group(['prefix'  => 'point'], function ($api) {
                      $api->any('list', 'PointController@list');
                      $api->get('select', 'PointController@select');
                      $api->get('view/{id}', 'PointController@view');
                      $api->post('handle', 'PointController@handle');
                      $api->post('delete/{id?}', 'PointController@delete');
                    });
                  });
                });
              });
            });
          });
        });



        // 课程路由
        $api->group(['namespace' => 'Course', 'prefix' => 'course'], function ($api) {
          $api->any('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('view/{id}', 'CourseController@view');
          $api->post('handle', 'CourseController@handle');
          $api->post('delete/{id?}', 'CourseController@delete');

          $api->group(['namespace' => 'Relevance'], function ($api) {
            // 课程礼包路由
            $api->group(['prefix'  => 'present'], function ($api) {
              $api->any('list', 'PresentController@list');
              $api->get('select', 'PresentController@select');
              $api->get('view/{id}', 'PresentController@view');
              $api->post('handle', 'PresentController@handle');
              $api->post('delete/{id?}', 'PresentController@delete');
            });
            // 课程礼包路由
            $api->group(['prefix'  => 'unlock'], function ($api) {
              $api->any('list', 'UnlockController@list');
              $api->get('select', 'UnlockController@select');
              $api->get('view/{id}', 'UnlockController@view');
              $api->post('handle', 'UnlockController@handle');
              $api->post('delete/{id?}', 'UnlockController@delete');
            });
            // 课程老师路由
            $api->group(['prefix'  => 'teacher'], function ($api) {
              $api->any('list', 'TeacherController@list');
              $api->get('select', 'TeacherController@select');
              $api->get('view/{id}', 'TeacherController@view');
              $api->post('handle', 'TeacherController@handle');
              $api->post('delete/{id?}', 'TeacherController@delete');
            });


            // 课程分享路由
            $api->group(['prefix'  => 'share'], function ($api) {
              $api->any('list', 'ShareController@list');
              $api->get('select', 'ShareController@select');
              $api->get('view/{id}', 'ShareController@view');
              $api->post('handle', 'ShareController@handle');
              $api->post('delete/{id?}', 'ShareController@delete');
            });
          });
        });
      });


      // 订单路由
      $api->group(['namespace' => 'Order', 'prefix' => 'order'], function ($api) {

        // 课程订单路由
        $api->group(['prefix' => 'course'], function ($api) {
          $api->any('list', 'CourseController@list');
          $api->get('select', 'CourseController@select');
          $api->get('view/{id}', 'CourseController@view');
          $api->post('send', 'CourseController@send');
          $api->get('money', 'CourseController@money');

          $api->group(['namespace' => 'Course'], function ($api) {

            // 课程订单物流路由
            $api->group(['prefix'  => 'logistics'], function ($api) {
              $api->any('list', 'LogisticsController@list');
              $api->get('select', 'LogisticsController@select');
              $api->get('view/{id}', 'LogisticsController@view');
              $api->post('handle', 'LogisticsController@handle');
            });
          });
        });

        // 商品订单路由
        $api->group(['prefix' => 'goods'], function ($api) {
          $api->any('list', 'GoodsController@list');
          $api->get('select', 'GoodsController@select');
          $api->get('view/{id}', 'GoodsController@view');
          $api->post('send', 'GoodsController@send');
          $api->get('money', 'GoodsController@money');

          $api->group(['namespace' => 'Goods'], function ($api) {

            // 商品订单物流路由
            $api->group(['prefix'  => 'logistics'], function ($api) {
              $api->any('list', 'LogisticsController@list');
              $api->get('select', 'LogisticsController@select');
              $api->get('view/{id}', 'LogisticsController@view');
              $api->post('handle', 'LogisticsController@handle');
            });
          });
        });
      });


      // 商品路由
      $api->group(['namespace' => 'Goods', 'prefix' => 'goods'], function ($api) {
        $api->any('list', 'GoodsController@list');
        $api->get('select', 'GoodsController@select');
        $api->get('view/{id}', 'GoodsController@view');
        $api->post('handle', 'GoodsController@handle');
        $api->post('status', 'GoodsController@status');
        $api->post('delete/{id?}', 'GoodsController@delete');
      });


      // 商品路由
      $api->group(['namespace' => 'Financial', 'prefix' => 'financial'], function ($api) {

        $api->group(['prefix' => 'report'], function ($api) {
          $api->get('data', 'ReportController@data');
          $api->get('proportion', 'ReportController@proportion');
          $api->get('trend', 'ReportController@trend');
        });

        $api->group(['prefix' => 'withdrawal'], function ($api) {

          $api->any('list', 'WithdrawalController@list');
          $api->post('handle', 'WithdrawalController@handle');
        });
      });
    });
  });
});
