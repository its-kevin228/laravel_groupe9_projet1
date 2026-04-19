@extends('pdf.layout')
@section('titre', 'Historique — ' . $tontine->nom)

@section('content')
<div class="info-row"><span class="info-label">Tontine :</span> {{ $tontine->nom }}</div>
<div class="info-row"><span class="info-label">Statut :</span> {{ ucfirst($tontine->statut) }}</div>
<div class="info-row"><span class="info-label">Fréquence :</span> {{ ucfirst($tontine->frequence) }}</div>
<div class="info-row"><span class="info-label">Cotisation :</span> {{ number_format($tontine->montant_cotisation, 0, '.', ' ') }} FCFA</div>
<div class="info-row"><span class="info-label">Date début :</span> {{ $tontine->date_debut ? $tontine->date_debut->format('d/m/Y') : '—' }}</div>

<div class="stats-grid">
    <div class="stat-box">
        <div class="stat-value">{{ $stats['total_membres'] }}</div>
        <div class="stat-label">Membres</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ $stats['total_cycles'] }}</div>
        <div class="stat-label">Cycles</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ number_format($stats['total_collecte'], 0, '.', ' ') }}</div>
        <div class="stat-label">Total collecté (FCFA)</div>
    </div>
    <div class="stat-box">
        <div class="stat-value">{{ $stats['taux_recouvrement'] }}%</div>
        <div class="stat-label">Taux recouvrement</div>
    </div>
</div>

<div class="section-title">Historique des cycles</div>
<table>
    <thead>
        <tr>
            <th>Cycle</th>
            <th>Bénéficiaire</th>
            <th>Ouverture</th>
            <th>Fermeture</th>
            <th>Ont payé</th>
            <th>En retard</th>
            <th>Collecté</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cycles as $c)
        <tr>
            <td>{{ $c['numero_cycle'] }}</td>
            <td>{{ $c['beneficiaire'] ?? '—' }}</td>
            <td>{{ $c['date_ouverture'] ? \Carbon\Carbon::parse($c['date_ouverture'])->format('d/m/Y') : '—' }}</td>
            <td>{{ $c['date_fermeture'] ? \Carbon\Carbon::parse($c['date_fermeture'])->format('d/m/Y') : 'En cours' }}</td>
            <td>{{ $c['ont_paye'] }}</td>
            <td>{{ $c['en_retard'] }}</td>
            <td>{{ number_format($c['total_collecte'], 0, '.', ' ') }} FCFA</td>
            <td>
                @if($c['statut'] === 'ouvert')
                    <span class="badge badge-blue">Ouvert</span>
                @else
                    <span class="badge badge-green">Fermé</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
