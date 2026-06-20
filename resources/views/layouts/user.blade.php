<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Panel Pendaki | Puncak & Bara</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2F5233',
                        'primary-light': '#4A7856',
                        secondary: '#8B6F47',
                        'accent-blue': '#A8C8E0',
                        'accent-orange': '#E8915A',
                        'bg-light': '#FAFAF7',
                        'bg-alt': '#F7F5F0',
                        'text-dark': '#222222',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-light);
            color: var(--color-text-dark);
        }
        h1, h2, h3, h4, .font-serif {
            font-family: 'Fraunces', serif;
        }
    </style>
</head>
<body class="bg-bg-light min-h-screen flex flex-col">

    <!-- Header bar -->
    <header class="bg-white border-b border-primary/10 sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-white">
                    <i data-lucide="mountain" class="w-4.5 h-4.5"></i>
                </div>
                <span class="font-serif text-lg font-bold text-primary">Puncak & Bara</span>
            </a>
            
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-text-dark/65 hover:text-primary flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Web
                </a>
                
                <div class="flex items-center space-x-3 border-l border-primary/10 pl-6">
                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-sm">
                        @if(Auth::user()->foto_profil)
                            <img src="{{ Auth::user()->foto_profil }}" class="w-8 h-8 rounded-full object-cover" alt="Profile">
                        @else
                            {{ substr(Auth::user()->name, 0, 1) }}
                        @endif
                    </div>
                    <span class="text-sm font-bold text-text-dark">{{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="text-xs bg-bg-alt hover:bg-red-50 text-text-dark/60 hover:text-red-600 px-3 py-1.5 rounded-lg border border-primary/5 transition-colors">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-6 py-8 w-full flex-grow flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Navigation -->
        <aside class="w-full lg:w-64 shrink-0">
            <div class="bg-white rounded-2xl border border-primary/10 p-5 space-y-2 sticky top-24">
                <div class="pb-4 border-b border-primary/5 mb-4">
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Menu Pendaki</span>
                </div>
                
                <a href="{{ route('user.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('user.dashboard') ? 'bg-primary text-white shadow-sm' : 'text-text-dark/70 hover:bg-primary/5 hover:text-primary' }}">
                    <i data-lucide="compass" class="w-4 h-4"></i> Dashboard
                </a>
                
                <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('user.profile') ? 'bg-primary text-white shadow-sm' : 'text-text-dark/70 hover:bg-primary/5 hover:text-primary' }}">
                    <i data-lucide="user-cog" class="w-4 h-4"></i> Profil & Kontak Darurat
                </a>
                
                <a href="{{ route('explore') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-text-dark/70 hover:bg-primary/5 hover:text-primary transition-all">
                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Cari Open Trip Baru
                </a>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-grow bg-white rounded-2xl border border-primary/10 p-6 md:p-8 shadow-sm">
            @yield('user-content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-bg-alt border-t border-primary/10 py-6 text-center text-xs text-text-dark/65 font-sans mt-auto">
        <p>© 2026 Puncak & Bara by INXDVI. Panel Pendaki Pendakian Gunung Indonesia.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
