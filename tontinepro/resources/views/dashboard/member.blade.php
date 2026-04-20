<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👋 Mon tableau de bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Résumé financier --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Total versé</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">
                        {{ number_format($totalPaid, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400">FCFA</span>
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-amber-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">En retard</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">
                        {{ number_format($totalLate, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400">FCFA</span>
                    </p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-indigo-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Mes tontines</p>
                    <p class="text-2xl font-bold text-gray-800 mt-1">{{ $tontines->count() }}</p>
                </div>
            </div>

            {{-- Mes tontines & position --}}
            @forelse ($tontines as $tontine)
                @php
                    $pivot         = $tontine->pivot;
                    $myOrder       = $pivot->beneficiary_order;
                    $totalMembers  = $tontine->members_count;
                    $activeCycle   = $tontine->cycles->whereNull('closed_at')->sortByDesc('cycle_number')->first();
                    $nextCycleNum  = $tontine->cycles->max('cycle_number') + 1;
                    $myPaidThisTontine = $paidPayments->filter(
                        fn($p) => $p->cycle->tontine_id === $tontine->id
                    );
                @endphp

                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $tontine->name }}</h3>
                            <p class="text-sm text-gray-400">
                                {{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA •
                                {{ ucfirst($tontine->frequency) }} •
                                {{ $totalMembers }} membres
                            </p>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-1 text-xs rounded-full font-medium
                                {{ $tontine->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                {{ ucfirst($tontine->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-0 divide-y sm:divide-y-0 sm:divide-x divide-gray-100">
                        {{-- Ma position --}}
                        <div class="p-5 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Ma position</p>
                            @if ($myOrder)
                                <p class="text-2xl font-bold text-indigo-600">{{ $myOrder }} / {{ $totalMembers }}</p>
                                <p class="text-xs text-gray-400 mt-1">Cagnotte : {{ number_format($tontine->pot_size, 0, ',', ' ') }} FCFA</p>
                            @else
                                <p class="text-gray-400 text-sm">Non définie</p>
                            @endif
                        </div>

                        {{-- Cycle en cours --}}
                        <div class="p-5 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Cycle en cours</p>
                            @if ($activeCycle)
                                <p class="text-lg font-bold text-gray-800">#{{ $activeCycle->cycle_number }}</p>
                                <p class="text-xs text-gray-400">Bénéf. : {{ $activeCycle->beneficiary->name ?? '?' }}</p>
                            @else
                                <p class="text-gray-400 text-sm">En attente d'ouverture</p>
                            @endif
                        </div>

                        {{-- Prochain versement --}}
                        <div class="p-5 text-center">
                            <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Prochain versement</p>
                            @if ($tontine->next_payment_date)
                                <p class="text-lg font-bold text-amber-600">
                                    {{ $tontine->next_payment_date->format('d/m/Y') }}
                                </p>
                                <p class="text-xs text-gray-400">Estimation</p>
                            @else
                                <p class="text-gray-400 text-sm">Non planifié</p>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white shadow-sm rounded-xl p-10 text-center text-gray-400">
                    Vous n'appartenez à aucune tontine pour le moment.
                </div>
            @endforelse

            {{-- Paiements en retard --}}
            @if ($latePayments->isNotEmpty())
                <div class="bg-amber-50 border border-amber-200 rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-amber-200">
                        <h3 class="font-semibold text-amber-800">Versements à régulariser</h3>
                        <p class="text-xs text-amber-600 mt-0.5">
                            Rapprochez-vous de votre organisateur pour régulariser votre situation.
                        </p>
                    </div>
                    <div class="divide-y divide-amber-100">
                        @foreach ($latePayments as $payment)
                            <div class="flex items-center justify-between px-6 py-3">
                                <div>
                                    <p class="text-sm font-medium text-amber-800">{{ $payment->cycle->tontine->name }}</p>
                                    <p class="text-xs text-amber-600">Cycle #{{ $payment->cycle->cycle_number }}</p>
                                </div>
                                <span class="text-sm font-semibold text-amber-700">
                                    {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Historique des paiements --}}
            @if ($paidPayments->isNotEmpty())
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-700">Historique de mes versements</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Tontine</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Cycle</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($paidPayments as $payment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 text-gray-700">{{ $payment->cycle->tontine->name }}</td>
                                        <td class="px-4 py-3 text-gray-600">#{{ $payment->cycle->cycle_number }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-800">
                                            {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                                        </td>
                                        <td class="px-4 py-3 text-gray-500">
                                            {{ $payment->paid_at?->format('d/m/Y') ?? '—' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700 font-medium">
                                                Payé
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
