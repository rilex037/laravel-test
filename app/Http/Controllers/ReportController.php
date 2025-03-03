<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CashLoan;
use App\Models\HomeLoan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function index(): View
    {
        $adviserId = Auth::id();

        $cashLoans = CashLoan::where('adviser_id', $adviserId)
            ->select('id', 'loan_amount as product_value', 'created_at')
            ->get()
            ->map(function ($loan) {
                return [
                    'product_type' => 'Cash Loan',
                    'product_value' => $loan->product_value,
                    'created_at' => $loan->created_at,
                ];
            });

        $homeLoans = HomeLoan::where('adviser_id', $adviserId)
            ->select('id', 'property_value', 'down_payment_amount', 'created_at')
            ->get()
            ->map(function ($loan) {
                return [
                    'product_type' => 'Home Loan',
                    'product_value' => $loan->property_value - $loan->down_payment_amount,
                    'created_at' => $loan->created_at,
                ];
            });

        $reportData = $cashLoans->merge($homeLoans)
            ->sortByDesc('created_at')
            ->values()
            ->all();

        return view('report.index', ['reportData' => $reportData]);
    }

    public function export(): StreamedResponse
    {
        $adviserId = Auth::id();

        $cashLoans = CashLoan::where('adviser_id', $adviserId)
            ->select('loan_amount as product_value', 'created_at')
            ->get()
            ->map(function ($loan) {
                return [
                    'Product Type' => 'Cash Loan',
                    'Product Value' => $loan->product_value,
                    'Creation Date' => $loan->created_at->toDateTimeString(),
                ];
            });

        $homeLoans = HomeLoan::where('adviser_id', $adviserId)
            ->select('property_value', 'down_payment_amount', 'created_at')
            ->get()
            ->map(function ($loan) {
                return [
                    'Product Type' => 'Home Loan',
                    'Product Value' => $loan->property_value - $loan->down_payment_amount,
                    'Creation Date' => $loan->created_at->toDateTimeString(),
                ];
            });

        $reportData = $cashLoans->merge($homeLoans)
            ->sortByDesc('Creation Date')
            ->values()
            ->all();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="adviser_report_' . now()->format('Y-m-d_His') . '.csv"',
        ];

        $callback = function () use ($reportData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Product Type', 'Product Value', 'Creation Date']);

            foreach ($reportData as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return new StreamedResponse($callback, 200, $headers);
    }
}
