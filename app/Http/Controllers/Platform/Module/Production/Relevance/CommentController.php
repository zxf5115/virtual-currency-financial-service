<?php
namespace App\Http\Controllers\Platform\Module\Production\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-12
 *
 * 作品评论控制器类
 */
class CommentController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Production\Relevance\Comment';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联信息
  protected $_relevance = [
    'list' => [
      'production',
      'member'
    ]
  ];

}
