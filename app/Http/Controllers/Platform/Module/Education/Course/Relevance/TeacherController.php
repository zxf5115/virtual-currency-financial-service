<?php
namespace App\Http\Controllers\Platform\Module\Education\Course\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;
use App\Models\Common\Module\Education\Course\Relevance\Question;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-01-14
 *
 * 课程老师控制器类
 */
class TeacherController extends BaseController
{
  protected $_model = 'App\Models\Platform\Module\Education\Course\Relevance\Teacher';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'course_id',
    'courseware_id',
    'level_id',
  ];

  // 附加关联查询条件
  protected $_addition = [];

  protected $_order = [
    ['key' => 'sort', 'value' => 'desc'],
  ];

  // 关联数组
  protected $_relevance = [
    'list' => [
      'course',
      'courseware',
      'level',
      'teacher',
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
      'course_id.required'     => '请您输入课程编号',
      'courseware_id.required' => '请您输入课件编号',
      'level_id.required'      => '请您输入课件级别编号',
      'teacher_id.required'    => '请您输入招生老师编号',
    ];

    $rule = [
      'course_id'     => 'required',
      'courseware_id' => 'required',
      'level_id'      => 'required',
      'teacher_id'    => 'required',
    ];

    // 验证用户数据内容是否正确
    $validation = self::validation($request, $messages, $rule);

    if(!$validation['status'])
    {
      return $validation['message'];
    }
    else
    {
      try
      {
        $model = $this->_model::firstOrNew(['id' => $request->id]);

        if(empty($model->id) || (!empty($model->id) && $model->teacher_id != $request->teacher_id))
        {
          $where = [
            'course_id'     => $request->course_id,
            'courseware_id' => $request->courseware_id,
            'level_id'      => $request->level_id,
            'teacher_id'    => $request->teacher_id,
          ];

          $result = $this->_model::getRow($where);

          if(!empty($result->id))
          {
            return self::error(Code::CURRENT_TEACHER_EXIST);
          }
        }

        $model->organization_id = self::getOrganizationId();
        $model->course_id       = $request->course_id;
        $model->courseware_id   = $request->courseware_id;
        $model->level_id        = $request->level_id;
        $model->teacher_id      = $request->teacher_id;
        $model->sort            = $request->sort ?? 0;

        $response = $model->save();

        return self::success(Code::message(Code::HANDLE_SUCCESS));
      }
      catch(\Exception $e)
      {
        // 记录异常信息
        self::record($e);

        return self::error(Code::HANDLE_FAILURE);
      }
    }
  }
}
