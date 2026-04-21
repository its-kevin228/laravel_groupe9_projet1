<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header --}}
            <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-black text-sage-dim tracking-tight">Bonjour, {{ Auth::user()->name }}</h1>
                    <p class="text-gray-500 font-medium">Voici l'état global de vos tontines aujourd'hui.</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('tontines.create') }}" class="bg-sage-dark hover:opacity-hover text-white font-bold py-3 px-6 rounded-tix transition shadow-lg">
                        + Nouvelle Tontine
                    </a>
                </div>
            </div>

            {{-- Bento Grid Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-tix border border-tixtogo-border shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-sage-dark mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="building-2" class="w-6 h-6"></i>
                    </div>
                    <p class="text-tixtogo-muted text-[11px] font-bold uppercase tracking-widest">Total Tontines</p>
                    <p class="text-2xl font-black text-black leading-tight">{{ $stats['total_tontines'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-tix border border-tixtogo-border shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-sage-dark mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="zap" class="w-6 h-6"></i>
                    </div>
                    <p class="text-tixtogo-muted text-[11px] font-bold uppercase tracking-widest">Actives</p>
                    <p class="text-2xl font-black text-sage-dark leading-tight">{{ $stats['active_tontines'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-tix border border-tixtogo-border shadow-sm hover:shadow-md transition-all duration-300">
                    <div class="w-12 h-12 bg-sage-light/30 rounded-full flex items-center justify-center text-sage-dark mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <p class="text-tixtogo-muted text-[11px] font-bold uppercase tracking-widest">Membres Inscrits</p>
                    <p class="text-2xl font-black text-black leading-tight">{{ $stats['total_members'] }}</p>
                </div>
                <div class="bg-white p-6 rounded-tix border border-tixtogo-border shadow-sm hover:shadow-md transition-all duration-300 border-l-4 ">
                    <div class="w-12 h-12 bg-red-50 rounded-full flex items-center justify-center text-red-500 mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="alert-circle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-tixtogo-muted text-[11px] font-bold uppercase tracking-widest">Retards</p>
                    <p class="text-2xl font-black text-red-600 leading-tight">{{ $stats['late_payments'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Tontines Récentes --}}
                <div class="lg:col-span-2 space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-2">
                        <i data-lucide="history" class="w-5 h-5"></i>
                        Dernières activités
                    </h2>
                    @foreach($tontines->take(5) as $tontine)
                        <div class="bg-white p-6 rounded-tix border border-sage-light shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <h3 class="font-bold text-lg text-black">{{ $tontine->name }}</h3>
                                    <p class="text-xs text-gray-500 font-medium tracking-wider">{{ $tontine->members_count }} membres • {{ ucfirst($tontine->frequency) }}</p>
                                </div>
                                <a href="{{ route('tontines.show', $tontine) }}" class="p-2 bg-sage-light rounded-tix text-sage-dark hover:bg-sage-dark hover:text-white transition-colors">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            </div>
                            @php $active = $tontine->cycles->where('status', 'active')->first() ?? $tontine->cycles->first(); @endphp
                            @if($active)
                                <div class="bg-mint/50 p-4 rounded-tix flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        
                                        <div>
                                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Bénéficiaire Actuel</p>
                                            <p class="text-sm font-bold text-black">{{ $active->beneficiary->name ?? 'Non défini' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-500 font-bold uppercase tracking-widest">Pot</p>
                                        <p class="text-sm font-black text-black">{{ number_format($tontine->amount_per_cycle * $tontine->members_count, 0, ',', ' ') }} FCFA</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-xs italic text-gray-400">Aucun cycle ouvert</p>
                            @endif
                        </div>
                    @endforeach
                </div>

                {{-- Alertes Retards --}}
                <div class="space-y-6">
                    <h2 class="text-xl font-black text-sage-dim flex items-center gap-2">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        Alertes
                    </h2>
                    <div class="bg-white rounded-tix border border-sage-light overflow-hidden shadow-sm">
                        <div class="p-6 bg-red-50 border-b border-red-100">
                            <p class="font-bold text-red-800 text-sm">Retards de paiement</p>
                        </div>
                        <div class="divide-y divide-gray-50">
                            @forelse($latePayments as $payment)
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center text-xs font-bold text-red-700">
                                            {{ substr($payment->user->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-bold text-sage-dim">{{ $payment->user->name }}</p>
                                            <p class="text-[10px] text-gray-400 font-bold tracking-widest">{{ $payment->cycle->tontine->name }} • Cycle #{{ $payment->cycle->cycle_number }}</p>
                                        </div>
                                        <p class="text-sm font-black text-red-600">-{{ number_format($payment->amount, 0, ',', ' ') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="p-8 text-center text-gray-400 italic text-sm">
                                    Aucun retard détecté.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
