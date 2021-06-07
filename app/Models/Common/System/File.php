<?php
namespace App\Models\Common\System;

use Illuminate\Support\Facades\Storage;

use App\Models\Base;
use App\Http\Constant\Code;
use ObsV3\ObsClient;
use Goodgay\HuaweiOBS\HWobs;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-14
 *
 * 文件上传模型
 */
class File extends Base
{
  public $ossClient = null;

  public $req = null;

  public $data = [];

  /**
   * 允许类型
   */
  public $allow = ['jpeg','png','gif','jpg'];

  /**
   * 水印图片地址
   */
  public $water = '';

  /**
   * 保存目录
   */
  public $dir = '/shop/';

  /**
   * 图片宽度
   */
  public $width = 800;

  /**
   * 图片高度
   */
  public $height = 600;



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传图片
   * ------------------------------------------
   *
   * 上传图片
   *
   * @param string $name 文件名
   * @param string $path 路径
   * @param boolean $type 是否支持上传服务器，默认不上传
   * @param string $disk 用那种方式上传 oss, cos, qiniu, 又拍云
   * @param array $extension 允许上传的后缀
   * @return [type]
   */
  public static function image($name, $path = 'uploads', $disk = 'public', $extension = [])
  {
    $allowExtension = [
      'jpg',
      'jpeg',
      'png',
      'gif',
      'bmp'
    ];

    if($extension)
      $allowExtension = array_merge($allowExtension, $extension);

    return self::file($name, $path, $disk, $allowExtension);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传PDF
   * ------------------------------------------
   *
   * 上传PDF
   *
   * @param string $name 文件名
   * @param string $path 路径
   * @param boolean $type 是否支持上传服务器，默认不上传
   * @param string $disk 用那种方式上传 oss, cos, qiniu, 又拍云
   * @param array $extension 允许上传的后缀
   * @return [type]
   */
  public static function pdf($name, $path = 'uploads', $disk = 'public', $extension = [])
  {
    return self::file($name, $path, $disk);
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
   * @param string $name 文件名
   * @param string $path 路径
   * @param string $disk 用那种方式上传 oss, cos, qiniu, 又拍云
   * @param array $extension 允许上传的后缀
   * @return [type]
   */
  public static function file($name, $path = 'uploads', $disk = 'public')
  {
    try
    {
      if (!request()->hasFile($name))
      {
        return [
          'status' => Code::FILE_UPLOAD_EXIST,
          'message' => Code::$message[Code::FILE_UPLOAD_EXIST]
        ];
      }

      $file = request()->file($name);

      if(!$file->isValid())
      {
        return [
          'status' => Code::FILE_UPLOAD_FAILURE_RETRY,
          'message' => Code::$message[Code::FILE_UPLOAD_FAILURE_RETRY]
        ];
      }

      // 过滤所有的.符号
      $path = str_replace('.', '', $path);

      // 先去除两边空格
      $path = trim($path, '/');

      // 获取文件后缀
      $extension = strtolower($file->getClientOriginalExtension());

      $filename = time() . mt_rand(1, 9999999);

      // 组合新的文件名
      $filename = md5($filename) . '.' . $extension;

      $resource = fopen($file, 'r');

      if(Storage::disk('hwobs')->writeStream($filename, $resource))
      {
        $url = Storage::disk('hwobs')->url($filename);

        return strstr($url, '?', true);
      }
      else
      {
        return false;
      }
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 批量上传文件
   * ------------------------------------------
   *
   * 批量上传文件
   *
   * @param string $name 文件名
   * @param string $path 路径
   * @param string $disk 用那种方式上传 oss, cos, qiniu, 又拍云
   * @param array $extension 允许上传的后缀
   * @return [type]
   */
  public static function batchRichTextFile($name, $path = 'uploads', $disk = 'public')
  {
    try
    {
      $response = [
        'succMap' => [],
        'errFiles' => [],
      ];

      if (!request()->hasFile($name))
      {
        return [
          'status' => Code::FILE_UPLOAD_EXIST,
          'message' => Code::$message[Code::FILE_UPLOAD_EXIST]
        ];
      }

      $files = request()->file($name);

      foreach($files as $file)
      {
        if(!$file->isValid())
        {
          return [
            'status' => Code::FILE_UPLOAD_FAILURE_RETRY,
            'message' => Code::$message[Code::FILE_UPLOAD_FAILURE_RETRY]
          ];
        }

        // 过滤所有的.符号
        $path = str_replace('.', '', $path);

        // 先去除两边空格
        $path = trim($path, '/');

        // 获取文件后缀
        $extension = strtolower($file->getClientOriginalExtension());

        $filename = time() . mt_rand(1, 9999999);

        // 组合新的文件名
        $filename = md5($filename) . '.' . $extension;

        // 获取上传的文件名
        $oldName = $file->getClientOriginalName();

        $resource = fopen($file, 'r');

        if(Storage::disk('hwobs')->writeStream($filename, $resource))
        {
          $url = Storage::disk('hwobs')->url($filename);

          $response['succMap'][$oldName] = strstr($url, '?', true);
        }
        else
        {
          $response['errFiles'][$k] = false;
        }

        return $response;
      }
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }





  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-02-24
   * ------------------------------------------
   * 上传文件（base64）
   * ------------------------------------------
   *
   * 上传文件（base64）
   *
   * @param string $file 数据内容
   * @param string $path 路径
   * @param string $disk 用那种方式上传 oss, obs
   * @return [type]
   */
  public static function file_base64($file, $path = 'uploads', $disk = 'public')
  {
    try
    {
      // 判断当前资源是什么
      if(false !==strpos($file, 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
      {
        // 替换编码头
        preg_match('/^(data:application\/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,)/', $file, $data);
        $data[2] = 'docx';
      }
      else if(false !==strpos($file, 'application/msword'))
      {
        // 替换编码头
        preg_match('/^(data:application\/msword;base64,)/', $file, $data);
        $data[2] = 'doc';
      }
      else if(false !==strpos($file, 'application/vnd.ms-excel application/x-excel'))
      {
        // 替换编码头
        preg_match('/^(data:application\/vnd.ms-excel application\/x-excel;base64,)/', $file, $data);
        $data[2] = 'xls';
      }
      else if(false !==strpos($file, 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'))
      {
        // 替换编码头
        preg_match('/^(data:application\/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,)/', $file, $data);
        $data[2] = 'xlsx';
      }
      else if(false !==strpos($file, 'application/pdf'))
      {
        // 替换编码头
        preg_match('/^(data:application\/pdf;base64,)/', $file, $data);
        $data[2] = 'pdf';
      }
      else if(false !==strpos($file, 'application/octet-stream'))
      {
        // 替换编码头
        preg_match('/^(data:application\/octet-stream;base64,)/', $file, $data);
        $data[2] = 'xlsx';
      }
      else if(false !==strpos($file, 'audio/mp3'))
      {
        // 替换编码头
        preg_match('/^(data:audio\/mp3;base64,)/', $file, $data);
        $data[2] = 'mp3';
      }
      else
      {
        // 替换编码头
        preg_match('/^(data:\s*image\/(\w+);base64,)/', $file, $data);
      }

      $file = base64_decode(str_replace($data[1], '', $file));

      // 过滤所有的.符号
      $path = str_replace('.', '', $path);

      // 先去除两边空格
      $path = trim($path, '/');

      // 获取文件后缀
      $extension = $data[2];

      $filename = time() . mt_rand(1, 9999999);

      // 组合新的文件名
      $newName = md5($filename).'.'.$extension;

      $dir = $path . DIRECTORY_SEPARATOR . date('Y-m-d');

      Storage::disk($disk)->makeDirectory($dir);

      $filename = $dir . DIRECTORY_SEPARATOR . $newName;

      // 将内容上传到本地
      if(Storage::disk($disk)->put($filename, $file))
      {
        // 获取上传内容资源信息
        $url =  public_path(Storage::url($filename));

        $resource = fopen($url, 'r');

        // 将本地资源删除
        Storage::disk($disk)->delete($filename);

        // 将资源上传到OBS服务器
        return self::wirteObsServer($filename, $resource);
      }

      return false;
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-03
   * ------------------------------------------
   * 将资源上传到华为OBS服务器
   * ------------------------------------------
   *
   * 将资源上传到华为OBS服务器
   *
   * @param [type] $filename 文件名
   * @param [type] $resource 文件资源
   * @return [type]
   */
  private static function wirteObsServer($filename, $resource)
  {
    try
    {
      $response = Storage::disk('hwobs')->writeStream($filename, $resource);

      if($response)
      {
        $url = Storage::disk('hwobs')->url($filename);

        return strstr($url, '?', true);
      }
      else
      {
        return false;
      }
    }
    catch(\Exception $e)
    {
      \Log::error($e);

      return false;
    }
  }
}
