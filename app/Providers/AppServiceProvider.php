<?php

namespace App\Providers;

use App\Services\LoanService;
use App\Services\ReportService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoanService::class, fn() => new LoanService());
        $this->app->singleton(ReportService::class, fn() => new ReportService());
    }

    public function boot(): void
    {
        //
    }
}