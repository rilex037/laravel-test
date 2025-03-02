<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CashLoan extends Model
{
    use HasFactory;

    /** @var array<string> */
    protected $fillable = [
        'client_id',
        'adviser_id',
        'loan_amount',
    ];

    /**
     * Get the client associated with the cash loan.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the adviser associated with the cash loan.
     */
    public function adviser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adviser_id');
    }
}
