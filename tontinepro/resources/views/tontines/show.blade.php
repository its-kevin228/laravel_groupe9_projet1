<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="mb-8 bg-white border-l-4 border-sage-dark text-sage-dim rounded-r-lg p-4 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 bg-sage-light rounded-full flex items-center justify-center text-sage-dark">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Header de la Tontine --}}
            <div class="bg-white rounded-tix p-8 shadow-sm border border-tixtogo-border mb-8 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03]">
                    <img src="{{ asset('images/logo/tontinebg.png') }}" class="w-64 rotate-12">
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-3xl font-black text-sage-dim uppercase tracking-tight">{{ $tontine->name }}</h2>
                            <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-[3px] bg-sage-light text-sage-dim">
                                {{ $tontine->status }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-6 text-sm font-bold text-gray-500 uppercase tracking-widest text-[11px]">
                            <span class="flex items-center gap-2">
                                <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                                Créée le {{ $tontine->created_at->format('d/m/Y') }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="refresh-cw" class="w-4 h-4 text-gray-400"></i>
                                {{ ucfirst($tontine->frequency) }}
                            </span>
                            <span class="flex items-center gap-2">
                                <i data-lucide="users" class="w-4 h-4 text-gray-400"></i>
                                {{ $tontine->members->count() }} membres
                            </span>
                        </div>
                    </div>
                    
                    @if (auth()->user()->isAdmin())
                        <div class="flex gap-3">
                            {{-- Actions de Cycle --}}
                            @if ($activeCycle && !$activeCycle->closed_at)
                                <form action="{{ route('tontines.cycles.close', [$tontine, $activeCycle]) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="bg-sage-dark hover:opacity-hover text-white px-6 py-3 rounded-tix font-bold text-xs uppercase tracking-widest transition shadow-sm flex items-center gap-2">
                                        <i data-lucide="lock" class="w-4 h-4"></i>
                                        Clôturer Cycle #{{ $activeCycle->cycle_number }}
                                    </button>
                                </form>
                            @elseif (!$activeCycle || ($activeCycle && $activeCycle->closed_at && $tontine->status === 'active'))
                                @php
                                    $nextOrder = ($activeCycle ? $activeCycle->beneficiary->pivot->beneficiary_order : 0) + 1;
                                    $nextBeneficiary = $tontine->members()->where('beneficiary_order', $nextOrder)->first();
                                @endphp
                                @if ($nextBeneficiary)
                                    <form action="{{ route('tontines.cycles.store', $tontine) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="beneficiary_user_id" value="{{ $nextBeneficiary->id }}">
                                        <button type="submit" class="bg-sage-dark hover:opacity-hover text-white px-6 py-3 rounded-tix font-bold text-xs uppercase tracking-widest transition shadow-sm flex items-center gap-2">
                                            <i data-lucide="play" class="w-4 h-4"></i>
                                            Ouvrir Cycle #{{ ($activeCycle?->cycle_number ?? 0) + 1 }}
                                        </button>
                                    </form>
                                @endif
                            @endif

                            <a href="{{ route('tontines.edit', $tontine) }}" class="bg-white border border-sage-dark text-sage-dark hover:opacity-hover px-6 py-3 rounded-tix font-bold text-xs uppercase tracking-widest transition flex items-center gap-2">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                                Modifier
                            </a>
                            
                            <a href="{{ route('tontines.export-pdf', $tontine) }}" class="bg-white border border-red-500 text-red-500 hover:opacity-hover px-6 py-3 rounded-tix font-bold text-xs uppercase tracking-widest transition flex items-center gap-2">
                                <i data-lucide="file-text" class="w-4 h-4"></i>
                                Rapport PDF
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            @if ($activeCycle)
                {{-- SECTION : FOCUS BÉNÉFICIAIRE --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                    <div class="lg:col-span-2 bg-white rounded-tix p-8 border border-tixtogo-border shadow-sm flex flex-col justify-center relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-mint opacity-20 rounded-bl-full"></div>
                        
                        <div class="relative z-10">
                            <h3 class="text-tixtogo-muted font-bold text-[11px] uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                                
                                Bénéficiaire du cycle #{{ $activeCycle->cycle_number }}
                            </h3>
                            <div class="flex items-center gap-8">
                                <div class="w-20 h-20 bg-gray-50 border border-tixtogo-border rounded-tix flex items-center justify-center text-sage-dark shadow-sm">
                                    <i data-lucide="user" class="w-10 h-10"></i>
                                </div>
                                <div>
                                    <p class="text-2xl font-black text-black mb-2 tracking-tight">{{ $activeCycle->beneficiary->name }}</p>
                                    <p class="text-gray-500 font-medium">Reçoit la cagnotte de <span class="text-sage-dark font-black">{{ number_format($tontine->amount_per_cycle * $tontine->members->count(), 0, ',', ' ') }} FCFA</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CARTE STATS --}}
                    <div class="bg-white rounded-tix p-8 shadow-sm border border-tixtogo-border flex flex-col justify-center">
                        <p class="text-tixtogo-muted text-[11px] font-bold uppercase tracking-[0.2em] mb-4 flex items-center gap-2">
                            <i data-lucide="trending-up" class="w-4 h-4 text-sage-dark"></i>
                            Progression
                        </p>
                        @php
                            $paidCount = $activeCycle->payments->where('status', 'payé')->count();
                            $totalCount = $tontine->members->count();
                            $percentage = ($totalCount > 0) ? ($paidCount / $totalCount) * 100 : 0;
                        @endphp
                        <p class="text-3xl font-black text-black mb-6">{{ number_format($paidCount * $tontine->amount_per_cycle, 0, ',', ' ') }} <span class="text-sm font-normal text-gray-400">/ {{ number_format($totalCount * $tontine->amount_per_cycle, 0, ',', ' ') }} FCFA</span></p>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-sage-dark h-full transition-all duration-1000 ease-out" style="width: {{ $percentage }}%"></div>
                        </div>
                        <p class="mt-4 text-xs font-bold text-sage-dark flex justify-between uppercase tracking-wider">
                            <span>Cotisations</span>
                            <span>{{ $paidCount }} / {{ $totalCount }} membres</span>
                        </p>
                    </div>
                </div>

                {{-- TABLEAU DE PAIEMENTS --}}
                <div class="bg-white rounded-tix shadow-sm border border-tixtogo-border overflow-hidden">
                    <div class="px-8 py-6 border-b border-tixtogo-border flex items-center justify-between bg-gray-50/50">
                        <h3 class="font-black text-xs uppercase tracking-[0.2em] text-black">État des cotisations - Cycle #{{ $activeCycle->cycle_number }}</h3>
                        <div class="flex items-center gap-2 text-[11px] font-bold text-tixtogo-muted uppercase tracking-widest">
                            <i data-lucide="clock-arrow-up" class="w-4 h-4"></i>
                            Fin : {{ $activeCycle->end_date?->format('d M Y') ?? 'Non définie' }}
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 text-tixtogo-muted text-[11px] font-black uppercase tracking-widest border-b border-tixtogo-border">
                                <tr>
                                    <th class="px-8 py-5">Membre</th>
                                    <th class="px-4 py-5">Statut</th>
                                    <th class="px-4 py-5">Montant</th>
                                    @if(Auth::user()->isAdmin())
                                        <th class="px-8 py-5 text-right">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-tixtogo-border">
                                @foreach ($tontine->members as $member)
                                    @php
                                        $payment = $activeCycle->payments->where('user_id', $member->id)->first();
                                    @endphp
                                    <tr class="hover:bg-mint/30 transition-colors">
                                        <td class="px-8 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 bg-sage-light/30 border border-tixtogo-border rounded-tix flex items-center justify-center text-sage-dark font-black">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="font-bold text-black">{{ $member->name }}</p>
                                                    <p class="text-[11px] text-tixtogo-muted font-medium">{{ $member->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-5">
                                            @if ($payment && $payment->status === 'payé')
                                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-wider rounded-[3px] bg-[#E8F7F7] text-sage-dark">
                                                    <i data-lucide="check" class="w-3 h-3 inline mr-1"></i> PAYÉ
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-[10px] font-black uppercase tracking-wider rounded-[3px] bg-red-50 text-red-500">
                                                    EN ATTENTE
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-5 font-black text-black">
                                            {{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} <span class="text-[10px] text-tixtogo-muted">FCFA</span>
                                        </td>
                                        @if(Auth::user()->isAdmin())
                                            <td class="px-8 py-5 text-right">
                                                @if (!$payment || $payment->status !== 'payé')
                                                    <form method="POST" action="{{ route('tontines.cycles.payments.store', [$tontine, $activeCycle]) }}">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                        <button type="submit" class="bg-sage-dark hover:opacity-90 text-white text-[10px] font-black uppercase tracking-widest py-2.5 px-5 rounded-tix shadow-sm transition">
                                                            Valider le paiement
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-sage-dark text-lg">✨</span>
                                                @endif
                                            </td>
                                        @endif
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
