<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header personnalisé --}}
            <div class="mb-10 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-black text-sage-dim tracking-tight">Modifier : {{ $tontine->name }}</h1>
                    <p class="text-gray-500 font-medium">Mettez à jour les paramètres de votre tontine.</p>
                </div>
                <a href="{{ route('tontines.show', $tontine) }}" class="text-sm font-bold text-sage-dark hover:text-sage-dim flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Retour aux détails
                </a>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-sage-light overflow-hidden">
                <div class="p-10">
                    <form method="POST" action="{{ route('tontines.update', $tontine) }}" class="space-y-8">
                        @csrf
                        @method('PATCH')

                        {{-- Nom de la tontine --}}
                        <div>
                            <label for="name" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Nom de la tontine</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 text-sage-dim font-bold transition-all"
                                value="{{ old('name', $tontine->name) }}"
                                required
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Montant par cycle --}}
                            <div>
                                <label for="amount_per_cycle" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Montant (FCFA)</label>
                                <input
                                    id="amount_per_cycle"
                                    name="amount_per_cycle"
                                    type="number"
                                    class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 text-sage-dim font-bold transition-all"
                                    value="{{ old('amount_per_cycle', (int)$tontine->amount_per_cycle) }}"
                                    required
                                />
                                <x-input-error :messages="$errors->get('amount_per_cycle')" class="mt-2" />
                            </div>

                            {{-- Statut --}}
                            <div>
                                <label for="status" class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Statut</label>
                                <select
                                    id="status"
                                    name="status"
                                    class="w-full bg-white-smoke-2 border-transparent focus:border-sage-dark focus:ring-0 rounded-2xl p-4 text-sage-dim font-bold transition-all appearance-none"
                                    required
                                >
                                    <option value="active" {{ old('status', $tontine->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="clôturée" {{ old('status', $tontine->status) === 'clôturée' ? 'selected' : '' }}>Clôturée</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
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
                                @foreach(['hebdomadaire', 'mensuel', 'bimestriel', 'trimestriel'] as $freq)
                                    <option value="{{ $freq }}" {{ old('frequency', $tontine->frequency) === $freq ? 'selected' : '' }}>
                                        {{ ucfirst($freq) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('frequency')" class="mt-2" />
                        </div>

                        {{-- Sélection des membres --}}
                        <div>
                            <label class="block text-xs font-black uppercase tracking-widest text-sage-dim mb-2">Membres & Ordre</label>
                            <div class="bg-white-smoke-2 rounded-2xl p-2 max-h-64 overflow-y-auto space-y-1">
                                @foreach ($members as $member)
                                    <label class="flex items-center gap-4 p-3 hover:bg-white rounded-xl cursor-pointer transition-all group">
                                        <input
                                            type="checkbox"
                                            name="members[]"
                                            value="{{ $member->id }}"
                                            class="w-6 h-6 rounded-lg border-transparent bg-gray-200 text-sage-dark focus:ring-sage-dark shadow-sm"
                                            {{ in_array($member->id, old('members', $selectedMemberIds)) ? 'checked' : '' }}
                                        >
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 bg-sage-light rounded-full flex items-center justify-center text-[10px] font-black text-sage-dim">
                                                {{ substr($member->name, 0, 1) }}
                                            </div>
                                            <p class="text-sm font-bold text-sage-dim">{{ $member->name }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('members')" class="mt-2" />
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-50">
                            <a href="{{ route('tontines.show', $tontine) }}" class="text-sm font-bold text-gray-400 hover:text-sage-dim transition-colors">
                                Annuler
                            </a>
                            <button type="submit" class="bg-sage-dark hover:opacity-hover text-white font-black px-10 py-4 rounded-2xl transition shadow-lg shadow-sage-light">
                                Enregistrer →
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Zone de danger --}}
            <div class="mt-12 bg-red-50 border border-red-100 rounded-[2.5rem] p-10">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm">🗑️</div>
                    <div class="flex-1">
                        <h3 class="text-red-900 font-black uppercase text-xs tracking-widest mb-1">Zone de danger</h3>
                        <p class="text-red-600 text-sm font-medium mb-6">La suppression est irréversible. Toutes les données liées seront perdues.</p>
                        <form method="POST" action="{{ route('tontines.destroy', $tontine) }}" onsubmit="return confirm('Supprimer définitivement ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-black text-[10px] uppercase tracking-widest px-6 py-3 rounded-xl transition">
                                Supprimer la tontine
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
