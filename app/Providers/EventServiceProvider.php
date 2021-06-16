<?php
namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
          'SocialiteProviders\Weixin\WeixinExtendSocialite@handle',
        ],

        // 记录用户行为日志
        'App\Events\Platform\UserActionLogEvent' => [
            'App\Listeners\Platform\UserActionLogListeners',
        ],

        // 发送短信
        'App\Events\Common\Message\SmsEvent' => [
            'App\Listeners\Common\Message\SmsListeners',
        ],

        // 短信验证码
        'App\Events\Common\Sms\CodeEvent' => [
            'App\Listeners\Common\Sms\CodeListeners',
        ],

        // 发送邮件
        'App\Events\Common\Message\EmailEvent' => [
            'App\Listeners\Common\Message\EmailListeners',
        ],

        // 系统通知
        'App\Events\Common\NoticeEvent' => [
            'App\Listeners\Common\NoticeListeners',
        ],

        // 关注
        'App\Events\Api\Member\AttentionEvent' => [
            'App\Listeners\Api\Member\AttentionListeners',
        ],

        // 点赞
        'App\Events\Api\Member\Information\ApprovalEvent' => [
            'App\Listeners\Api\Member\Information\ApprovalListeners',
        ],

        // 收藏
        'App\Events\Api\Member\Information\CollectionEvent' => [
            'App\Listeners\Api\Member\Information\CollectionListeners',
        ],



        // 获取佣金
        'App\Events\Api\Member\MoneyEvent' => [
            'App\Listeners\Api\Member\MoneyListeners',
        ],

        // 获取分红
        'App\Events\Api\Member\Share\MoneyEvent' => [
            'App\Listeners\Api\Member\Share\MoneyListeners',
        ],

        // 确认管理老师
        'App\Events\Api\Member\Course\TeacherEvent' => [
            'App\Listeners\Api\Member\Course\TeacherListeners',
        ],

        // 添加课程信息
        'App\Events\Api\Member\Course\UnitPointEvent' => [
            'App\Listeners\Api\Member\Course\UnitPointListeners',
        ],

        // 完成课程单元学习
        'App\Events\Api\Member\Course\UnitFinishEvent' => [
            'App\Listeners\Api\Member\Course\UnitFinishListeners',
        ],

        // 解锁课程单元
        'App\Events\Api\Member\Course\Unit\UnlockEvent' => [
            'App\Listeners\Api\Member\Course\Unit\UnlockListeners',
        ],

        // 解锁课程知识点
        'App\Events\Api\Member\Course\Unit\Point\UnlockEvent' => [
            'App\Listeners\Api\Member\Course\Unit\Point\UnlockListeners',
        ],

        // 购买课程
        'App\Events\Api\Member\Order\CourseEvent' => [
            'App\Listeners\Api\Member\Order\CourseListeners',
        ],

        // 购买商品
        'App\Events\Api\Member\Order\GoodsEvent' => [
            'App\Listeners\Api\Member\Order\GoodsListeners',
        ],

        // 支付
        'App\Events\Api\Member\Order\PayEvent' => [
            'App\Listeners\Api\Member\Order\PayListeners',
        ],


        // 快讯利益
        'App\Events\Api\Flash\BenefitEvent' => [
            'App\Listeners\Api\Flash\BenefitListeners',
        ],

        // 快讯评论
        'App\Events\Api\Flash\CommentEvent' => [
            'App\Listeners\Api\Flash\CommentListeners',
        ],



        // 资讯浏览
        'App\Events\Api\Information\BrowseEvent' => [
            'App\Listeners\Api\Information\BrowseListeners',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
