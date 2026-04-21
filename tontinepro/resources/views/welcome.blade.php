<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TontinePro - Gestion de Tontines</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-montserrat bg-mint min-h-screen flex flex-col items-center justify-center p-6 text-center">
        
        <script src="https://unpkg.com/lucide@latest"></script>

        <div class="mb-12">
            <img src="{{ asset('images/logo/tontinebg.png') }}" alt="TontinePro" class="h-48 w-auto mx-auto drop-shadow-2xl">
        </div>

        <div class="max-w-4xl">
            <h1 class="text-6xl md:text-7xl font-black text-sage-dim mb-8 tracking-tighter leading-none italic">
                La tontine moderne,<br><span class="text-sage-dark not-italic">en toute confiance.</span>
            </h1>
            
            <p class="text-gray-500 text-xl md:text-2xl mb-12 max-w-2xl mx-auto font-medium leading-relaxed">
                Rejoignez l'élite de la gestion financière collaborative. <br>
                <span class="text-sage-dark font-bold underline decoration-sage-light decoration-4 underline-offset-8">Simple. Sécurisé. Transparent.</span>
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-6 mb-24">
            @auth
                <a href="{{ url('/dashboard') }}" class="group bg-sage-dark hover:opacity-hover text-white font-black px-12 py-5 rounded-full transition-all duration-300 shadow-2xl flex items-center gap-3">
                    <span>Accéder à mon espace</span>
                    <i data-lucide="arrow-right" class="w-6 h-6 group-hover:translate-x-1 transition-transform"></i>
                </a>
            @else
                <a href="{{ route('login') }}" class="group bg-sage-dark hover:opacity-hover text-white font-black px-12 py-5 rounded-full transition-all duration-300 shadow-2xl flex items-center gap-3">
                    <span>Se connecter</span>
                    <i data-lucide="log-in" class="w-6 h-6"></i>
                </a>
                <a href="{{ route('register') }}" class="bg-white border-2 border-sage-light text-sage-dim font-black px-12 py-5 rounded-full hover:opacity-hover transition-all duration-300 flex items-center gap-3">
                    <span>Créer un compte</span>
                    <i data-lucide="user-plus" class="w-6 h-6"></i>
                </a>
            @endauth
        </div>

        <div class="mt-24 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full">
            <div class="bg-white p-10 rounded-[2.5rem] border border-sage-light shadow-xl shadow-sage-light/20 flex flex-col items-center">
                <div class="w-16 h-16 bg-mint rounded-2xl flex items-center justify-center mb-6 text-sage-dark">
                    <i data-lucide="shield-check" class="w-10 h-10"></i>
                </div>
                <h3 class="text-2xl font-black text-sage-dim mb-4">Sécurité Totale</h3>
                <p class="text-gray-400 font-medium leading-relaxed">Vos fonds sont tracés et chaque transaction est validée par le groupe.</p>
            </div>
            <div class="bg-white p-10 rounded-[2.5rem] border border-sage-light shadow-xl shadow-sage-light/20 flex flex-col items-center">
                <div class="w-16 h-16 bg-mint rounded-2xl flex items-center justify-center mb-6 text-sage-dark">
                    <i data-lucide="layers" class="w-10 h-10"></i>
                </div>
                <h3 class="text-2xl font-black text-sage-dim mb-4">Cycles Automatisés</h3>
                <p class="text-gray-400 font-medium leading-relaxed">Rotation automatique des bénéficiaires et rappels de paiement intelligents.</p>
            </div>
            <div class="bg-white p-10 rounded-[2.5rem] border border-sage-light shadow-xl shadow-sage-light/20 flex flex-col items-center">
                <div class="w-16 h-16 bg-mint rounded-2xl flex items-center justify-center mb-6 text-sage-dark">
                    <i data-lucide="trending-up" class="w-10 h-10"></i>
                </div>
                <h3 class="text-2xl font-black text-sage-dim mb-4">Croissance Agile</h3>
                <p class="text-gray-400 font-medium leading-relaxed">Visualisez l'évolution de votre épargne et celle de votre communauté.</p>
            </div>
        </div>

        <footer class="mt-24 text-gray-400 text-xs font-bold uppercase tracking-widest border-t border-sage-light pt-12 w-full max-w-4xl">
            &copy; {{ date('Y') }} TontinePro Management System — L'excellence au service de l'épargne.
        </footer>

        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
