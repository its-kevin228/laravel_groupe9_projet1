<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'cycle_id',
        'user_id',
        'montant',
        'statut',
        'paid_at',
        'enregistre_par',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'date',
            'montant' => 'decimal:2',
        ];
    }

    public function cycle(): BelongsTo
    {
        return $this->belongsTo(Cycle::class);
    }

    public function membre(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function enregistrePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'enregistre_par');
    }
}
