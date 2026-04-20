<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $tontine->name }}
            </h2>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 text-sm font-medium rounded-full
                    {{ $tontine->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ ucfirst($tontine->status) }}
                </span>
                @can('update', $tontine)
                    <a href="{{ route('tontines.edit', $tontine) }}" class="text-sm text-indigo-600 hover:text-indigo-900 bg-indigo-50 px-3 py-1 rounded-md font-semibold">
                        Modifier
                    </a>
                @endcan
                <a href="{{ route('tontines.index') }}" class="text-sm text-gray-600 hover:text-gray-900">← Retour</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

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
            @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 rounded-lg p-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Infos générales --}}
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="p-6">
                    <h3 class="font-semibold text-gray-700 mb-4">Informations générales</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dt class="text-xs text-gray-500 uppercase tracking-wide">Montant / cycle</dt>
                            <dd class="mt-1 text-xl font-bold text-indigo-600">
                                {{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA
                            </dd>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dt class="text-xs text-gray-500 uppercase tracking-wide">Fréquence</dt>
                            <dd class="mt-1 text-xl font-bold text-gray-800">{{ ucfirst($tontine->frequency) }}</dd>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <dt class="text-xs text-gray-500 uppercase tracking-wide">Membres</dt>
                            <dd class="mt-1 text-xl font-bold text-gray-800">{{ $tontine->members->count() }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- ADMIN : Ouvrir un nouveau cycle --}}
            @can('create', \App\Models\Tontine::class)
                @if ($tontine->status === 'active' && !$activeCycle)
                    <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                        <div class="p-6">
                            <h3 class="font-semibold text-gray-700 mb-4">Ouvrir un nouveau cycle</h3>
                            <form method="POST" action="{{ route('tontines.cycles.store', $tontine) }}" class="flex items-end gap-4">
                                @csrf
                                <div class="flex-1">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Bénéficiaire du cycle</label>
                                    <select name="beneficiary_user_id"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                            required>
                                        <option value="">-- Choisir le bénéficiaire --</option>
                                        @foreach ($tontine->members->sortBy('pivot.beneficiary_order') as $member)
                                            <option value="{{ $member->id }}">
                                                #{{ $member->pivot->beneficiary_order }} — {{ $member->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <x-primary-button>Ouvrir le cycle</x-primary-button>
                            </form>
                        </div>
                    </div>
                @endif
            @endcan

            {{-- Cycle en cours --}}
            @if ($activeCycle)
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="font-semibold text-gray-700">
                                Cycle #{{ $activeCycle->cycle_number }} en cours
                            </h3>
                            <p class="text-sm text-gray-400">
                                Bénéficiaire : <strong>{{ $activeCycle->beneficiary->name }}</strong> •
                                Ouvert le {{ $activeCycle->opened_at?->format('d/m/Y') }}
                            </p>
                        </div>
                        @can('create', \App\Models\Tontine::class)
                            <form method="POST"
                                  action="{{ route('tontines.cycles.close', [$tontine, $activeCycle]) }}"
                                  onsubmit="return confirm('Clôturer ce cycle ? Les membres non-payés seront marqués en retard.')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-700 transition">
                                    Clôturer le cycle
                                </button>
                            </form>
                        @endcan
                    </div>

                    {{-- Tableau des paiements du cycle en cours --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Membre</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    @can('create', \App\Models\Payment::class)
                                        <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($tontine->members->sortBy('pivot.beneficiary_order') as $member)
                                    @php
                                        $payment = $activeCycle->payments->where('user_id', $member->id)->first();
                                    @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $member->name }}</td>
                                        <td class="px-4 py-3">
                                            @if ($payment && $payment->status === 'payé')
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-700 font-medium">✓ Payé</span>
                                            @elseif ($payment && $payment->status === 'en retard')
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-amber-100 text-amber-700 font-medium">⏳ À régulariser</span>
                                            @else
                                                <span class="px-2 py-0.5 text-xs rounded-full bg-gray-100 text-gray-500 font-medium">En attente</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">
                                            {{ $payment ? number_format($payment->amount, 0, ',', ' ').' FCFA' : '—' }}
                                        </td>
                                        <td class="px-4 py-3 text-gray-500">
                                            {{ $payment?->paid_at?->format('d/m/Y') ?? '—' }}
                                        </td>
                                        {{-- Colonne Action : Uniquement pour l'Organisateur --}}
                                        <td class="px-4 py-3 text-right">
                                            @if (Auth::user()->isAdmin())
                                                @if (!$payment || $payment->status !== 'payé')
                                                    <form method="POST" action="{{ route('tontines.cycles.payments.store', [$tontine, $activeCycle]) }}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-4 rounded-lg shadow-sm transition">
                                                            MARQUER PAYÉ
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-green-600 font-bold text-xs">✅ VALIDÉ</span>
                                                @endif
                                            @else
                                                <span class="text-gray-400 text-xs">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- Historique des cycles clôturés --}}
            @if ($closedCycles->isNotEmpty())
                <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-700">Cycles clôturés</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Cycle</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Bénéficiaire</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Ouvert le</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Clôturé le</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Payés / Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($closedCycles as $cycle)
                                    @php
                                        $paidCount = $cycle->payments->where('status', 'payé')->count();
                                        $total     = $tontine->members->count();
                                    @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 font-medium text-gray-800">#{{ $cycle->cycle_number }}</td>
                                        <td class="px-4 py-3 text-gray-700">{{ $cycle->beneficiary->name ?? '—' }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $cycle->opened_at?->format('d/m/Y') ?? '—' }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $cycle->closed_at?->format('d/m/Y') ?? '—' }}</td>
                                        <td class="px-4 py-3">
                                            <span class="{{ $paidCount === $total ? 'text-green-600' : 'text-amber-600' }} font-medium">
                                                {{ $paidCount }} / {{ $total }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            {{-- Membres --}}
            <div class="bg-white shadow-sm rounded-xl overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-700">Membres & ordre de bénéfice</h3>
                </div>
                @if ($tontine->members->isEmpty())
                    <div class="p-6 text-gray-400 text-sm text-center">Aucun membre.</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Ordre</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-500 uppercase tracking-wider">Rejoint le</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach ($tontine->members->sortBy('pivot.beneficiary_order') as $member)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">
                                            <span class="inline-flex items-center justify-center w-7 h-7 bg-indigo-100 text-indigo-700 rounded-full font-bold text-xs">
                                                {{ $member->pivot->beneficiary_order ?? '—' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $member->name }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $member->email }}</td>
                                        <td class="px-4 py-3 text-gray-500">
                                            {{ $member->pivot->joined_at ? \Carbon\Carbon::parse($member->pivot->joined_at)->format('d/m/Y') : '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
