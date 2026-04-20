<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class AuditLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'entite_type',
        'entite_id',
        'details',
        'ip_address',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Enregistre une action dans le journal d'audit.
     *
     * @param string      $action      ex: 'paiement.enregistre', 'cycle.ouvert'
     * @param object|null $entite      le model concerné (Payment, Cycle, User...)
     * @param array       $details     données contextuelles
     * @param int|null    $adminId     ID de l'admin (null = système)
     */
    public static function journaliser(
        string  $action,
        ?object $entite  = null,
        array   $details = [],
        ?int    $adminId = null,
    ): self {
        $request = app(Request::class);

        return self::create([
            'user_id'     => $adminId ?? auth()->id(),
            'action'      => $action,
            'entite_type' => $entite ? class_basename($entite) : null,
            'entite_id'   => $entite?->id,
            'details'     => $details,
            'ip_address'  => $request->ip(),
        ]);
    }
}
