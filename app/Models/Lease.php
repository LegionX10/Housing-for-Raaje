<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lease extends Model
{
    protected $fillable = [
        'apartment_id',
        'client_id',
        'staff_id',
        'monthly_rent',
        'deposit',
        'payment_method',
        'start_date',
        'duration_months',
        'end_date',
        'owner_signed_at',
        'client_signed_at',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'owner_signed_at' => 'datetime',
            'client_signed_at' => 'datetime',
        ];
    }

    public function apartment(): BelongsTo
    {
        return $this->belongsTo(Apartment::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
