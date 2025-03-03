<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Services\LoanService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(protected LoanService $loanService)
    {
        $this->authorizeResource(Client::class, 'client');
    }

    public function index(): View
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])->orderBy('created_at', 'desc')->get();
        return view('clients.index', ['clients' => ClientResource::collection($clients)]);
    }

    public function create(): View
    {
        return view('clients.form', [
            'action' => route('clients.store'),
            'method' => 'POST',
            'client' => null,
        ]);
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        try {
            $client = Client::create($request->validatedClientData());
            $this->loanService->handleLoans($client, $request->validatedLoanData());

            return redirect()->route('clients.index')
                ->with('success', __('clients.created'));
        } catch (\Exception $e) {
            Log::error('Failed to create client: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function edit(Client $client): View
    {
        return view('clients.form', [
            'action' => route('clients.update', $client),
            'method' => 'PUT',
            'client' => new ClientResource($client),
        ]);
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        try {
            $client->update($request->validatedClientData());
            $this->loanService->handleLoans($client, $request->validatedLoanData());

            return redirect()->route('clients.index')
                ->with('success', __('clients.updated'));
        } catch (\Exception $e) {
            Log::error('Failed to update client: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    public function delete(Client $client): View
    {
        return view('clients.delete', compact('client'));
    }

    public function destroy(Client $client): RedirectResponse
    {
        try {
            $client->delete();
            return redirect()->route('clients.index')
                ->with('success', __('clients.deleted'));
        } catch (\Exception $e) {
            Log::error('Failed to delete client: ' . $e->getMessage(), ['exception' => $e]);
            return back()->withErrors(['error' => __('clients.delete_failed')]);
        }
    }
}
