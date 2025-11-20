<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'SISAG Pulse' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        // Initialiser le thème avant le rendu pour éviter le flash
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.classList.toggle('dark', theme === 'dark');
        })();
    </script>
</head>
<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 min-h-screen transition-colors duration-200">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-50 dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 hidden md:flex md:flex-col transition-colors duration-200">
            <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-900 dark:text-gray-100 block tracking-tight">SISAG Pulse</a>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5 font-normal">Le rythme de l'action publique.</p>
            </div>

            @php
                $navItems = [
                    ['label' => 'Tableau de bord', 'route' => 'dashboard'],
                    ['label' => 'Espace citoyen', 'route' => 'citizen.index'],
                    ['label' => 'SISAG Academy', 'route' => 'academy.index'],
                    ['label' => 'Rapports', 'route' => 'reports.index'],
                    ['label' => 'Historique', 'route' => 'history.index'],
                ];
            @endphp

            <nav class="flex-1 px-4 py-6 space-y-0.5">
                @foreach ($navItems as $item)
                    @php
                        $active = request()->routeIs($item['route']);
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded-md text-sm font-medium transition-all duration-150
                        {{ $active 
                            ? 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-900 dark:text-emerald-200 border border-emerald-200 dark:border-emerald-800 shadow-sm' 
                            : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 hover:text-gray-900 dark:hover:text-gray-100' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Bar with Dark Mode Toggle -->
            <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 py-3 flex items-center justify-between transition-colors duration-200">
                <div class="flex items-center gap-4">
                    <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-900 dark:text-gray-100 md:hidden tracking-tight">SISAG Pulse</a>
                    <h1 class="text-sm font-medium text-gray-700 dark:text-gray-300 hidden md:block">{{ $title ?? 'SISAG Pulse' }}</h1>
                </div>
                
                <button id="theme-toggle" 
                        type="button"
                        class="p-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600"
                        aria-label="Basculer le mode sombre">
                    <svg id="theme-icon-light" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <svg id="theme-icon-dark" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
            </header>

            @if (session('status'))
                <div class="bg-gray-100 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 py-3 px-4">
                    <div class="max-w-5xl mx-auto text-sm text-gray-700 dark:text-gray-300">
                        {{ session('status') }}
                    </div>
                </div>
            @endif

            <main class="flex-1 px-4 py-8 md:px-10 bg-white dark:bg-gray-900 transition-colors duration-200">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Gestion du toggle dark mode - Version simplifiée
        window.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('theme-toggle');
            
            if (toggleButton) {
                toggleButton.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const html = document.documentElement;
                    const isCurrentlyDark = html.classList.contains('dark');
                    
                    if (isCurrentlyDark) {
                        html.classList.remove('dark');
                        localStorage.setItem('theme', 'light');
                    } else {
                        html.classList.add('dark');
                        localStorage.setItem('theme', 'dark');
                    }
                    
                    return false;
                };
            } else {
                console.error('Erreur: Le bouton theme-toggle est introuvable');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>

