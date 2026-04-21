<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cycle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'tontine_id',
        'cycle_number',
        'beneficiary_user_id',
        'opened_at',
        'closed_at',
        'end_date',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'opened_at' => 'datetime',
            'closed_at' => 'datetime',
            'end_date'  => 'datetime',
        ];
    }

    /**
     * La tontine à laquelle appartient ce cycle.
     */
    public function tontine(): BelongsTo
    {
        return $this->belongsTo(Tontine::class);
    }

    /**
     * L'utilisateur bénéficiaire de ce cycle.
     */
    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(User::class, 'beneficiary_user_id');
    }

    /**
     * Les paiements de ce cycle.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
