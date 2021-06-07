<?php
namespace App\Models\Common\Module\Member;

use App\Models\Base;
use App\Http\Constant\Parameter;
use App\Enum\Module\Member\MemberEnum;
use App\Enum\Module\Teacher\TeacherEnum;


/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-08-01
 *
 * 学员模型类
 */
class Member extends Base
{
  // 表名
  public $table = "module_member";

  // 可以批量修改的字段
  public $fillable = ['username', 'password'];

  // 隐藏的属性
  public $hidden = [
    'password',
    'remember_token',
    'password_salt',
    'try_number',
    'last_login_ip'
  ];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-19
   * ------------------------------------------
   * 访问限制
   * ------------------------------------------
   *
   * 在一个小时内访问超过五次，就会触发禁止访问
   *
   * @param [type] $request [description]
   */
  public static function AccessRestrictions($request)
  {
    try
    {
      // 如果用户上次登录时间和当前时间相差小于一个小时并且登录次数小于五次，返回可以访问，否则禁止访问
      if(time() - $request->last_login_time < 3600 && $request->try_number > 5)
      {
        return true;
      }

      return false;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-19
   * ------------------------------------------
   * 验证密码
   * ------------------------------------------
   *
   * 具体描述一些细节
   *
   * @param array $request 用户对象
   * @param string $password 用户输入的密码
   * @return 密码正确返回false，否则true
   */
  public static function checkPassword($request, $password)
  {
    try
    {
      if(password_verify($password, $request->password))
      {
        return false;
      }

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return true;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 设置密码尝试数据
   * ------------------------------------------
   *
   * 在用户输入密码错误后，进行尝试次数记录
   *
   * @param object $request 用户信息
   */
  public static function setTryNumber($request)
  {
    try
    {
      $request->increment('try_number');
      $request->save();

      return true;
    }
    catch(\Exception $e)
    {
      self::log($e);

      return false;
    }
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 生成密码
   * ------------------------------------------
   *
   * 生成密码 TODO： 后期修改进行加盐处理
   *
   * @param string $password 用户输入的密码
   * @return 加密的密码信息
   */
  public static function generate($password = Parameter::PASSWORD)
  {
    $salt = bin2hex(random_bytes(60));

    $options = [
      'cost' => 12,
    ];

    $password = password_hash($password, PASSWORD_BCRYPT, $options);

    return $password;
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-01-12
   * ------------------------------------------
   * 计算学员年龄
   * ------------------------------------------
   *
   * 根据学员出生年月日计算年龄，用于保存数据库
   *
   * @param [type] $birthday [description]
   * @return [type]
   */
  public static function computeAge($birthday)
  {
    try
    {
      $model = new \Carbon\Carbon($birthday);

      return $model->diffInYears();
    }
    catch(\Exception $e)
    {
      // 记录异常
      self::record($e);

      return false;
    }
  }




  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 学员状态封装
   * ------------------------------------------
   *
   * 学员状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getStatusAttribute($value)
  {
    return MemberEnum::getStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 条件状态封装
   * ------------------------------------------
   *
   * 条件状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getConditionAttribute($value)
  {
    return TeacherEnum::getConditionStatus($value);
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-20
   * ------------------------------------------
   * 学员冻结状态封装
   * ------------------------------------------
   *
   * 学员冻结状态封装
   *
   * @param [type] $value [description]
   * @return [type]
   */
  public function getIsFreezeAttribute($value)
  {
    return MemberEnum::getFreezeStatus($value);
  }


  // 关联函数 ------------------------------------------------------


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 学员与机构关联表
   * ------------------------------------------
   *
   * 学员与机构关联表
   *
   * @return [关联对象]
   */
  public function organization()
  {
      return $this->belongsTo('App\Models\Common\Module\Organization\Organization', 'organization_id', 'id')
                  ->where(['status'=>1]);
  }



  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联到角色表
   * ------------------------------------------
   *
   * 关联到角色表
   *
   * @return [关联对象]
   */
  public function role()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Member\Role',
      'module_member_role_relevance',
      'member_id',
      'role_id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 关联用户与角色关联表
   * ------------------------------------------
   *
   * 关联用户与角色关联表，用于删除
   *
   * @return [关联对象]
   */
  public function relevance()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Relevance\Role', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与学员档案关联表
   * ------------------------------------------
   *
   * 学员与学员档案关联表
   *
   * @return [关联对象]
   */
  public function archive()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Relevance\Archive', 'member_id', 'id');
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与学员资产关联表
   * ------------------------------------------
   *
   * 学员与学员资产关联表
   *
   * @return [关联对象]
   */
  public function asset()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Relevance\Asset', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与学员账户关联表
   * ------------------------------------------
   *
   * 学员与学员账户关联表
   *
   * @return [关联对象]
   */
  public function account()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Relevance\Account', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-12-30
   * ------------------------------------------
   * 学员与学员任务进度关联表
   * ------------------------------------------
   *
   * 学员与学员任务进度关联表
   *
   * @return [关联对象]
   */
  public function target()
  {
      return $this->hasOne('App\Models\Common\Module\Member\Relevance\Target', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 学员与学员学习课程关联表
   * ------------------------------------------
   *
   * 学员与学员学习课程关联表
   *
   * @return [关联对象]
   */
  public function course()
  {
      return $this->hasMany('App\Models\Common\Module\Member\Relevance\Course', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-19
   * ------------------------------------------
   * 学员与班级关联函数
   * ------------------------------------------
   *
   * 学员与班级关联函数
   *
   * @return [关联对象]
   */
  public function squad()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Organization\Squad\Squad',
      'module_squad_member_relevance',
      'member_id',
      'squad_id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-01-20
   * ------------------------------------------
   * 会有与消息关联表
   * ------------------------------------------
   *
   * 会有与消息关联表
   *
   * @return [关联对象]
   */
  public function message()
  {
    return $this->belongsToMany(
      'App\Models\Common\Module\Message\Message',
      'module_member_message_relevance',
      'member_id',
      'message_id'
    );
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-10-20
   * ------------------------------------------
   * 招生老师与分红关联表
   * ------------------------------------------
   *
   * 招生老师与分红关联表
   *
   * @return [关联对象]
   */
  public function share()
  {
      return $this->hasOne('App\Models\Common\Module\Teacher\Recruitment\Relevance\Money', 'member_id', 'id');
  }


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2020-03-07
   * ------------------------------------------
   * 注册关联删除
   * ------------------------------------------
   *
   * 注册关联删除
   *
   * @return [type]
   */
  public static function boot()
  {
    parent::boot();

    static::deleted(function($model) {
      $model->relevance()->delete();
      $model->archive()->delete();
      $model->course()->delete();
    });
  }
}
