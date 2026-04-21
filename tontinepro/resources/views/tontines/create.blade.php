<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header personnalisé --}}
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-sage-dim tracking-tight">Nouvelle Tontine</h1>
                    <p class="text-gray-500 font-medium">Configurez votre nouveau groupe de cotisations.</p>
                </div>
                <a href="{{ route('tontines.index') }}" class="text-sm font-bold text-sage-dark hover:text-sage-dim flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour
                </a>
            </div>

            {{-- Message d'erreur global --}}
            @if ($errors->any())
                <div class="mb-8 bg-white border-l-4 border-red-500 text-red-700 rounded-r-2xl p-6 shadow-sm">
                    <p class="font-black mb-2 uppercase text-xs tracking-widest">⚠️ Erreurs de validation</p>
                    <ul class="list-disc list-inside text-sm font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-sage-light overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('tontines.store') }}" class="space-y-8">
                        @csrf

                        {{-- Nom de la tontine --}}
                        <div>
                            <label for="name" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Nom de la tontine</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 text-sage-dim font-bold placeholder-gray-300 transition-all"
                                :value="old('name')"
                                placeholder="Ex: Tontine des Amis 2026"
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Montant par cycle --}}
                            <div>
                                <label for="amount_per_cycle" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Montant (FCFA)</label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sage-dark font-bold">💰</span>
                                    <input
                                        id="amount_per_cycle"
                                        name="amount_per_cycle"
                                        type="number"
                                        class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 pl-12 text-sage-dim font-bold placeholder-gray-300 transition-all"
                                        :value="old('amount_per_cycle')"
                                        placeholder="Ex: 25000"
                                        required
                                    />
                                </div>
                                <x-input-error :messages="$errors->get('amount_per_cycle')" class="mt-2" />
                            </div>

                            {{-- Fréquence --}}
                            <div>
                                <label for="frequency" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Fréquence</label>
                                <select
                                    id="frequency"
                                    name="frequency"
                                    class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 text-sage-dim font-bold transition-all appearance-none"
                                    required
                                >
                                    <option value="">Choisir...</option>
                                    <option value="hebdomadaire" {{ old('frequency') === 'hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                                    <option value="mensuel" {{ old('frequency') === 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                                    <option value="bimestriel" {{ old('frequency') === 'bimestriel' ? 'selected' : '' }}>Bimestriel</option>
                                    <option value="trimestriel" {{ old('frequency') === 'trimestriel' ? 'selected' : '' }}>Trimestriel</option>
                                </select>
                                <x-input-error :messages="$errors->get('frequency')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Sélection des membres --}}
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Membres participants</label>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mb-4">
                                L'ordre de sélection définit l'ordre de bénéfice (qui passe en premier).
                            </p>

                            @if ($members->isEmpty())
                                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-6 text-center text-amber-700 text-sm font-medium">
                                    Aucun membre disponible. Créez des utilisateurs avec le rôle "member".
                                </div>
                            @else
                                <div class="bg-white-smoke-2 rounded-2xl p-2 max-h-64 overflow-y-auto space-y-1">
                                    @foreach ($members as $index => $member)
                                        <label class="flex items-center gap-4 p-3 hover:bg-white rounded-xl cursor-pointer transition-all group">
                                            <input
                                                type="checkbox"
                                                name="members[]"
                                                value="{{ $member->id }}"
                                                class="w-6 h-6 rounded-lg border-transparent bg-gray-200 text-sage-dark focus:ring-sage-dark shadow-sm"
                                                {{ in_array($member->id, old('members', [])) ? 'checked' : '' }}
                                            >
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-sage-light rounded-full flex items-center justify-center text-[10px] font-black text-sage-dim group-hover:scale-110 transition-transform">
                                                    {{ substr($member->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <p class="text-sm font-bold text-sage-dim">{{ $member->name }}</p>
                                                    <p class="text-[10px] text-gray-400 font-medium">{{ $member->email }}</p>
                                                </div>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('members')" class="mt-2" />
                            @endif
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                            <a href="{{ route('tontines.index') }}" class="text-sm font-bold text-gray-400 hover:text-sage-dim transition-colors">
                                Annuler
                            </a>
                            <button type="submit" class="bg-sage-dark hover:opacity-hover text-white font-black px-10 py-4 rounded-2xl transition shadow-lg shadow-sage-light">
                                Créer le groupe →
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
