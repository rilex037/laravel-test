<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testItHasFillableAttributes()
    {
        $user = new User();
        $fillable = ['first_name', 'last_name', 'email', 'password'];
        $this->assertEquals($fillable, $user->getFillable());
    }
}