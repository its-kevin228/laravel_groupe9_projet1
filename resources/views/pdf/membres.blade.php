@extends('pdf.layout')
@section('titre', 'Liste des membres — ' . $tontine->nom)

@section('content')
<div class="info-row"><span class="info-label">Tontine :</span> {{ $tontine->nom }}</div>
<div class="info-row"><span class="info-label">Statut :</span> {{ ucfirst($tontine->statut) }}</div>
<div class="info-row"><span class="info-label">Fréquence :</span> {{ ucfirst($tontine->frequence) }}</div>
<div class="info-row"><span class="info-label">Cotisation :</span> {{ number_format($tontine->montant_cotisation, 0, '.', ' ') }} FCFA</div>
<div class="info-row"><span class="info-label">Total membres :</span> {{ $membres->count() }}</div>

<div class="section-title">Liste des membres</div>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Nom complet</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Ordre</th>
            <th>Date adhésion</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        @foreach($membres as $i => $membre)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $membre->full_name }}</td>
            <td>{{ $membre->phone }}</td>
            <td>{{ $membre->email }}</td>
            <td>{{ $membre->ordre_passage ?? '—' }}</td>
            <td>{{ $membre->date_adhesion ? \Carbon\Carbon::parse($membre->date_adhesion)->format('d/m/Y') : '—' }}</td>
            <td>
                @if($membre->exclu_at)
                    <span class="badge badge-red">Exclu</span>
                @else
                    <span class="badge badge-green">Actif</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
