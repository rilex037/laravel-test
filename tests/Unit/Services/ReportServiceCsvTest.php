<?php

namespace Tests\Unit\Services;

use App\Services\ReportService;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Tests\TestCase;

class ReportServiceCsvTest extends TestCase
{
    public function testItIncludesCorrectCsvHeaders()
    {
        $service = new ReportService();
        $response = $service->exportReport(999); // Non-existent adviser ID

        $this->assertInstanceOf(StreamedResponse::class, $response);
        $this->assertEquals('text/csv', $response->headers->get('Content-Type'));

        ob_start();
        $response->sendContent();
        $content = ob_get_clean();

        $this->assertStringContainsString('"Product Type","Product Value","Creation Date"' . "\n", $content);
    }
}