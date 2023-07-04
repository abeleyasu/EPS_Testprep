<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\Interface\MailgunServiceInterface;
use App\Service\MailgunService;

class MailgunServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MailgunServiceInterface::class, MailgunService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
