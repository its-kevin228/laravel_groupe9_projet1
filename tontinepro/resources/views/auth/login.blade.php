<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded-[3px] border-tixtogo-border text-sage-dark shadow-sm focus:ring-sage-light" name="remember">
                <span class="ms-2 text-[11px] font-black uppercase tracking-widest text-gray-400 group-hover:text-sage-dark transition-colors">{{ __('Resté connecté') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-8">
            <x-primary-button class="w-full justify-center bg-sage-dark hover:opacity-hover text-white font-black text-xs uppercase tracking-[0.2em] py-4 rounded-tix transition-all shadow-lg shadow-sage-light/20">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
