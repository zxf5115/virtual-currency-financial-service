<?php
namespace App\Http\Controllers\Api\Module\Production;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Constant\Code;
use App\Http\Constant\Status;
use App\Models\Api\Module\Member\Member;
use App\Http\Controllers\Api\BaseController;

/**
 * @author zhangxiaofei [<1326336909@qq.com>]
 * @dateTime 2020-12-27
 *
 * 作品控制器类
 */
class ProductionController extends BaseController
{
  // 模型
  protected $_model = 'App\Models\Api\Module\Production\Production';

  // 默认查询条件
  protected $_where = [];

  // 查询条件
  protected $_params = [
    'member_id',
  ];

  // 附加关联查询条件
  protected $_addition = [
    'archive' => [
      'age',
      'city_id',
    ]
  ];

  // 排序条件
  protected $_order = [
    ['key' => 'create_time', 'value' => 'desc'],
  ];

  // 关联对像
  protected $_relevance = [
    'list' => [
      'member',
      'archive'
    ],
    'select' => [
      'member',
      'archive'
    ],
    'view' => [
      'member',
      'archive'
    ]
  ];


  /**
   * @api {get} /api/production/list?page={page} 1. 获取作品列表(分页)
   * @apiDescription 获取作品列表(分页)
   * @apiGroup 22. 作品模块
   *
   * @apiParam {int} page 当前页数
   * @apiParam {int} type 排序查询类型 1: 年龄 2: 城市 3: 点赞 4: 关注（可以为空）
   * @apiParam {int} member_id 会员编号（可以为空）
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {Number} is_approval 当前用户是否点赞
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/production/list
   * @apiVersion 1.0.0
   */
  public function list(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 使用点赞数排序
      if(!empty($request->type))
      {
        $where = $this->_model::getSortWhereData($request, $this->user->id);

        if(is_array($where))
        {
          $condition = array_merge($condition, $where);
        }
      }

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      if(4 == $request->type)
      {
        $relevance = ['asset'];

        $response = Member::getPaging($condition, $relevance, $this->_order);
      }
      else
      {
        // 获取关联对象
        $relevance = self::getRelevanceData($this->_relevance, 'list');

        $response = $this->_model::getPaging($condition, $relevance, $this->_order);
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
   * @api {get} /api/production/select 2. 获取作品列表(不分页)
   * @apiDescription 获取作品列表(不分页)
   * @apiGroup 22. 作品模块
   *
   * @apiParam {int} type 排序查询类型 1: 年龄 2: 城市 3: 点赞 4: 关注（可以为空）
   * @apiParam {int} member_id 会员编号（可以为空）
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {Number} is_approval 当前用户是否点赞
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/production/select
   * @apiVersion 1.0.0
   */
  public function select(Request $request)
  {
    try
    {
      $condition = self::getSimpleWhereData();

      // 使用点赞数排序
      if(!empty($request->type))
      {
        $where = $this->_model::getSortWhereData($request, $this->user->id);

        $condition = array_merge($condition, $where);
      }

      // 对用户请求进行过滤
      $filter = $this->filter($request->all());

      $condition = array_merge($condition, $this->_where, $filter);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'select');

      $response = $this->_model::getList($condition, $relevance, $this->_order);

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
   * @api {get} /api/production/view/{id} 3. 获取作品详情
   * @apiDescription 获取作品详情
   * @apiGroup 22. 作品模块
   *
   * @apiSuccess (basic params) {Number} id 作品编号
   * @apiSuccess (basic params) {Number} course_id 课程编号
   * @apiSuccess (basic params) {Number} courseware_id 课件编号
   * @apiSuccess (basic params) {Number} level_id 课件级别编号
   * @apiSuccess (basic params) {Number} member_id 会员编号
   * @apiSuccess (basic params) {Number} archive_id 学员档案编号
   * @apiSuccess (basic params) {String} title 作品名称
   * @apiSuccess (basic params) {String} picture 作品图片
   * @apiSuccess (basic params) {String} description 作品描述
   * @apiSuccess (basic params) {String} duration 内容时长
   * @apiSuccess (basic params) {Number} approval_total 点赞数
   * @apiSuccess (basic params) {Number} comment_total 评论数
   * @apiSuccess (basic params) {Number} is_approval 当前用户是否点赞
   * @apiSuccess (basic params) {String} create_time 发布时间
   *
   * @apiSuccess (member params) {String} nickname 会员昵称
   * @apiSuccess (member params) {String} username 会员账户
   *
   * @apiSuccess (archive params) {String} age 会员年龄
   * @apiSuccess (archive params) {String} city_id 会员所在地
   *
   * @apiSampleRequest /api/production/view/{id}
   * @apiVersion 1.0.0
   */
  public function view(Request $request, $id)
  {
    try
    {
      $condition = self::getSimpleWhereData($id);

      // 获取关联对象
      $relevance = self::getRelevanceData($this->_relevance, 'view');

      $response = $this->_model::getRow($condition, $relevance);

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
