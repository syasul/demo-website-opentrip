<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Admin | Puncak & Bara</title>
    
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
                <div class="w-8 h-8 rounded-lg bg-secondary flex items-center justify-center text-white">
                    <i data-lucide="shield" class="w-4.5 h-4.5"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-md font-bold text-primary leading-none">Puncak & Bara</span>
                    <span class="text-[8px] font-bold text-secondary uppercase tracking-widest">Admin Control</span>
                </div>
            </a>
            
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-sm font-semibold text-text-dark/65 hover:text-primary flex items-center gap-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Web
                </a>
                
                <div class="flex items-center space-x-3 border-l border-primary/10 pl-6">
                    <div class="w-8 h-8 rounded-full bg-secondary/10 text-secondary flex items-center justify-center font-bold text-sm">
                        A
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="text-xs font-bold text-text-dark">{{ Auth::guard('admin')->user()->name }}</span>
                        <span class="text-[9px] font-semibold text-secondary uppercase tracking-wider">{{ Auth::guard('admin')->user()->role }}</span>
                    </div>
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
                    <span class="text-xs font-bold text-secondary uppercase tracking-wider block">Panel Operator</span>
                </div>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Ringkasan
                </a>
                
                <a href="{{ route('admin.trips') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.trips') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="mountain" class="w-4 h-4"></i> Kelola Trip Gunung
                </a>
                
                <a href="{{ route('admin.bookings') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.bookings') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="file-check-2" class="w-4 h-4"></i> Verifikasi Pembayaran
                </a>
                
                <a href="{{ route('admin.reviews') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.reviews') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="message-square" class="w-4 h-4"></i> Moderasi Ulasan
                </a>

                <a href="{{ route('admin.articles') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.articles') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="newspaper" class="w-4 h-4"></i> Kelola Blog / Artikel
                </a>

                <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold transition-all {{ request()->routeIs('admin.users') ? 'bg-secondary text-white shadow-sm' : 'text-text-dark/70 hover:bg-secondary/5 hover:text-secondary' }}">
                    <i data-lucide="users" class="w-4 h-4"></i> Kelola User
                </a>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-grow bg-white rounded-2xl border border-primary/10 p-6 md:p-8 shadow-sm">
            @yield('admin-content')
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-bg-alt border-t border-primary/10 py-6 text-center text-xs text-text-dark/65 font-sans mt-auto">
        <p>© 2026 Puncak & Bara by INXDVI. Admin Control Console. Standard Keamanan Enkripsi.</p>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @yield('scripts')
</body>
</html>
