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

            {{-- Header Gestion Utilisateurs --}}
            <div class="bg-white rounded-tix p-8 shadow-sm border border-tixtogo-border mb-8 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03]">
                    <img src="{{ asset('images/logo/tontinebg.png') }}" class="w-64 rotate-12">
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-3xl font-black text-sage-dim uppercase tracking-tight">Utilisateurs</h2>
                            <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-[3px] bg-sage-light text-sage-dim">
                                Total : {{ $users->total() }}
                            </span>
                        </div>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-[11px]">
                            Gérez les rôles, les permissions et surveillez l'activité des membres de la plateforme
                        </p>
                    </div>
                </div>
            </div>

            {{-- Table des Utilisateurs --}}
            <div class="bg-white rounded-tix border border-tixtogo-border shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-tixtogo-border">
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Utilisateur</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Rôle</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Tontines</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted">Inscription</th>
                                <th class="px-6 py-4 text-[11px] font-black uppercase tracking-widest text-tixtogo-muted text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-tixtogo-border">
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-tix bg-sage-light/30 flex items-center justify-center text-sage-dark border border-sage-light">
                                                <i data-lucide="user" class="w-5 h-5"></i>
                                            </div>
                                            <div>
                                                <p class="font-bold text-black">{{ $user->name }}</p>
                                                <p class="text-[10px] text-gray-400 font-medium">{{ $user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded-[3px] {{ $user->role === 'admin' ? 'bg-sage-dark text-white' : 'bg-gray-100 text-gray-500' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1.5">
                                            @forelse($user->tontines as $tontine)
                                                <span class="px-2 py-0.5 text-[10px] font-bold bg-mint border border-sage-light text-sage-dim rounded-[3px]">
                                                    {{ $tontine->name }}
                                                </span>
                                            @empty
                                                <span class="text-[10px] text-gray-400 font-medium italic">Aucune tontine</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-xs text-gray-500 font-bold uppercase tracking-widest">
                                            {{ $user->created_at->format('d/m/Y') }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.toggle-role', $user) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 text-sage-dark hover:bg-sage-light rounded-tix transition-colors" title="{{ $user->role === 'admin' ? 'Passer Membre' : 'Passer Admin' }}">
                                                        <i data-lucide="{{ $user->role === 'admin' ? 'user-minus' : 'shield-check' }}" class="w-5 h-5"></i>
                                                    </button>
                                                </form>
                                                
                                                <form action="{{ route('users.toggle-ban', $user) }}" method="POST" class="inline">
                                                    @csrf @method('PATCH')
                                                    <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-tix transition-colors" title="Bannir (Prochainement)">
                                                        <i data-lucide="slash" class="w-5 h-5"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest px-3">Vous</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-8">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
