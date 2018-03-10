<?php

namespace Anacreation\School\Notification;

use Anacreation\School\Notification\Contracts\EmailSender;
use Anacreation\School\Notification\Contracts\SmsSender;
use Anacreation\School\Notification\ServiceProviders\Nexmo;
use Anacreation\School\Notification\ServiceProviders\SendGrid;
use Illuminate\Support\ServiceProvider;

class SchoolNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "notification");
        $this->loadRoutesFrom(__DIR__ . "/routes.php");
        $this->loadMigrationsFrom(__DIR__ . "/database/migrations");
        $this->publishes([
            __DIR__ . '/config/school_notification.php' => config_path('school_notification.php'),
        ]);

        $this->app->bind(SmsSender::class,
            config("school_notification.providers.sms", Nexmo::class));
        $this->app->bind(EmailSender::class,
            config("school_notification.providers.email", SendGrid::class));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
            __DIR__ . '/config/school_notification.php', 'school_notification'
        );
    }
}
