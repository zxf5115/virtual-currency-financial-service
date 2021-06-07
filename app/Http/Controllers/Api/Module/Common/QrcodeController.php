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
 * 二维码控制器类
 */
class QrcodeController extends BaseController
{

  /**
   * @api {post} /api/common/qrcode/share 13. 分享二维码图片
   * @apiDescription 获取分享二维码图片
   * @apiGroup 02. 公共模块
   *
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} course_id 课程编号
   *
   * @apiSuccess (basic params) {String} data base64加密后的二维码
   *
   * @apiSampleRequest /api/common/qrcode/share
   * @apiVersion 1.0.0
   */
  public function share(Request $request)
  {
    try
    {
      $course_id = $request->course_id ?? 0;

      if(empty($course_id))
      {
        $course_id = Config::getConfigValue('share_course');
      }

      $filename = md5(time() . rand(1, 9999999)). '.png';

      $uri = storage_path('app/public/qrcode/' . $filename);

      $web_url = Config::getConfigValue('web_url');

      $url = $web_url . '/storage/qrcode/' . $filename;

      $params = 'http://h5.xcyys.cn/#/?course_id='. $course_id .'&user_id=' . $this->user->id;

      // 生成带有分享人信息的二维码
      $data = QrCode::format('png')->size(300)->encoding('UTF-8')->generate($params, $uri);

      return self::success($url);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
