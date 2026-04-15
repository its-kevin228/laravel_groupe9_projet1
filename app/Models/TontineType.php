<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TontineType extends Model
{
    protected $fillable = [
        'nom',
        'montant',
        'devise',
        'description',
        'actif',
    ];

    protected function casts(): array
    {
        return [
            'montant' => 'decimal:2',
            'actif'   => 'boolean',
        ];
    }

    /** Membres inscrits à ce type (many-to-many) */
    public function membres(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tontine_type_user')
            ->withPivot(['date_adhesion', 'ajoute_par'])
            ->withTimestamps();
    }
}
