<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\LoanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ClientController extends Controller
{
    private LoanService $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index(): View
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])
            ->get()
            ->map(fn(Client $client): array => [
                'id' => $client->id,
                'first_name' => $client->first_name,
                'last_name' => $client->last_name,
                'email' => $client->email,
                'phone' => $client->phone,
                'has_cash_loan' => !is_null($client->cashLoan),
                'has_home_loan' => !is_null($client->homeLoan),
            ])
            ->all();

        return view('clients.index', ['clients' => $clients]);
    }

    public function create(): View
    {
        return view('clients.form', [
            'action' => route('clients.store'),
            'method' => 'POST',
            'client' => null,
            'adviser_id' => Auth::id(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'cash_loan_amount' => 'nullable|numeric|min:0',
            'property_value' => 'nullable|numeric|min:0',
            'down_payment_amount' => 'nullable|numeric|min:0',
            '_token' => 'required',
        ]);

        if ($this->validateContactFields($request)) {
            return redirect()
                ->back()
                ->withErrors(['contact' => 'Either an email or phone number is required.'])
                ->withInput();
        }

        $client = Client::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        $this->loanService->handleLoans($client, $validated, Auth::id());

        return redirect()->route('clients.index')->with('success', 'Client created successfully');
    }

    public function edit(Client $client): View
    {
        $cashLoan = $client->cashLoan;
        $homeLoan = $client->homeLoan;

        return view('clients.form', [
            'action' => route('clients.update', $client),
            'method' => 'PUT',
            'client' => array_merge(
                $client->toArray(),
                [
                    'cash_loan_amount' => $cashLoan?->loan_amount,
                    'property_value' => $homeLoan?->property_value,
                    'down_payment_amount' => $homeLoan?->down_payment_amount,
                ]
            ),
            'adviser_id' => Auth::id(),
        ]);
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:255',
            'cash_loan_amount' => 'nullable|numeric|min:0',
            'property_value' => 'nullable|numeric|min:0',
            'down_payment_amount' => 'nullable|numeric|min:0',
            '_token' => 'required',
        ]);

        if ($this->validateContactFields($request)) {
            return redirect()
                ->back()
                ->withErrors(['contact' => 'Either an email or phone number is required.'])
                ->withInput();
        }

        $client->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        $this->loanService->handleLoans($client, $validated, Auth::id());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    public function delete(Client $client): View
    {
        return view('clients.delete', compact('client'));
    }

    public function destroy(Request $request, Client $client): RedirectResponse
    {
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }

    private function validateContactFields(Request $request): bool
    {
        return empty($request->email) && empty($request->phone);
    }
}