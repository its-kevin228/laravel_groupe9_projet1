@extends('pdf.layout')
@section('titre', 'Rapport paiements — ' . $tontine->nom)

@section('content')
<div class="info-row"><span class="info-label">Tontine :</span> {{ $tontine->nom }}</div>
<div class="info-row"><span class="info-label">Cycle :</span> {{ $cycle ? 'Cycle n° ' . $cycle->numero_cycle : 'Tous les cycles' }}</div>
<div class="info-row"><span class="info-label">Période :</span>
    {{ $cycle ? $cycle->date_ouverture->format('d/m/Y') . ' → ' . ($cycle->date_fermeture ? $cycle->date_fermeture->format('d/m/Y') : 'En cours') : 'Complète' }}
</div>

<div class="stats-grid">
    <div class="stat-box">
        <div class="stat-value">{{ $stats['total_paiements'] }}</div>
        <div class="stat-label">Paiements</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ number_format($stats['total_collecte'], 0, '.', ' ') }}</div>
        <div class="stat-label">Total collecté (FCFA)</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ $stats['paye'] }}</div>
        <div class="stat-label">Payés</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ $stats['en_retard'] }}</div>
        <div class="stat-label">En retard</div>
    </div>
</div>

<div class="section-title">Détail des paiements</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Membre</th>
            <th>Cycle</th>
            <th>Montant</th>
            <th>Date paiement</th>
            <th>Statut</th>
            <th>Enregistré par</th>
        </tr>
    </thead>
    <tbody>
        @foreach($paiements as $i => $p)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p->membre->full_name }}</td>
            <td>Cycle {{ $p->cycle->numero_cycle }}</td>
            <td>{{ number_format($p->montant, 0, '.', ' ') }} FCFA</td>
            <td>{{ $p->paid_at->format('d/m/Y') }}</td>
            <td>
                @if($p->statut === 'paye')
                    <span class="badge badge-green">Payé</span>
                @else
                    <span class="badge badge-red">En retard</span>
                @endif
            </td>
            <td>{{ $p->enregistrePar?->full_name ?? 'Système' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
