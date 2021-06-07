<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

use App\Http\Constant\Code;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-07-07
 *
 * 刷新token
 */
class RefreshTokenUser extends BaseMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    // 检查此次请求中是否带有 token，如果没有则抛出异常。
    try
    {
      $this->checkForToken($request);
    }
    catch(UnauthorizedHttpException $e)
    {
      // 请先登录
      return self::error(Code::TOKEN_EMPTY);
    }

    // 使用 try 包裹，以捕捉 token 过期所抛出的 TokenExpiredException  异常
    try
    {
      // 检测用户的登录状态，如果正常则通过
      if ($this->auth->parseToken()->authenticate())
      {
        // 是否有权限返回
        return $next($request);
      }

      // 请先登录
      return self::error(Code::TOKEN_EMPTY);
    }
    catch (TokenExpiredException $exception)
    {
      // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
      try
      {
        // 刷新用户的 token
        $token = $this->auth->refresh();

        // 使用一次性登录以保证此次请求的成功
        Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
      }
      catch (JWTException $exception)
      {
        // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
        return self::error(Code::TOKEN_EXPIRED);
      }
    }

    // 如果Token不能解析的情况下
    try
    {
      // 使用 try 包裹，以捕捉 token 过期所抛出的 TokenExpiredException  异常
      try
      {
        // 检测用户的登录状态，如果正常则通过
        if ($this->auth->parseToken()->authenticate())
        {
          // 是否有权限返回
          return $next($request);
        }

        // 请先登录
        return self::error(Code::TOKEN_EMPTY);
      }
      catch (TokenExpiredException $exception)
      {
        // 此处捕获到了 token 过期所抛出的 TokenExpiredException 异常，我们在这里需要做的是刷新该用户的 token 并将它添加到响应头中
        try
        {
          // 刷新用户的 token
          $token = $this->auth->refresh();

          // 使用一次性登录以保证此次请求的成功
          Auth::guard('api')->onceUsingId($this->auth->manager()->getPayloadFactory()->buildClaimsCollection()->toPlainArray()['sub']);
        }
        catch (JWTException $exception)
        {
          // 如果捕获到此异常，即代表 refresh 也过期了，用户无法刷新令牌，需要重新登录。
          return self::error(Code::TOKEN_EXPIRED);
        }
      }
    }
    catch(TokenInvalidException $e)
    {
      // 非法账户，无法解析
      return self::error(Code::TOKEN_NO_VERIFIED);
    }

    // 在响应头中返回新的 token
    return $this->setAuthenticationHeader($next($request), $token);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-07-07
   * ------------------------------------------
   * 失败信息
   * ------------------------------------------
   *
   * 返回错误信息
   *
   * @param integer $code 错误代码
   * @return 错误信息
   */
  public static function error($code = Code::ERROR)
  {
    $headers = ['content-type' => 'application/json'];

    $response = \Response::json([
      'status' => $code,
      'message' => Code::message($code)
    ]);

    return $response->withHeaders($headers);
  }
}
