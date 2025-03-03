<?php

namespace Tests\Unit\Providers;

use App\Providers\AppServiceProvider;
use App\Services\LoanService;
use Tests\TestCase;

class AppServiceProviderTest extends TestCase
{
    public function testItRegistersLoanServiceAsSingleton()
    {
        $provider = new AppServiceProvider($this->app);
        $provider->register();

        $instance1 = $this->app->make(LoanService::class);
        $instance2 = $this->app->make(LoanService::class);

        $this->assertSame($instance1, $instance2);
    }
}