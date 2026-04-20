<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Tontines') }}
            </h2>
            @if (auth()->user()->isAdmin())
                <a href="{{ route('tontines.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                    + Nouvelle tontine
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Message de succès --}}
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-300 text-green-700 rounded-lg p-4">
                    {{ session('success') }}
                </div>
            @endif

            @if ($tontines->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-12 text-center">
                        <p class="text-gray-500 text-lg">Aucune tontine créée pour le moment.</p>
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('tontines.create') }}"
                                class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition ease-in-out duration-150">
                                Créer la première tontine
                            </a>
                        @endif
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tontines as $tontine)
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="font-semibold text-lg text-gray-800">{{ $tontine->name }}</h3>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full
                                                {{ $tontine->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($tontine->status) }}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500 space-y-1 mb-4">
                                    <p>💰 <strong>{{ number_format($tontine->amount_per_cycle, 0, ',', ' ') }} FCFA</strong> /
                                        cycle</p>
                                    <p>🔁 {{ ucfirst($tontine->frequency) }}</p>
                                    <p>👥 {{ $tontine->members_count }} membre(s)</p>
                                </div>
                                <a href="{{ route('tontines.show', $tontine) }}"
                                    class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                    Voir les détails →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $tontines->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>