<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    /** @var array<string> */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    /**
     * Get the cash loan associated with the client.
     */
    public function cashLoan(): HasOne
    {
        return $this->hasOne(CashLoan::class);
    }

    /**
     * Get the home loan associated with the client.
     */
    public function homeLoan(): HasOne
    {
        return $this->hasOne(HomeLoan::class);
    }
}
