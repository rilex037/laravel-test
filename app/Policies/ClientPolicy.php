<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Client $client): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Client $client): bool
    {
        return !$client->cashLoan || $client->cashLoan->adviser_id === $user->id &&
            !$client->homeLoan || $client->homeLoan->adviser_id === $user->id;
    }

    public function delete(User $user, Client $client): bool
    {
        return !$client->cashLoan || $client->cashLoan->adviser_id === $user->id &&
            !$client->homeLoan || $client->homeLoan->adviser_id === $user->id;
    }
}
