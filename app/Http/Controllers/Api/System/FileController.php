<?php
namespace App\Http\Controllers\Api\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Models\Api\System\File;
use App\Models\Api\System\Config;
use App\Http\Controllers\Api\BaseController;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-10-21
 *
 * 文件上传接口控制器类
 */
class FileController extends BaseController
{
  /**
   * @api {post} /api/file/avatar 01. 上传头像(base64)
   * @apiDescription 把头像图片转换为base64进行上传
   * @apiGroup 03. 上传模块
   *
   * @apiParam {string} file 头像数据
   *
   * @apiSampleRequest /api/file/avatar
   * @apiVersion 1.0.0
   */
  public function avatar(Request $request)
  {
    try
    {
      $response = File::file_base64($request->file, 'avatar');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
  }


  /**
   * @api {post} /api/file/picture 02. 上传图片(base64)
   * @apiDescription 把图片转换为base64进行上传
   * @apiGroup 03. 上传模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} file 图片数据
   *
   * @apiSampleRequest /api/file/picture
   * @apiVersion 1.0.0
   */
  public function picture(Request $request)
  {
    try
    {
      $response = File::file_base64($request->file, 'picture');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
  }


  /**
   * @api {post} /api/file/file 03. 上传文件(base64)
   * @apiDescription 把文件转换为base64进行上传
   * @apiGroup 03. 上传模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} file 文件数据
   *
   * @apiSampleRequest /api/file/file
   * @apiVersion 1.0.0
   */
  public function file(Request $request)
  {
    try
    {
      $response = File::file_base64($request->file, 'file');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
  }


  /**
   * @api {post} /api/file/audio 04. 上传音频(base64)
   * @apiDescription 把音频转换为base64进行上传
   * @apiGroup 03. 上传模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} file 音频数据
   *
   * @apiSampleRequest /api/file/audio
   * @apiVersion 1.0.0
   */
  public function audio(Request $request)
  {
    try
    {
      $response = File::file_base64($request->file, 'audio');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
  }


  /**
   * @api {post} /api/file/movie 05. 上传视频(base64)
   * @apiDescription 把视频转换为base64进行上传
   * @apiGroup 03. 上传模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {string} file 视频数据
   *
   * @apiSampleRequest /api/file/movie
   * @apiVersion 1.0.0
   */
  public function movie(Request $request)
  {
    try
    {
      $response = File::file_base64($request->file, 'movie');

      if($response)
      {
        return self::success($response);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
  }
}
