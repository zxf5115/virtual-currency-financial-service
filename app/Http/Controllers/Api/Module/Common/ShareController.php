<?php
namespace App\Http\Controllers\Api\Module\Common;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Models\Common\System\Config;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Education\Course\Course;
use App\Models\Api\Module\Education\Courseware\Courseware;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-30
 *
 * 分享红包控制器类
 */
class ShareController extends BaseController
{
  protected $_model = 'App\Models\Api\System\Config';

  protected $_where = [
    'category_id' => 11
  ];

  protected $_params = [];

  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  protected $_relevance = [];


  /**
   * @api {post} /api/common/share/data 14. 分享配置
   * @apiDescription 获取学员分享配置
   * @apiGroup 02. 公共模块
   *
   * @apiParam {int} course_id 课程编号
   *
   * @apiSuccess (basic params) {Number} share_picture 分享图片
   * @apiSuccess (basic params) {String} share_rule 分享活动规则
   * @apiSuccess (basic params) {String} qrcode 二维码图片
   *
   * @apiSampleRequest /api/common/share/data
   * @apiVersion 1.0.0
   */
  public function data(Request $request)
  {
    try
    {
      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($this->_where, $filter);

      $response = $this->_model::getPluck(['value', 'title'], $condition);


      $filename = md5(time() . rand(1, 9999999)). '.png';

      $uri = storage_path('app/public/qrcode/' . $filename);

      $web_url = Config::getConfigValue('web_url');

      $url = $web_url . '/storage/qrcode/' . $filename;

      $course_id = $request->course_id ?? 0;
\Log::error('接口传过来：' . $course_id);
      if(empty($course_id))
      {
        $course_id = Config::getConfigValue('share_course');
      }
\Log::error('最终使用：' . $course_id);
      $params = 'http://h5.xcyys.cn/#/?course_id='. $course_id .'&user_id=' . $this->user->id;

      // 生成带有分享人信息的二维码
      QrCode::format('png')->size(300)->encoding('UTF-8')->generate($params, $uri);

      $response['qrcode'] = $url;

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
