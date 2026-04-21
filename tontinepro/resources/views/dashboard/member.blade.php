<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-10">
                <h1 class="text-3xl font-black text-sage-dim tracking-tight">Espace Membre</h1>
                <p class="text-gray-400 font-medium">Suivez vos cotisations et vos gains à venir.</p>
            </div>

            {{-- Cartes de Score Personnelles --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-tix border border-tixtogo-border shadow-sm flex flex-col justify-center group hover:border-sage-dark transition-colors">
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-2 flex items-center gap-2">
                        
                        Total versé
                    </p>
                    <p class="text-3xl font-black text-black tracking-tighter">
                        {{ number_format($totalPaid, 0, ',', ' ') }} <span class="text-sm font-bold text-gray-300">FCFA</span>
                    </p>
                    <div class="mt-3 flex items-center gap-1.5 text-[9px] font-black uppercase tracking-[0.15em] text-sage-dark/60">
                        
                        <span>Épargne sécurisée</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-tix border border-tixtogo-border shadow-sm flex flex-col justify-center">
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-2">Paiements en retard</p>
                    <p class="text-3xl font-black {{ $totalLate > 0 ? 'text-red-500' : 'text-black' }}">
                        {{ number_format($totalLate, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400 font-bold">FCFA</span>
                    </p>
                    @if($totalLate > 0)
                        <p class="mt-2 text-[10px] font-black uppercase tracking-widest text-red-500 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i>
                            À régulariser
                        </p>
                    @else
                        <p class="mt-2 text-[10px] font-black uppercase tracking-widest text-sage-dark flex items-center gap-1">
                            <i data-lucide="check-circle" class="w-3 h-3"></i>
                            Vous êtes à jour
                        </p>
                    @endif
                </div>

                <div class="bg-white p-8 rounded-tix border border-tixtogo-border shadow-sm flex flex-col justify-center">
                    <p class="text-gray-400 text-[10px] font-black uppercase tracking-widest mb-2">Tontines rejointes</p>
                    <p class="text-3xl font-black text-black">{{ $tontines->count() }}</p>
                    <p class="mt-2 text-[10px] font-black uppercase tracking-widest text-sage-dark flex items-center gap-1">
                        <i data-lucide="users" class="w-3 h-3"></i>
                        Membre actif
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Mes Tontines Actives --}}
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-3 uppercase tracking-tighter">
                        
                        Mes Tontines en cours
                    </h2>
                    @forelse($tontines as $tontine)
                        <div class="bg-white p-6 rounded-tix border border-tixtogo-border shadow-sm hover:border-sage-dark transition-colors group">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-tix flex items-center justify-center text-sage-dark">
                                        <i data-lucide="building" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-black text-lg text-black uppercase tracking-tight">{{ $tontine->name }}</h3>
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Position : #{{ $tontine->pivot->beneficiary_order }} sur {{ $tontine->members_count }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Gain futur</p>
                                    <p class="text-xl font-black text-sage-dark">{{ number_format($tontine->pot_size, 0, ',', ' ') }} FCFA</p>
                                </div>
                            </div>

                            @php 
                                $activeCycle = $tontine->cycles->whereNull('closed_at')->first();
                                $hasPaid = $activeCycle ? $activeCycle->payments->where('user_id', Auth::id())->where('status', 'payé')->count() : false;
                            @endphp

                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 pt-4 border-t border-tixtogo-border/50">
                                <div class="flex items-center">
                                    <span class="text-[10px] font-black uppercase tracking-[0.15em] {{ $hasPaid ? 'text-sage-dark' : 'text-amber-600' }}">
                                        {{ $hasPaid ? 'Cotisation réglée' : 'En attente' }}
                                    </span>
                                </div>
                                <a href="{{ route('tontines.show', $tontine) }}" class="inline-flex items-center gap-2 text-[11px] font-black text-sage-dark hover:opacity-hover uppercase tracking-widest transition-opacity">
                                    <span>Détails du cycle</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-12 rounded-tix border border-dashed border-tixtogo-border text-center grayscale opacity-60">
                            <i data-lucide="inbox" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Aucune tontine rejointe</p>
                        </div>
                    @endforelse
                </div>

                {{-- Historique récent --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-3 uppercase tracking-tighter">
                        <i data-lucide="history" class="w-6 h-6 text-sage-dark"></i>
                        Historique
                    </h2>
                    <div class="bg-white rounded-tix border border-tixtogo-border overflow-hidden shadow-sm">
                        <div class="p-6 border-b border-tixtogo-border bg-gray-50/50">
                            <p class="font-black text-black text-[11px] uppercase tracking-widest">Derniers versements</p>
                        </div>
                        <div class="divide-y divide-tixtogo-border">
                            @forelse($paidPayments->take(5) as $payment)
                                <div class="p-4 hover:bg-gray-50 transition-colors group">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-mint rounded-tix flex items-center justify-center text-sage-dark">
                                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                                            </div>
                                            <div>
                                                <p class="text-[11px] font-black text-black uppercase tracking-tight">{{ $payment->cycle->tontine->name }}</p>
                                                <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Cycle #{{ $payment->cycle->cycle_number }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-black text-sage-dark">+{{ number_format($payment->amount, 0, ',', ' ') }}</p>
                                            <p class="text-[9px] text-gray-400 font-bold uppercase">{{ $payment->paid_at->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center">
                                    <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px] italic">Aucun versement</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
