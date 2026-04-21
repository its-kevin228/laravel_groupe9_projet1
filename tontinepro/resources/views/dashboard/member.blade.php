<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-3xl font-black text-sage-dim tracking-tight">Espace Membre</h1>
                <p class="text-gray-500 font-medium">Suivez vos cotisations et vos gains à venir.</p>
            </div>

            {{-- Cartes de Score Personnelles --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-gradient-to-br from-sage-dark to-sage-dim p-8 rounded-[2.5rem] text-white shadow-xl shadow-sage-light/50 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                    <p class="text-sage-light text-xs font-bold uppercase tracking-widest mb-2">Total versé</p>
                    <p class="text-4xl font-black mb-4">{{ number_format($totalPaid, 0, ',', ' ') }} <span class="text-sm font-normal opacity-70">FCFA</span></p>
                    <div class="flex items-center gap-2 text-xs bg-white/20 w-fit px-3 py-1 rounded-full backdrop-blur-sm">
                        <span>💰 Épargne sécurisée</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-sage-light shadow-sm flex flex-col justify-center">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Paiements en retard</p>
                    <p class="text-3xl font-black {{ $totalLate > 0 ? 'text-red-500' : 'text-sage-dim' }}">
                        {{ number_format($totalLate, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400">FCFA</span>
                    </p>
                    @if($totalLate > 0)
                        <p class="mt-2 text-xs font-bold text-red-400 flex items-center gap-1">
                            ⚠️ À régulariser rapidement
                        </p>
                    @else
                        <p class="mt-2 text-xs font-bold text-green-500 flex items-center gap-1">
                            ✅ Vous êtes à jour
                        </p>
                    @endif
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] border border-sage-light shadow-sm flex flex-col justify-center">
                    <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Tontines rejointes</p>
                    <p class="text-3xl font-black text-sage-dim">{{ $tontines->count() }}</p>
                    <p class="mt-2 text-xs font-bold text-sage-dark">Membre actif</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Mes Tontines Actives --}}
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-2">
                        🌟 Mes Tontines en cours
                    </h2>
                    @forelse($tontines as $tontine)
                        <div class="bg-white p-6 rounded-3xl border border-sage-light shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-sage-light rounded-2xl flex items-center justify-center text-2xl">🏦</div>
                                    <div>
                                        <h3 class="font-bold text-lg text-sage-dim">{{ $tontine->name }}</h3>
                                        <p class="text-xs text-gray-400">Position : #{{ $tontine->pivot->beneficiary_order }} sur {{ $tontine->members_count }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Votre gain futur</p>
                                    <p class="text-lg font-black text-sage-dark">{{ number_format($tontine->pot_size, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>

                            @php 
                                $activeCycle = $tontine->cycles->whereNull('closed_at')->first();
                                $hasPaid = $activeCycle ? $activeCycle->payments->where('user_id', Auth::id())->where('status', 'payé')->count() : false;
                            @endphp

                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pt-4 border-t border-gray-50">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold {{ $hasPaid ? 'text-green-600' : 'text-amber-600' }}">
                                        {{ $hasPaid ? '✅ Cotisation réglée' : '⏳ En attente de cotisation' }}
                                    </span>
                                </div>
                                <a href="{{ route('tontines.show', $tontine) }}" class="text-sm font-bold text-sage-dark hover:underline">
                                    Détails du cycle →
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-3xl border border-dashed border-sage-light text-center">
                            <p class="text-gray-400">Vous n'avez rejoint aucune tontine pour le moment.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Historique récent --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-2">
                        📜 Historique
                    </h2>
                    <div class="bg-white rounded-3xl border border-sage-light overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-gray-50">
                            <p class="font-bold text-sage-dim text-sm">Derniers versements</p>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @forelse($paidPayments->take(5) as $payment)
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center text-xs">💸</div>
                                            <div>
                                                <p class="text-xs font-bold text-sage-dim">{{ $payment->cycle->tontine->name }}</p>
                                                <p class="text-[10px] text-gray-400">Cycle #{{ $payment->cycle->cycle_number }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-black text-green-600">+ {{ number_format($payment->amount, 0, ',', ' ') }}</p>
                                            <p class="text-[9px] text-gray-400">{{ $payment->paid_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="p-8 text-center text-gray-400 text-xs italic">Aucun versement effectué.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
