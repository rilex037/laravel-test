<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\LoanService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(LoanService::class, fn() => new LoanService());
    }

    public function boot(): void
    {
        //
    }
}
