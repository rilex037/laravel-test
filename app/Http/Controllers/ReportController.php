<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function __construct(protected ReportService $reportService)
    {
    }

    public function index(): View
    {
    $reportData = $this->reportService->generateReport(Auth::id());
        return view('report.index', ['reportData' => $reportData]);
    }

    public function export(): StreamedResponse
    {
        return $this->reportService->exportReport(Auth::id());
    }
}