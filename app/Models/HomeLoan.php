<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeLoan extends Model
{
    use HasFactory;

    /** @var array<string> */
    protected $fillable = [
        'client_id',
        'adviser_id',
        'property_value',
        'down_payment_amount',
    ];

    /**
     * Get the client associated with the home loan.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Get the adviser associated with the home loan.
     */
    public function adviser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adviser_id');
    }
}