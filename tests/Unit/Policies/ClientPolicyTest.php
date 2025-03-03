<?php

namespace Tests\Unit\Policies;

use App\Models\User;
use App\Policies\ClientPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientPolicyTest extends TestCase
{
    use RefreshDatabase;

    public function testItAllowsAnyUserToViewAnyClients()
    {
        $user = User::factory()->create();
        $policy = new ClientPolicy();

        $this->assertTrue($policy->viewAny($user));
    }
}