<?php
namespace App\Http\Controllers\Platform\Module\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-11
 *
 * 作品控制器类
 */
class ProductionController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Production\Production';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'member_id',
    'course_id',
    'level_id',
  ];

  // 附加关联查询条件
  protected $_addition = [
    'member' => [
      'nickname',
    ],
    'archive' => [
      'age'
    ],
    'course' => [
      'title',
      'courseware_id'
    ]
  ];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联信息
  protected $_relevance = [
    'list' => [
      'course',
      'courseware',
      'level',
      'member',
      'archive'
    ],
    'view' => [
      'course',
      'courseware',
      'level',
      'member',
      'archive'
    ]
  ];
}
