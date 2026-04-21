<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-sage-dim tracking-tight">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-10">
                <h1 class="text-3xl font-black text-sage-dim tracking-tight">Bienvenue, {{ Auth::user()->name }} !</h1>
                <p class="text-gray-400 font-medium mt-1">Voici un aperçu de votre activité financière.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-xl border border-sage-light shadow-sm hover:border-sage-dark transition-colors duration-300">
                    <div class="w-12 h-12 bg-sage-light/30 rounded-lg flex items-center justify-center text-sage-dark mb-4">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tontines Actives</h3>
                    <p class="text-2xl font-black text-sage-dim">0</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-xl border border-sage-light shadow-sm hover:border-sage-dark transition-colors duration-300">
                    <div class="w-12 h-12 bg-sage-light/30 rounded-lg flex items-center justify-center text-sage-dark mb-4">
                        <i data-lucide="trending-up" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Investissement Total</h3>
                    <p class="text-2xl font-black text-sage-dim">0 <small class="text-[0.6rem] uppercase">FCFA</small></p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-xl border border-sage-light shadow-sm hover:border-sage-dark transition-colors duration-300">
                    <div class="w-12 h-12 bg-sage-light/30 rounded-lg flex items-center justify-center text-sage-dark mb-4">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Dernière Cotisation</h3>
                    <p class="text-2xl font-black text-sage-dim">--</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-10 border border-sage-light shadow-sm">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-xl font-black text-sage-dim">Actions rapides</h3>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('tontines.index') }}" class="flex flex-col items-center p-6 bg-mint/50 rounded-xl border border-sage-light hover:bg-sage-dark hover:text-white transition-all duration-200 group">
                        <i data-lucide="search" class="w-6 h-6 mb-3 text-sage-dark group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Voir mes groupes</span>
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('tontines.create') }}" class="flex flex-col items-center p-6 bg-mint/50 rounded-xl border border-sage-light hover:bg-sage-dark hover:text-white transition-all duration-200 group">
                        <i data-lucide="plus" class="w-6 h-6 mb-3 text-sage-dark group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Créer tontine</span>
                    </a>
                    @endif
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center p-6 bg-mint/50 rounded-xl border border-sage-light hover:bg-sage-dark hover:text-white transition-all duration-200 group">
                        <i data-lucide="user" class="w-6 h-6 mb-3 text-sage-dark group-hover:text-white transition-colors"></i>
                        <span class="font-bold text-sm">Mon Profil</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>
</x-app-layout>
