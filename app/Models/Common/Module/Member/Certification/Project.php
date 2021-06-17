<?php
namespace App\Models\Common\Module\Member\Certification;

use App\Models\Base;
use App\Enum\Module\Member\CertificationEnum;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-06-17
 *
 * 会员项目认证模型类
 */
class Project extends Base
{
  // 表名
  public $table = "module_member_certification_project";

  // 可以批量修改的字段
  public $fillable = [
    'id',
    'organization_id',
    'member_id',
    'type',
    'certification_status ',
    'certification_status',
  ];

  // 隐藏的属性
  public $hidden = [
    'status',
    'update_time'
  ];

  // 追加到模型数组表单的访问器
  protected $appends = [];


  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-17
   * ------------------------------------------
   * 认证状态封装
   * ------------------------------------------
   *
   * 认证状态封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getTypeAttribute($value)
  {
    return CertificationEnum::getCertificationStatus($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-17
   * ------------------------------------------
   * 认证状态封装
   * ------------------------------------------
   *
   * 认证状态封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getCertificationStatusAttribute($value)
  {
    return CertificationEnum::getAuditStatus($value);
  }

  /**
   * @author zhangxiaofei [<1326336909@qq.com>]
   * @dateTime 2021-06-17
   * ------------------------------------------
   * 证书类型封装
   * ------------------------------------------
   *
   * 证书类型封装
   *
   * @param int $value 状态值
   * @return 状态信息
   */
  public function getCertificateTypeAttribute($value)
  {
    return CertificationEnum::getCertificateType($value);
  }
}
