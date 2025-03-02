<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /** @var array<string> */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /** @var array<string> */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the cash loans associated with the adviser.
     */
    public function cashLoans(): HasMany
    {
        return $this->hasMany(CashLoan::class, 'adviser_id');
    }

    /**
     * Get the home loans associated with the adviser.
     */
    public function homeLoans(): HasMany
    {
        return $this->hasMany(HomeLoan::class, 'adviser_id');
    }
}
