<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Modifier la Tontine') }} : {{ $tontine->name }}
            </h2>
            <a href="{{ route('tontines.show', $tontine) }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Retour aux détails
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <form method="POST" action="{{ route('tontines.update', $tontine) }}">
                        @csrf
                        @method('PATCH')

                        {{-- Nom de la tontine --}}
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Nom de la tontine')" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('name', $tontine->name)"
                                required
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            {{-- Montant par cycle --}}
                            <div>
                                <x-input-label for="amount_per_cycle" :value="__('Montant par cycle (FCFA)')" />
                                <x-text-input
                                    id="amount_per_cycle"
                                    name="amount_per_cycle"
                                    type="number"
                                    class="mt-1 block w-full"
                                    :value="old('amount_per_cycle', $tontine->amount_per_cycle)"
                                    required
                                />
                                <x-input-error :messages="$errors->get('amount_per_cycle')" class="mt-2" />
                            </div>

                            {{-- Statut --}}
                            <div>
                                <x-input-label for="status" :value="__('Statut')" />
                                <select
                                    id="status"
                                    name="status"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required
                                >
                                    <option value="active" {{ old('status', $tontine->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="clôturée" {{ old('status', $tontine->status) === 'clôturée' ? 'selected' : '' }}>Clôturée</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        {{-- Fréquence --}}
                        <div class="mb-6">
                            <x-input-label for="frequency" :value="__('Fréquence')" />
                            <select
                                id="frequency"
                                name="frequency"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
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
                        <div class="mb-8">
                            <x-input-label :value="__('Membres & Ordre de bénéfice')" />
                            <p class="text-sm text-gray-500 mt-1 mb-3">
                                L'ordre dans lequel vous cochez les membres déterminera leur position.
                            </p>

                            <div class="border border-gray-200 rounded-lg divide-y divide-gray-100 max-h-64 overflow-y-auto">
                                @foreach ($members as $member)
                                    <label class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 cursor-pointer">
                                        <input
                                            type="checkbox"
                                            name="members[]"
                                            value="{{ $member->id }}"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                            {{ in_array($member->id, old('members', $selectedMemberIds)) ? 'checked' : '' }}
                                        >
                                        <div>
                                            <span class="font-medium text-gray-800">{{ $member->name }}</span>
                                            <span class="ml-2 text-sm text-gray-400">{{ $member->email }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error :messages="$errors->get('members')" class="mt-2" />
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-4 border-t pt-6">
                            <a href="{{ route('tontines.show', $tontine) }}" class="text-sm text-gray-600 hover:underline">Annuler</a>
                            <x-primary-button>
                                {{ __('Enregistrer les modifications') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Zone de danger --}}
            <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-red-800 font-bold mb-2">Zone de danger</h3>
                <p class="text-red-600 text-sm mb-4">La suppression d'une tontine est irréversible et supprimera tous les cycles et paiements associés.</p>
                <form method="POST" action="{{ route('tontines.destroy', $tontine) }}" onsubmit="return confirm('Êtes-vous certain de vouloir supprimer cette tontine ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-md text-xs font-bold uppercase tracking-widest transition">
                        Supprimer la tontine
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
