@extends('layouts.app')

@section('title', 'Adviser Report')

@section('content')
<div class="bg-white text-black w-full max-w-4xl p-6 rounded-lg shadow-lg mx-auto mt-16">
    <div class="max-w-4xl mx-auto p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
            <h1 class="text-2xl font-bold text-gray-800">Adviser Report</h1>
            <div class="space-x-2">
                <a href="{{ route('dashboard') }}"
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    Back to Dashboard
                </a>
                <a href="{{ route('report.export') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition-colors duration-200">
                    Export to CSV
                </a>
            </div>
        </div>

        @if(empty($reportData))
        <div class="text-center py-8">
            <p class="text-gray-600">No products found for this adviser.</p>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Product Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Product Value (€)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 border-b">Creation Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportData as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-gray-800 border-b">{{ $item['product_type'] }}</td>
                        <td class="px-6 py-4 text-gray-800 border-b">{{ number_format($item['product_value'] / 100, 2, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-800 border-b">{{ $item['created_at']->toDateTimeString() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection