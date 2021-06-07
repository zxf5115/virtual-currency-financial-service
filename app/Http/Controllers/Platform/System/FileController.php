<?php
namespace App\Http\Controllers\Platform\System;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Controllers\Platform\BaseController;

use App\Models\Platform\System\File;
use App\Models\Platform\System\Config;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-08
 *
 * 文件上传接口控制器类
 */
class FileController extends BaseController
{
  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-03
   * ------------------------------------------
   * 上传头像
   * ------------------------------------------
   *
   * 上传头像
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function avatar(Request $request)
  {
    try
    {
      $response = File::file('file', 'avatar');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传图片
   * ------------------------------------------
   *
   * 上传图片
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function picture(Request $request)
  {
    try
    {
      $response = File::file('file', 'picture');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传文件
   * ------------------------------------------
   *
   * 上传文件
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function file(Request $request)
  {
    try
    {
      $response = File::file('file', 'file');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传广告
   * ------------------------------------------
   *
   * 上传广告
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function advertising(Request $request)
  {
    try
    {
      $response = File::file('file', 'advertising');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传配置数据
   * ------------------------------------------
   *
   * 上传配置数据
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function data(Request $request)
  {
    try
    {
      $response = File::file('file', 'config');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $data = [
          'title' => $request->title,
          'url' => $response
        ];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $data]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }






  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传课程
   * ------------------------------------------
   *
   * 上传课程
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function course(Request $request)
  {
    // 秒为单位，自己根据需要定义
    // ini_set('max_execution_time', 600);
    // 设置不超时
    set_time_limit(0);

    try
    {
      $response = File::file('file', 'course');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 批量上传图片
   * ------------------------------------------
   *
   * 批量上传图片
   *
   * @param Request $request 请求参数
   * @return [type]
   */
  public function batchRichText(Request $request)
  {
    try
    {
      $response = File::batchRichTextFile('file', 'picture');

      if($response)
      {
        $headers = ['content-type' => 'application/json'];

        $response = \Response::json(['code' => 0, 'msg' => '', 'data' => $response]);

        return $response->withHeaders($headers);
      }

      return self::error(Code::FILE_UPLOAD_ERROR);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }
}
