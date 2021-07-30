<?php
use App\Http\Constant\Code;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-28
 *
 * 本地环境下进行日志输出
 *
 * @param    [object]     $exception    [异常对象]
 *
 * @return   [false|错误]
 */
function record($exception)
{
  if('local' == config('app.debug'))
  {
    dd($exception);
  }
  else
  {
    \Log::debug($exception);
  }
}


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-07-26
 * ------------------------------------------
 * 成功信息
 * ------------------------------------------
 *
 * 返回成功信息
 *
 * @param array $data [数据信息]
 * @return 成功信息
 */
function success($data = [], $message = '')
{
  $code = Code::SUCCESS;

  $headers = ['content-type' => 'application/json'];

  $result = [
    'status'  => $code,
    'message' => $message ?: Code::message($code),
    'data'    => $data
  ];

  $response = \Response::json();

  return $response->withHeaders($headers);
}


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-01-19
 * ------------------------------------------
 * 失败信息
 * ------------------------------------------
 *
 * 返回错误信息
 *
 * @param integer $code 错误代码
 * @return 错误信息
 */
function error($code = 1000)
{
  $headers = ['content-type' => 'application/json'];

  $result = [
    'status' => $code,
    'message' => Code::message($code)
  ];

  $response = \Response::json($result);

  return $response->withHeaders($headers);
}



/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-07-26
 * ------------------------------------------
 * 自定义信息
 * ------------------------------------------
 *
 * 返回自定义信息
 *
 * @param integer $code 错误代码
 * @return 错误信息
 */
function message($message)
{
  $headers = ['content-type' => 'application/json'];

  $response = \Response::json(['status' => 0, 'message' => $message]);

  return $response->withHeaders($headers);
}
