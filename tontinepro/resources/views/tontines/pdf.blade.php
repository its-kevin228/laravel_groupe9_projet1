<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapport de Tontine - {{ $tontine->name }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #57a175; padding-bottom: 10px; }
        .section-title { background: #def7e5; color: #2e5c46; padding: 5px 10px; font-weight: bold; margin-top: 20px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; color: #777; }
        .text-right { text-align: right; }
        .badge { padding: 3px 6px; border-radius: 3px; font-size: 10px; font-weight: bold; }
        .bg-success { background: #dcfce7; color: #166534; }
        .bg-danger { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $tontine->name }}</h1>
        <p>Rapport généré le {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Informations Générales -->
    <div class="section-title">Informations Générales</div>
    <table>
        <tr>
            <th>Type</th>
            <td>{{ ucfirst($tontine->type) }}</td>
            <th>Fréquence</th>
            <td>{{ ucfirst($tontine->frequency) }}</td>
        </tr>
        <tr>
            <th>Montant Cotisation</th>
            <td>{{ number_format($tontine->amount, 0, ',', ' ') }} FCFA</td>
            <th>Créateur</th>
            <td>{{ $tontine->creator->name }}</td>
        </tr>
    </table>

    <!-- Liste des Membres -->
    <div class="section-title">Liste des Membres ({{ $tontine->users->count() }})</div>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Date d'adhésion</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tontine->users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->pivot->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- État du Cycle Actuel -->
    @if($tontine->activeCycle)
    <div class="section-title">Cycle Actuel : {{ $tontine->activeCycle->number }}</div>
    <p>Lancé le : {{ $tontine->activeCycle->start_date->format('d/m/Y') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Membre</th>
                <th>Montant</th>
                <th>Date de paiement</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tontine->users as $user)
                @php
                    $payment = $tontine->activeCycle->payments->where('user_id', $user->id)->first();
                @endphp
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ number_format($tontine->amount, 0, ',', ' ') }} FCFA</td>
                    <td>{{ $payment ? $payment->payment_date->format('d/m/Y H:i') : '-' }}</td>
                    <td>
                        <span class="badge {{ $payment ? 'bg-success' : 'bg-danger' }}">
                            {{ $payment ? 'Payé' : 'En attente' }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <!-- Historique des Cycles -->
    <div class="section-title">Historique des Cycles</div>
    <table>
        <thead>
            <tr>
                <th>Cycle N°</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Statut</th>
                <th>Recolte Totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tontine->cycles()->orderBy('number', 'desc')->get() as $cycle)
            <tr>
                <td>{{ $cycle->number }}</td>
                <td>{{ $cycle->start_date->format('d/m/Y') }}</td>
                <td>{{ $cycle->end_date ? $cycle->end_date->format('d/m/Y') : 'En cours' }}</td>
                <td>{{ $cycle->status }}</td>
                <td>{{ number_format($cycle->payments->sum('amount'), 0, ',', ' ') }} FCFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Document généré par TontinePro - Solution de gestion transparente des tontines.
    </div>
</body>
</html>
