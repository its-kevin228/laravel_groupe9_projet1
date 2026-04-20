<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tontine extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'amount_per_cycle',
        'frequency',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount_per_cycle' => 'decimal:2',
        ];
    }

    /**
     * Les membres participant à cette tontine.
     */
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'tontine_user')
                    ->withPivot('beneficiary_order', 'joined_at')
                    ->withTimestamps();
    }

    /**
     * Les cycles de cette tontine.
     */
    public function cycles(): HasMany
    {
        return $this->hasMany(Cycle::class);
    }
}
