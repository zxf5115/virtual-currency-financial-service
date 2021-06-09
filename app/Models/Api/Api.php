<?php
namespace App\Models\Api;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-04-20
 *
 * Token模型类, 用于JWT验证使用
 */
class Api extends Authenticatable implements JWTSubject
{
  protected $table = 'module_member';

  use Notifiable;

  /**
   * Get the identifier that will be stored in the subject claim of the JWT.
   *
   * @return mixed
   */
  public function getJWTIdentifier()
  {
      return $this->getKey();
  }

  /**
   * Return a key value array, containing any custom claims to be added to the JWT.
   *
   * @return array
   */
  public function getJWTCustomClaims()
  {
      return [];
  }
}
