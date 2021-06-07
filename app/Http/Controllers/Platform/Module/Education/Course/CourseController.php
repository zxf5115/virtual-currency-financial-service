<?php
namespace App\Http\Controllers\Platform\Module\Education\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Education\Course\Relevance\Question;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 课程控制器类
 */
class CourseController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Platform\Module\Education\Course\Course';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'title',
    'courseware_id',
    'course_start_time'
  ];

  // 附加关联查询条件
  protected $_addition = [];

  // 排序
  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联信息
  protected $_relevance = [
    'list' => [
      'courseware',
      'unlock',
    ],
    'view' => [
      'detail',
      'courseware',
      'unlock',
      'picture'
    ]
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-12
   * ------------------------------------------
   * 操作信息
   * ------------------------------------------
   *
   * 操作信息
   *
   * @param Request $request [请求参数]
   * @return [type]
   */
  public function handle(Request $request)
  {
    $messages = [
      'title.required'   => '请您输入课程标题',
    ];

    $rule = [
      'title' => 'required'
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      DB::beginTransaction();

      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        $model->organization_id   = self::getOrganizationId();
        $model->courseware_id     = $request->courseware_id;
        $model->unlock_id         = $request->unlock_id;
        $model->title             = $request->title;
        $model->semester          = $request->semester;
        $model->present           = $request->present ?? '';
        $model->description       = $request->description ?? '';
        $model->apply_start_time  = strtotime($request->apply_time[0]);
        $model->apply_end_time    = strtotime($request->apply_time[1]);
        $model->course_start_time = strtotime($request->course_start_time);
        $model->real_price        = $request->real_price;
        $model->line_price        = $request->line_price;
        $model->product_id        = $request->product_id;
        $model->class_size        = $request->class_size;
        $model->sort              = $request->sort ?? 0;

        $response = $model->save();

        $data = [
          'content' => $request->content,
          'plan'    => $request->plan
        ];

        if(!empty($data))
        {
          $model->detail()->delete();

          $model->detail()->create($data);
        }

        $picture = self::packRelevanceData($request, 'picture');

        if(!empty($picture))
        {
          $model->picture()->delete();

          $model->picture()->createMany($picture);
        }

        DB::commit();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        DB::rollback();

        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
