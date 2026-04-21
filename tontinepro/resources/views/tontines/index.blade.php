<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat" x-data="{ view: 'grid' }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header de section --}}
            <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-3xl font-black text-black tracking-tight tracking-tight">Vos Groupes</h1>
                    <p class="text-gray-500 font-medium tracking-tight">Gérez vos cotisations et suivez vos cycles en un coup d'œil.</p>
                </div>

                <div class="flex items-center bg-white border border-tixtogo-border rounded-tix p-1 shadow-sm shrink-0">
                    <button @click="view = 'grid'" :class="view === 'grid' ? 'bg-sage-light text-sage-dark' : 'text-gray-400 hover:text-sage-dark'" class="px-4 py-2 transition-all duration-200 rounded-[3px] flex items-center gap-2 text-[13px] font-bold uppercase tracking-wider">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i>
                        Grille
                    </button>
                    <button @click="view = 'list'" :class="view === 'list' ? 'bg-sage-light text-sage-dark' : 'text-gray-400 hover:text-sage-dark'" class="px-4 py-2 transition-all duration-200 rounded-[3px] flex items-center gap-2 text-[13px] font-bold uppercase tracking-wider">
                        <i data-lucide="list" class="w-4 h-4"></i>
                        Tableau
                    </button>
                </div>
            </div>

            @if (session('success'))
                <div class="mb-8 bg-white border-l-4 border-sage-dark text-sage-dim rounded-r-lg p-4 shadow-sm flex items-center gap-3">
                    <div class="w-8 h-8 bg-sage-light rounded-full flex items-center justify-center text-sage-dark">
                        <i data-lucide="check" class="w-5 h-5"></i>
                    </div>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            @if ($tontines->isEmpty())
                <div class="bg-white rounded-2xl border border-sage-light p-20 text-center shadow-sm">
                    <div class="w-20 h-20 bg-mint rounded-full flex items-center justify-center mx-auto mb-6 text-sage-light">
                        <i data-lucide="landmark" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-xl font-bold text-sage-dim mb-2">Aucune tontine active</h3>
                    <p class="text-gray-400 mb-8 max-w-sm mx-auto">Prêt à commencer l'aventure ? Créez votre première tontine.</p>
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('tontines.create') }}" class="inline-flex items-center gap-2 bg-sage-dark hover:bg-sage-dim text-white font-bold py-3 px-8 rounded-lg transition-colors">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                            <span>Lancer ma première tontine</span>
                        </a>
                    @endif
                </div>
            @else
                {{-- Vue Grille --}}
                <div x-show="view === 'grid'" x-transition class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tontines as $tontine)
                        <div class="group bg-white rounded-tix border border-tixtogo-border hover:shadow-[0_4px_12px_rgba(0,0,0,0.08)] transition-all duration-300 relative overflow-hidden flex flex-col">
                            {{-- Header style TixTogo --}}
                            <div class="h-1.5 w-full bg-sage-dark/20 group-hover:bg-sage-dark transition-colors"></div>
                            
                            <div class="p-5 flex-grow">
                                <div class="flex items-start justify-between mb-4">
                                    <h3 class="text-[18px] font-bold text-black leading-tight line-clamp-2 min-h-[44px] group-hover:text-sage-dark transition-colors tracking-tight">
                                        {{ $tontine->name }}
                                    </h3>
                                    <span class="shrink-0 px-2 py-1 text-[11px] font-bold uppercase tracking-wider rounded-[3px] {{ $tontine->status === 'active' ? 'bg-[#E8F7F7] text-sage-dark' : 'bg-gray-100 text-gray-500' }}">
                                        {{ $tontine->status }}
                                    </span>
                                </div>
                                
                                <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-tixtogo-muted text-[13px]">
                                        <i data-lucide="banknote" class="w-4 h-4"></i>
                                        <span class="font-medium">Mise : <span class="text-black font-bold">{{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA</span></span>
                                    </div>
                                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-tixtogo-border">
                                        <div class="flex items-center gap-2 text-tixtogo-muted text-[12px]">
                                            <i data-lucide="calendar" class="w-4 h-4"></i>
                                            <span>{{ ucfirst($tontine->frequency) }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-tixtogo-muted text-[12px]">
                                            <i data-lucide="users" class="w-4 h-4"></i>
                                            <span>{{ $tontine->members_count }} membres</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer Card style TixTogo --}}
                            <div class="bg-[#6AC045]/[0.03] p-4 flex justify-between items-center border-t border-tixtogo-border mt-auto">
                                <span class="text-[12px] font-bold text-sage-dim uppercase tracking-wider">Détails du groupe</span>
                                <a href="{{ route('tontines.show', $tontine) }}" class="w-10 h-10 bg-sage-dark text-white rounded-full flex items-center justify-center hover:scale-110 transition-transform shadow-sm">
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Vue Tableau --}}
                <div x-show="view === 'list'" x-transition class="bg-white rounded-tix border border-tixtogo-border overflow-hidden shadow-sm">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 border-b border-tixtogo-border">
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Nom du Groupe</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Statut</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted text-right">Mise</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Fréquence</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Membres</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-tixtogo-border">
                            @foreach ($tontines as $tontine)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-black">{{ $tontine->name }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-[3px] {{ $tontine->status === 'active' ? 'bg-[#E8F7F7] text-sage-dark' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $tontine->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <p class="font-black text-black">{{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA</p>
                                    </td>
                                    <td class="px-6 py-4 text-tixtogo-muted text-sm">{{ ucfirst($tontine->frequency) }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1.5 text-black font-bold">
                                            <i data-lucide="users" class="w-4 h-4 text-tixtogo-muted"></i>
                                            {{ $tontine->members_count }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="{{ route('tontines.show', $tontine) }}" class="inline-flex items-center gap-2 text-[12px] font-bold text-sage-dark hover:text-sage-dim transition-colors">
                                            <span>VOIR PLUS</span>
                                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-12">
                    {{ $tontines->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>