<x-app-layout>
    <div class="py-12 bg-mint min-h-screen font-montserrat">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Header de la page Profile --}}
            <div class="bg-white rounded-tix p-8 shadow-sm border border-tixtogo-border mb-8 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-12 opacity-[0.03]">
                    <img src="{{ asset('images/logo/tontinebg.png') }}" class="w-64 rotate-12">
                </div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h2 class="text-3xl font-black text-sage-dim uppercase tracking-tight">{{ __('Mon Profil') }}</h2>
                        </div>
                        <p class="text-gray-500 font-bold uppercase tracking-widest text-[11px]">
                            Gérez vos informations personnelles et la sécurité de votre compte
                        </p>
                    </div>
                    <div class="flex items-center gap-2 bg-sage-light text-sage-dim px-4 py-2 rounded-tix border border-sage-dark/20">
                        <i data-lucide="user" class="w-5 h-5"></i>
                        <span class="font-bold text-xs uppercase tracking-widest">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="p-8 bg-white rounded-tix border border-tixtogo-border shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-8 bg-white rounded-tix border border-tixtogo-border shadow-sm">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                @if(!auth()->user()->isAdmin())
                    <div class="p-8 bg-white rounded-tix border border-tixtogo-border shadow-sm lg:col-span-2">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
