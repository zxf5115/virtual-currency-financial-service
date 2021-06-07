<?php
namespace App\Http\Controllers\Api\Module\Teacher\Management\Relevance;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Parameter;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;
use App\Models\Api\Module\Production\Production;
use App\Models\Api\Module\Education\Course\Course;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2021-02-05
 *
 * 管理老师的班级控制器类
 */
class SquadController extends BaseController
{
  /**
   * 操作模型
   */
  protected $_model = 'App\Models\Api\Module\Member\Relevance\Course';

  /**
   * 基本查询条件
   */
  protected $_where = [];

  /**
   * 关联查询条件
   */
  protected $_with = [];

  /**
   * 基础查询字段
   */
  protected $_params = [
   'course_id',
   'courseware_id',
   'level_id',
  ];

  /**
   * 关联查询字段
   */
  protected $_addition = [];

  /**
   * 排序方式
   */
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  /**
   * 关联查询对象
   */
  protected $_relevance = [
    'list' => ['courseware.level'],
    'student' => ['archive'],
  ];


  /**
   * @api {get} /api/teacher/management/squad/list?page={page} 01. 班级列表(分页)
   * @apiDescription 获取当前管理老师的班级列表(分页)
   * @apiGroup 37. 管理老师班级模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   *
   * @apiSuccess (basic params) {Number} id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} unlock_id 解锁编号
   * @apiSuccess (basic params) {String} title 课程名称
   * @apiSuccess (basic params) {String} present 礼包信息
   * @apiSuccess (basic params) {String} description 优惠说明
   * @apiSuccess (basic params) {Number} apply_start_time 报名开始时间
   * @apiSuccess (basic params) {Number} apply_end_time 报名结束时间
   * @apiSuccess (basic params) {Number} course_start_time 开课时间
   * @apiSuccess (basic params) {Number} line_price 划线价格
   * @apiSuccess (basic params) {Number} real_price 销售价格
   * @apiSuccess (basic params) {Number} semester 课程周期
   * @apiSuccess (basic params) {Number} apply_status 报名状态
   *
   * @apiSuccess (courseware params) {Number} id 课件编号
   * @apiSuccess (courseware params) {String} title 课件名称
   *
   * @apiSampleRequest /api/teacher/management/squad/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取当前老师
      $result = $this->_model::getPluck('course_id', $condition, false, false, true);

      if(empty($result))
      {
        return self::error(Code::TEACHER_SQUAD_EMPTY);
      }

      $condition = [['id', $result]];

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'list');

      // 获取当前老师的班级
      $response = Course::getPaging($condition, $relevance, false, true);

      if(!empty($response['data']))
      {
        foreach($response['data'] as $k => &$item)
        {
          $where = [
            'course_id'  => $item['id'],
            'teacher_id' => self::getCurrentId()
          ];

          $item['buy_total'] = $this->_model::getCount($where);
        }
      }

      return self::success($response);
    }
    catch(\Exception $e)
    {
      // 记录异常信息
      self::record($e);

      return self::error(Code::ERROR);
    }
  }


  /**
   * @api {get} /api/teacher/management/squad/student?page={page} 02. 班级学员列表(分页)
   * @apiDescription 获取当前管理老师的班级学员列表(分页)
   * @apiGroup 37. 管理老师班级模块
   * @apiPermission jwt
   * @apiHeader {String} Authorization 身份令牌
   * @apiHeaderExample {json} Header-Example:
   * {
   *   "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmN"
   * }
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} course_id 课程编号
   * @apiParam {int} courseware_id 课件编号
   * @apiParam {int} level_id 课件级别编号
   *
   * @apiSuccess (basic params) {Number} id 会员编号
   * @apiSuccess (basic params) {String} open_id 第三方登录编号
   * @apiSuccess (basic params) {Number} member_no 会员号
   * @apiSuccess (basic params) {String} avatar 会员头像
   * @apiSuccess (basic params) {String} username 登录账户
   * @apiSuccess (basic params) {String} nickname 会员姓名
   * @apiSuccess (basic params) {Number} is_freeze 是否冻结 1 冻结 2 不冻结
   * @apiSuccess (basic params) {Number} create_time 注册时间
   *
   * @apiSuccess (archive params) {Number} member_id 会员编号
   * @apiSuccess (archive params) {Number} skill_level 绘画基础
   * @apiSuccess (archive params) {String} id_card_no 身份证号
   * @apiSuccess (archive params) {String} weixin 微信号
   * @apiSuccess (archive params) {String} sex 性别
   * @apiSuccess (archive params) {String} birthday 生日
   * @apiSuccess (archive params) {String} age 年龄
   * @apiSuccess (archive params) {String} province_id 省
   * @apiSuccess (archive params) {String} city_id 市
   * @apiSuccess (archive params) {String} region_id 县
   * @apiSuccess (archive params) {String} address 详细地址
   *
   * @apiSampleRequest /api/teacher/management/squad/student
   * @apiVersion 1.0.0
   */
  public function student(Request $request)
  {
    try
    {
      $condition = self::getCurrentWhereData('teacher_id');

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取当前老师
      $result = $this->_model::getPluck('member_id', $condition, false, false, true);

      if(empty($result))
      {
        return self::error(Code::TEACHER_SQUAD_EMPTY);
      }

      $condition = [['id', $result]];

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'student');

      // 获取当前老师的学员
      $response = Member::getPaging($condition, $relevance);

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
