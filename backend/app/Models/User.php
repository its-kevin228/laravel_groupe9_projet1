<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role',
        'tontine_id',
        'date_adhesion',
        'ordre_passage',
        'adresse',
        'quartier',
        'profession',
        'piece_identite_type',
        'piece_identite_numero',
        'exclu_at',
        'raison_exclusion',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'date_adhesion'     => 'date',
            'exclu_at'          => 'datetime',
        ];
    }

    public function estExclu(): bool
    {
        return ! is_null($this->exclu_at);
    }

    /** Nom complet calculé */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMembre(): bool
    {
        return $this->role === 'membre';
    }

    public function tontine(): BelongsTo
    {
        return $this->belongsTo(Tontine::class);
    }

    /** Types de tontine auxquels le membre est inscrit (many-to-many) */
    public function tontineTypes(): BelongsToMany
    {
        return $this->belongsToMany(TontineType::class, 'tontine_type_user')
            ->withPivot(['date_adhesion', 'ajoute_par'])
            ->withTimestamps();
    }
}
