<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Invitation extends Model
{
    protected $fillable = [
        'tontine_id',
        'invite_par',
        'user_id',
        'email',
        'token',
        'statut',
        'expires_at',
        'repondu_at',
        'message',
    ];

    protected $casts = [
        'expires_at'  => 'datetime',
        'repondu_at'  => 'datetime',
    ];

    public function tontine(): BelongsTo
    {
        return $this->belongsTo(Tontine::class);
    }

    public function invitePar(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invite_par');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estValide(): bool
    {
        return $this->statut === 'en_attente' && $this->expires_at->isFuture();
    }

    public function estExpiree(): bool
    {
        return $this->expires_at->isPast() && $this->statut === 'en_attente';
    }

    /** Génère un token sécurisé unique */
    public static function genererToken(): string
    {
        return Str::random(32) . bin2hex(random_bytes(16));
    }
}
