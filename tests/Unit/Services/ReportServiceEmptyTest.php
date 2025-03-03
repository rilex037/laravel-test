<?php

namespace Tests\Unit\Services;

use App\Services\ReportService;
use Tests\TestCase;

class ReportServiceEmptyTest extends TestCase
{
    public function testItReturnsEmptyArrayWhenNoLoansExist()
    {
        $service = new ReportService();
        $result = $service->generateReport(999);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
