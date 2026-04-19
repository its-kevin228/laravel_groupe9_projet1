<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tontine extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'montant_cotisation',
        'frequence',
        'date_debut',
        'statut',
    ];

    protected function casts(): array
    {
        return [
            'date_debut' => 'date',
        ];
    }

    public function membres(): HasMany
    {
        return $this->hasMany(User::class, 'tontine_id');
    }

    public function cycles(): HasMany
    {
        return $this->hasMany(Cycle::class);
    }

    /** Cycle actuellement ouvert */
    public function cycleActif(): ?Cycle
    {
        return $this->cycles()->where('statut', 'ouvert')->first();
    }

    /** Prochain numéro de cycle */
    public function prochainNumeroCycle(): int
    {
        return ($this->cycles()->max('numero_cycle') ?? 0) + 1;
    }

    public function peutEtreModifiee(): bool
    {
        return in_array($this->statut, ['en_attente', 'active']);
    }

    public function peutAjouterMembres(): bool
    {
        return in_array($this->statut, ['en_attente', 'active']);
    }

    public function peutEtreSupprimee(): bool
    {
        return $this->statut === 'terminee';
    }

    /**
     * Durée d'un cycle en jours selon la fréquence de la tontine.
     */
    public function dureeEnJours(): int
    {
        return match ($this->frequence) {
            'hebdomadaire' => 7,
            'mensuel'      => 30,
            'trimestriel'  => 90,
            default        => 30,
        };
    }

    /**
     * Calcule la date de fermeture d'un cycle à partir de sa date d'ouverture.
     */
    public function dateFermetureCycle(\Carbon\Carbon $dateOuverture): \Carbon\Carbon
    {
        return $dateOuverture->copy()->addDays($this->dureeEnJours() - 1);
    }

    /**
     * Détermine le bénéficiaire du prochain cycle
     * selon l'ordre_passage des membres (ordre croissant).
     * Après le dernier membre, on repart du premier.
     */
    public function prochainBeneficiaire(): ?User
    {
        $dernierOrdre = $this->cycles()
            ->where('statut', 'ferme')
            ->max('ordre_beneficiaire') ?? 0;

        // Cherche le membre avec l'ordre_passage immédiatement supérieur
        $membre = $this->membres()
            ->where('ordre_passage', '>', $dernierOrdre)
            ->orderBy('ordre_passage')
            ->first();

        // Si plus personne → on repart du début (cycle complet)
        if (! $membre) {
            $membre = $this->membres()->orderBy('ordre_passage')->first();
        }

        return $membre;
    }
}
