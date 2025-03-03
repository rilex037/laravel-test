<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with(['cashLoan', 'homeLoan'])
            ->get()
            ->map(function ($client) {
                return [
                    'id' => $client->id,
                    'first_name' => $client->first_name,
                    'last_name' => $client->last_name,
                    'email' => $client->email,
                    'phone' => $client->phone,
                    'has_cash_loan' => !is_null($client->cashLoan),
                    'has_home_loan' => !is_null($client->homeLoan),
                ];
            })->all();

        return view('clients.index', ['clients' => $clients]);
    }

    public function create()
    {
        // To be implemented
        return view('clients.create');
    }

    public function edit(Client $client)
    {
        // To be implemented
        return view('clients.edit', compact('client'));
    }

    public function destroy(Request $request, Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index');
    }
}