<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cycle extends Model
{
    protected $fillable = [
        'tontine_id',
        'numero_cycle',
        'beneficiaire_id',
        'ordre_beneficiaire',
        'statut',
        'date_ouverture',
        'date_fermeture',
    ];

    protected function casts(): array
    {
        return [
            'date_ouverture'  => 'date',
            'date_fermeture'  => 'date',
        ];
    }

    public function tontine(): BelongsTo
    {
        return $this->belongsTo(Tontine::class);
    }

    public function beneficiaire(): BelongsTo
    {
        return $this->belongsTo(User::class, 'beneficiaire_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function estOuvert(): bool
    {
        return $this->statut === 'ouvert';
    }

    public function estFerme(): bool
    {
        return $this->statut === 'ferme';
    }
}
