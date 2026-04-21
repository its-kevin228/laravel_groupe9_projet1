<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TontinePro — Fais grandir ton argent avec ta communauté</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-montserrat bg-[#fbfcf7] text-black">
    <script src="https://unpkg.com/lucide@latest"></script>

    {{-- NAVIGATION --}}
    <nav id="main-nav" class="fixed top-0 w-full z-50 bg-[#fbfcf7]/90 backdrop-blur-md border-b border-tixtogo-border transition-all duration-500 ease-in-out">
        <div id="nav-container" class="max-w-7xl mx-auto px-6 h-48 flex items-center justify-between transition-all duration-500">
            <a href="/">
                <img id="nav-logo" src="{{ asset('images/logo/tontinebg.png') }}" alt="Logo" class="h-40 w-auto transition-all duration-500 hover:scale-105">
            </a>
            <div class="flex items-center gap-8">
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-[11px] font-black uppercase tracking-widest text-sage-dark border-b-2 border-sage-dark pb-1">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-widest text-black hover:text-sage-dark transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-black text-white text-[11px] font-black uppercase tracking-widest px-8 py-4 rounded-tix hover:bg-sage-dark shadow-xl shadow-black/10 transition-all">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO SECTION --}}
    <section class="relative pt-60 pb-32 flex flex-col items-center text-center px-6">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-8xl font-black text-black leading-[0.9] tracking-tighter uppercase mb-8">
                Fais grandir ton argent <br>
                <span class="text-sage-dark italic underline decoration-sage-light decoration-8 underline-offset-[-10px]">avec ta communauté.</span>
            </h1>
            <p class="text-gray-400 text-lg md:text-xl font-medium max-w-2xl mx-auto leading-relaxed uppercase tracking-tight mb-12">
                La tontine digitale réinventée : une gestion automatisée, une sécurité bancaire et une transparence totale pour vos projets communs.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto bg-black text-white font-black text-xs uppercase tracking-[0.2em] px-16 py-7 rounded-tix shadow-2xl hover:bg-sage-dark transition-all flex items-center justify-center gap-4">
                        <span>Accéder à l'interface</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-black text-white font-black text-xs uppercase tracking-[0.2em] px-16 py-7 rounded-tix shadow-2xl hover:bg-sage-dark transition-all flex items-center justify-center gap-4">
                        <span>Commencer l'aventure</span>
                        
                    </a>
                @endauth
            </div>
        </div>

        <div class="mt-24 w-full max-w-6xl rounded-tix overflow-hidden border border-tixtogo-border shadow-2xl">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=2071" alt="Collaboration" class="w-full h-[450px] object-cover grayscale hover:grayscale-0 transition-all duration-1000">
        </div>
    </section>

    {{-- COMMENT ÇA MARCHE --}}
    <section class="py-32 bg-white border-y border-tixtogo-border">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <h2 class="text-4xl font-black uppercase tracking-tighter text-black">Comment ça marche ?</h2>
                <div class="w-20 h-1.5 bg-sage-dark mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-8 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="user-plus" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-xl font-black uppercase tracking-tight mb-4">1. S'inscrire</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose px-4">Créez votre profil et rejoignez une tontine existante ou créez la vôtre en quelques secondes.</p>
                </div>

                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-8 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="credit-card" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-xl font-black uppercase tracking-tight mb-4">2. Cotiser</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose px-4">Versez vos cotisations périodiques en toute sécurité. Le système suit chaque franc versé.</p>
                </div>

                <div class="flex flex-col items-center text-center group">
                    <div class="w-20 h-20 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-8 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="gift" class="w-10 h-10"></i>
                    </div>
                    <h3 class="text-xl font-black uppercase tracking-tight mb-4">3. Percevoir</h3>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose px-4">À votre tour, recevez la cagnotte totale pour vos projets, sans frais cachés ni complexité.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- UX & VALEURS --}}
    <section class="py-32 px-6">
        <div class="max-w-7xl mx-auto flex flex-col lg:flex-row items-start gap-20">
            <div class="lg:w-1/2 lg:sticky lg:top-32">
                <div class="rounded-tix overflow-hidden border border-tixtogo-border shadow-2xl rotate-1">
                    <img src="https://images.unsplash.com/photo-1556742502-ec7c0e9f34b1?auto=format&fit=crop&q=80&w=1974" alt="Digital Payment" class="w-full h-[400px] object-cover grayscale hover:grayscale-0 transition-all duration-700">
                </div>
                <div class="mt-8">
                    <h2 class="text-4xl font-black uppercase tracking-tighter text-black mb-6">Nos Engagements</h2>
                    <p class="text-gray-400 font-medium uppercase tracking-tight leading-relaxed max-w-md">Nous avons bâti TontinePro sur des piliers technologiques essentiels pour garantir la sécurité de votre communauté.</p>
                </div>
            </div>
            
            <div class="lg:w-1/2 space-y-6">
                {{-- Feature 1 --}}
                <div class="p-10 bg-white border border-tixtogo-border rounded-tix hover:border-black transition-all group">
                    <div class="w-14 h-14 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-6 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="shield-check" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-black uppercase tracking-tight text-black mb-3">Traçabilité Totale</h4>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose">Chaque versement est signé numériquement et validé par l'administrateur du cercle. Un historique immuable pour une confiance absolue.</p>
                </div>

                {{-- Feature 2 --}}
                <div class="p-10 bg-white border border-tixtogo-border rounded-tix hover:border-black transition-all group">
                    <div class="w-14 h-14 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-6 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="printer" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-black uppercase tracking-tight text-black mb-3">Rapports PDF</h4>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose">Exportez instantanément les listes de membres et l'état des cycles en documents PDF professionnels. La clarté en un clic.</p>
                </div>

                {{-- Feature 3 --}}
                <div class="p-10 bg-white border border-tixtogo-border rounded-tix hover:border-black transition-all group">
                    <div class="w-14 h-14 bg-mint border border-sage-light rounded-tix flex items-center justify-center text-sage-dark mb-6 group-hover:bg-black group-hover:text-white transition-all">
                        <i data-lucide="repeat" class="w-7 h-7"></i>
                    </div>
                    <h4 class="text-xl font-black uppercase tracking-tight text-black mb-3">Cycles Intelligents</h4>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-widest leading-loose">Rotation automatique des bénéficiaires et suivi en temps réel de la progression de la tontine. Zéro erreur humaine.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="py-24 border-t border-tixtogo-border bg-white px-6">
        <div class="max-w-7xl mx-auto flex flex-col items-center text-center">
            <img src="{{ asset('images/logo/tontinebg.png') }}" alt="Logo" class="h-28 w-auto mb-10 transition-transform hover:scale-105">
            
            <div class="flex items-center gap-10 mb-12 text-gray-400">
                <i data-lucide="linkedin" class="w-6 h-6 hover:text-black cursor-pointer transition-colors"></i>
                <i data-lucide="twitter" class="w-6 h-6 hover:text-black cursor-pointer transition-colors"></i>
                <i data-lucide="instagram" class="w-6 h-6 hover:text-black cursor-pointer transition-colors"></i>
            </div>

            <div class="space-y-4">
                <p class="text-lg md:text-xl font-black uppercase tracking-[0.3em] text-black">
                    &copy; {{ date('Y') }} TontinePro Management
                </p>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-sage-dark italic">
                    L'excellence au service de l'épargne.
                </p>
            </div>
            
            
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Script pour rétrécir le header au scroll
        const nav = document.getElementById('main-nav');
        const container = document.getElementById('nav-container');
        const logo = document.getElementById('nav-logo');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                container.classList.remove('h-48');
                container.classList.add('h-20');
                logo.classList.remove('h-40');
                logo.classList.add('h-14');
                nav.classList.add('shadow-lg', 'bg-[#fbfcf7]');
            } else {
                container.classList.add('h-48');
                container.classList.remove('h-20');
                logo.classList.add('h-40');
                logo.classList.remove('h-14');
                nav.classList.remove('shadow-lg');
            }
        });
    </script>
</body>
</html>
