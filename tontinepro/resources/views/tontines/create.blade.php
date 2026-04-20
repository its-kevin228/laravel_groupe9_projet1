<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Créer une Tontine') }}
            </h2>
            <a href="{{ route('tontines.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                ← Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            {{-- Message d'erreur global --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-300 text-red-700 rounded-lg p-4">
                    <p class="font-semibold mb-1">Veuillez corriger les erreurs suivantes :</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <form method="POST" action="{{ route('tontines.store') }}">
                        @csrf

                        {{-- Nom de la tontine --}}
                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Nom de la tontine')" />
                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('name')"
                                placeholder="Ex: Tontine des Amis 2026"
                                required
                                autofocus
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Montant par cycle --}}
                        <div class="mb-6">
                            <x-input-label for="amount_per_cycle" :value="__('Montant par cycle (FCFA)')" />
                            <x-text-input
                                id="amount_per_cycle"
                                name="amount_per_cycle"
                                type="number"
                                step="1"
                                min="1"
                                class="mt-1 block w-full"
                                :value="old('amount_per_cycle')"
                                placeholder="Ex: 25000"
                                required
                            />
                            <x-input-error :messages="$errors->get('amount_per_cycle')" class="mt-2" />
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
                                <option value="">-- Choisir une fréquence --</option>
                                <option value="hebdomadaire" {{ old('frequency') === 'hebdomadaire' ? 'selected' : '' }}>Hebdomadaire</option>
                                <option value="mensuel" {{ old('frequency') === 'mensuel' ? 'selected' : '' }}>Mensuel</option>
                                <option value="bimestriel" {{ old('frequency') === 'bimestriel' ? 'selected' : '' }}>Bimestriel</option>
                                <option value="trimestriel" {{ old('frequency') === 'trimestriel' ? 'selected' : '' }}>Trimestriel</option>
                            </select>
                            <x-input-error :messages="$errors->get('frequency')" class="mt-2" />
                        </div>

                        {{-- Sélection des membres --}}
                        <div class="mb-8">
                            <x-input-label :value="__('Membres participants')" />
                            <p class="text-sm text-gray-500 mt-1 mb-3">
                                Cochez les membres à ajouter. L'ordre de sélection définit l'ordre de bénéfice.
                            </p>

                            @if ($members->isEmpty())
                                <p class="text-sm text-amber-600 bg-amber-50 border border-amber-200 rounded-md p-3">
                                    Aucun membre disponible. Veuillez d'abord créer des utilisateurs avec le rôle "member".
                                </p>
                            @else
                                <div class="border border-gray-200 rounded-lg divide-y divide-gray-100 max-h-64 overflow-y-auto">
                                    @foreach ($members as $index => $member)
                                        <label class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 cursor-pointer">
                                            <input
                                                type="checkbox"
                                                name="members[]"
                                                value="{{ $member->id }}"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                {{ in_array($member->id, old('members', [])) ? 'checked' : '' }}
                                            >
                                            <div>
                                                <span class="font-medium text-gray-800">{{ $member->name }}</span>
                                                <span class="ml-2 text-sm text-gray-400">{{ $member->email }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('members')" class="mt-2" />
                                <x-input-error :messages="$errors->get('members.*')" class="mt-2" />
                            @endif
                        </div>

                        {{-- Boutons --}}
                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('tontines.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                                Annuler
                            </a>
                            <x-primary-button>
                                {{ __('Créer la tontine') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
