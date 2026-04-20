<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗂️ Tableau de bord — Organisateur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="bg-green-50 border border-green-300 text-green-800 rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Statistiques globales --}}
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-indigo-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Tontines totales</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_tontines'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Tontines actives</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['active_tontines'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Membres inscrits</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_members'] }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-amber-500">
                    <p class="text-xs text-gray-500 uppercase tracking-wide">Paiements en attente</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['late_payments'] }}</p>
                </div>
            </div>

            {{-- Tontines --}}
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-700">Mes tontines</h3>
                    <a href="{{ route('tontines.create') }}"
                       class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                        + Nouvelle tontine
                    </a>
                </div>

                @if ($tontines->isEmpty())
                    <div class="p-8 text-center text-gray-400">Aucune tontine créée.</div>
                @else
                    <div class="divide-y divide-gray-50">
                        @foreach ($tontines as $tontine)
                            @php
                                $activeCycle = $tontine->cycles->first();
                            @endphp
                            <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 transition">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $tontine->name }}</p>
                                    <p class="text-sm text-gray-400">
                                        {{ $tontine->members_count }} membres •
                                        {{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA/cycle •
                                        {{ ucfirst($tontine->frequency) }}
                                    </p>
                                    @if ($activeCycle)
                                        <p class="text-xs text-indigo-600 mt-0.5">
                                            Cycle #{{ $activeCycle->cycle_number }} en cours —
                                            bénéficiaire : {{ $activeCycle->beneficiary->name ?? '?' }}
                                        </p>
                                    @endif
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="px-2 py-1 text-xs rounded-full font-medium
                                        {{ $tontine->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                        {{ ucfirst($tontine->status) }}
                                    </span>
                                    <a href="{{ route('tontines.show', $tontine) }}"
                                       class="text-sm text-indigo-600 hover:underline font-medium">Gérer →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Paiements en retard récents --}}
            @if ($latePayments->isNotEmpty())
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-700">⚠️ Paiements en attente récents</h3>
                </div>
                <div class="divide-y divide-gray-50">
                    @foreach ($latePayments as $payment)
                        <div class="flex items-center justify-between px-6 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-700">{{ $payment->user->name }}</p>
                                <p class="text-xs text-gray-400">
                                    {{ $payment->cycle->tontine->name }} —
                                    Cycle #{{ $payment->cycle->cycle_number }}
                                </p>
                            </div>
                            <span class="text-sm font-semibold text-amber-600">
                                {{ number_format($payment->amount, 0, ',', ' ') }} FCFA
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
