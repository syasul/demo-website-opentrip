<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Puncak & Bara | Open Trip Pendakian Gunung Profesional')</title>
    
    <!-- Tailwind CSS CDN (v4 theme config compatible style) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        /* Natural Mountain Light Theme Styles */
        :root {
            --color-primary: #2F5233; /* Forest Green */
            --color-primary-light: #4A7856;
            --color-secondary: #8B6F47; /* Earth Coklat */
            --color-accent-blue: #A8C8E0; /* Sky blue */
            --color-accent-orange: #E8915A; /* Sunrise orange */
            --color-bg-light: #FAFAF7;
            --color-bg-alt: #F7F5F0;
            --color-text-dark: #222222;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--color-bg-light);
            color: var(--color-text-dark);
        }

        h1, h2, h3, h4, .font-serif {
            font-family: 'Fraunces', serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(47, 82, 51, 0.04);
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.65) !important;
            backdrop-filter: blur(28px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(28px) saturate(190%) !important;
            border: 1px solid rgba(255, 255, 255, 0.5) !important;
            box-shadow: 0 10px 40px -10px rgba(47, 82, 51, 0.08) !important;
        }

        .dark-glass-card {
            background: rgba(15, 23, 42, 0.65) !important;
            backdrop-filter: blur(24px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(180%) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.3) !important;
        }

        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--color-bg-alt);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--color-primary-light);
            border-radius: 10px;
        }

        /* High-Fidelity Animations */
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1.5deg); }
        }
        .animate-float-slow {
            animation: float-slow 7s ease-in-out infinite;
        }

        @keyframes float-reverse {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(15px) rotate(-1.5deg); }
        }
        .animate-float-reverse {
            animation: float-reverse 8s ease-in-out infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        .animate-pulse-glow {
            animation: pulse-glow 4s ease-in-out infinite;
        }
    </style>
    
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
</head>
<body class="selection:bg-primary/20 selection:text-primary min-h-screen flex flex-col">

    <!-- Storefront Navigation Shell -->
    @php
        $isHome = request()->is('/') || request()->is('home');
        $isDetail = request()->is('trips/*') || request()->is('trips');
        $hasHero = $isHome || $isDetail;
        
        $navClass = $hasHero 
            ? "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 bg-transparent border border-transparent shadow-none py-4 px-8 md:px-12 rounded-full" 
            : "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 glass-nav py-2.5 px-8 md:px-12 rounded-full";
        $logoTextClass = $hasHero ? "text-white" : "text-primary";
        $logoSubTextClass = $hasHero ? "text-white/80" : "text-secondary";
        $linkClass = $hasHero ? "text-white/80" : "text-text-dark/70";
        $activeLinkBorder = $hasHero ? "border-white text-white" : "border-primary text-primary";
    @endphp

    <nav class="{{ $navClass }}" id="main-nav" data-is-home="{{ $hasHero ? 'true' : 'false' }}">
        <div class="flex justify-between items-center w-full">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-full bg-primary flex items-center justify-center text-white shadow-md shadow-primary/20 group-hover:scale-105 transition-transform">
                    <i data-lucide="mountain" class="w-4.5 h-4.5"></i>
                </div>
                <div class="flex flex-col">
                    <span class="font-serif text-lg font-bold tracking-tight leading-none transition-all duration-300 {{ $logoTextClass }}" id="logo-title">Puncak & Bara</span>
                    <span class="text-[8px] tracking-widest font-sans font-bold uppercase transition-all duration-300 {{ $logoSubTextClass }}" id="logo-subtitle">Open Trip Gunung</span>
                </div>
            </a>
            
            <div class="hidden md:flex items-center space-x-6 transition-all duration-300 {{ $linkClass }}" id="nav-links">
                <a class="text-xs font-bold tracking-wide transition-colors py-1 hover:text-primary-light {{ (request()->is('/') || request()->is('home')) ? 'border-b-2 ' . $activeLinkBorder : 'hover:text-primary' }}" href="{{ route('home') }}" data-nav="home">Beranda</a>
                <a class="text-xs font-bold tracking-wide transition-colors py-1 hover:text-primary-light {{ request()->is('explore') ? 'border-b-2 ' . $activeLinkBorder : 'hover:text-primary' }}" href="{{ route('explore') }}" data-nav="explore">Daftar Trip</a>
                <a class="text-xs font-bold tracking-wide transition-colors py-1 hover:text-primary-light {{ (request()->is('blog') || request()->is('blog/*')) ? 'border-b-2 ' . $activeLinkBorder : 'hover:text-primary' }}" href="{{ route('blog') }}" data-nav="blog">Artikel & Tips</a>
                <a class="text-xs font-bold tracking-wide transition-colors py-1 hover:text-primary-light {{ request()->is('about') ? 'border-b-2 ' . $activeLinkBorder : 'hover:text-primary' }}" href="{{ route('about') }}" data-nav="about">Tentang Kami</a>
                <a class="text-xs font-bold tracking-wide transition-colors py-1 hover:text-primary-light {{ request()->is('contact') ? 'border-b-2 ' . $activeLinkBorder : 'hover:text-primary' }}" href="{{ route('contact') }}" data-nav="contact">FAQ & Kontak</a>
            </div>
            
            <div class="flex items-center space-x-4 transition-all duration-300 {{ $linkClass }}" id="nav-auth">
                @if(Auth::guard('web')->check())
                    <a href="{{ route('user.dashboard') }}" class="text-xs font-bold flex items-center gap-1.5 transition-colors hover:text-primary-light">
                        <i data-lucide="user" class="w-3.5 h-3.5"></i> Panel
                    </a>
                    <a href="{{ route('logout') }}" class="text-[10px] bg-bg-alt/10 hover:bg-bg-alt/30 px-3 py-1.5 rounded-full border border-current/10 transition-colors">Keluar</a>
                @elseif(Auth::guard('admin')->check())
                    <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold flex items-center gap-1.5 transition-colors hover:text-primary-light">
                        <i data-lucide="layout-dashboard" class="w-3.5 h-3.5"></i> Admin
                    </a>
                    <a href="{{ route('logout') }}" class="text-[10px] bg-bg-alt/10 hover:bg-bg-alt/30 px-3 py-1.5 rounded-full border border-current/10 transition-colors">Keluar</a>
                @else
                    <a href="{{ route('login') }}" class="text-xs font-bold transition-colors hover:text-primary-light">Masuk</a>
                    <a href="{{ route('register') }}" id="register-btn" class="bg-primary text-white px-4 py-2 rounded-full text-xs font-bold hover:scale-[1.03] active:scale-[0.98] transition-all shadow-md shadow-primary/20">Daftar</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="flex-grow {{ $hasHero ? 'pt-0' : 'pt-24' }} page-transition">
        @yield('content')
    </main>

    <!-- Storefront Footer Shell -->
    <footer class="bg-primary text-white/90 mt-16 border-t-4 border-secondary">
        <div class="max-w-8xl mx-auto px-4 md:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="flex flex-col space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-primary font-bold">
                            <i data-lucide="mountain" class="w-4 h-4"></i>
                        </div>
                        <span class="font-serif text-lg font-bold text-white">Puncak & Bara</span>
                    </div>
                    <p class="text-white/70 text-sm max-w-xs font-sans">
                        Penyedia layanan open trip pendakian gunung profesional di Indonesia. Aman, terpercaya, dan bersertifikasi guide resmi.
                    </p>
                </div>
                
                <div class="flex flex-col space-y-2">
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest mb-2">Halaman Utama</span>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('explore') }}">Daftar Gunung</a>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('blog') }}">Artikel Tips</a>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('about') }}">Tentang Kami</a>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest mb-2">Legalitas & Safety</span>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('about') }}#legal">Sertifikasi Guide</a>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('about') }}#legal">Syarat & Ketentuan</a>
                    <a class="text-white/70 hover:text-white text-sm transition-colors" href="{{ route('contact') }}">Hubungi Kami</a>
                </div>

                <div class="flex flex-col space-y-4">
                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Hubungi Kami</span>
                    <div class="flex flex-col space-y-2 text-white/70 text-sm">
                        <a href="https://wa.me/6281330012100" target="_blank" rel="noopener noreferrer" class="flex items-center space-x-2 hover:text-white transition-colors">
                            <i data-lucide="phone" class="w-4 h-4 text-secondary"></i>
                            <span>WhatsApp: 0813-3001-2100</span>
                        </a>
                        <a href="mailto:info@puncakbara.com" class="flex items-center space-x-2 hover:text-white transition-colors">
                            <i data-lucide="mail" class="w-4 h-4 text-secondary"></i>
                            <span>info@puncakbara.com</span>
                        </a>
                    </div>
                    <div class="flex space-x-3 mt-2">
                        <a class="w-8 h-8 rounded-lg border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all" href="#">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a class="w-8 h-8 rounded-lg border border-white/20 flex items-center justify-center hover:bg-white hover:text-primary transition-all" href="#">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 pt-6 border-t border-white/10 flex flex-col md:flex-row justify-between items-center text-xs text-white/60 font-sans">
                <span>© 2026 Puncak & Bara by INXDVI. Hak Cipta Dilindungi.</span>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <span>Pemandu Berlisensi APGI</span>
                    <span>Standard Protokol Keselamatan Tinggi</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281330012100" target="_blank" rel="noopener noreferrer" class="fixed bottom-8 right-8 z-50 flex items-center justify-center w-16 h-16 bg-[#25D366] text-white rounded-full shadow-2xl hover:scale-110 hover:bg-[#20ba5a] transition-all duration-300 group" aria-label="Hubungi Kami via WhatsApp">
        <span class="absolute right-full mr-3 py-1.5 px-3 bg-slate-900/90 backdrop-blur-sm text-white text-xs font-semibold rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap shadow-md">
            Butuh Bantuan? Hubungi Kami
        </span>
        <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.42 9.864-9.864.002-2.637-1.019-5.117-2.875-6.976C16.3 1.905 13.825.885 11.19.884c-5.441 0-9.865 4.42-9.869 9.866-.001 1.77.468 3.498 1.36 5.026l-.993 3.634 3.732-.98c1.568.854 3.292 1.302 4.933 1.302zm9.251-6.275c-.272-.137-1.614-.796-1.863-.887-.249-.09-.431-.136-.613.137-.182.273-.703.887-.862 1.069-.159.182-.318.205-.59.069-.272-.137-1.149-.424-2.19-1.355-.809-.721-1.355-1.612-1.513-1.886-.159-.273-.017-.42.119-.556.123-.122.272-.318.409-.477.137-.159.182-.273.272-.455.09-.182.046-.341-.023-.478-.069-.137-.613-1.477-.84-2.023-.22-.53-.442-.457-.613-.466-.159-.008-.341-.01-.523-.01-.182 0-.477.068-.727.341-.25.272-.954.932-.954 2.273 0 1.341.977 2.636 1.114 2.818.137.182 1.922 2.934 4.659 4.116.65.281 1.157.449 1.554.575.654.207 1.25.178 1.72.108.524-.078 1.614-.659 1.841-1.295.228-.636.228-1.182.159-1.295-.069-.114-.249-.182-.522-.319z"/>
        </svg>
        <span class="absolute inset-0 rounded-full bg-[#25D366] opacity-30 animate-ping z-[-1]"></span>
    </a>

    <!-- Global Scripts -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        // Scroll Reveal Logic
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Header scroll effect
        const handleScroll = () => {
            const nav = document.getElementById('main-nav');
            if (!nav) return;
            
            const logoTitle = document.getElementById('logo-title');
            const logoSubtitle = document.getElementById('logo-subtitle');
            const navLinks = document.getElementById('nav-links');
            const navAuth = document.getElementById('nav-auth');
            
            const isHome = nav.getAttribute('data-is-home') === 'true';
            const scrollPos = window.scrollY || window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            
            if (isHome) {
                if (scrollPos > 20) {
                    nav.className = "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 glass-nav py-2.5 px-8 md:px-12 rounded-full";
                    if(logoTitle) logoTitle.className = "font-serif text-lg font-bold tracking-tight leading-none transition-all duration-300 text-primary";
                    if(logoSubtitle) logoSubtitle.className = "text-[8px] tracking-widest font-sans font-bold uppercase transition-all duration-300 text-secondary";
                    if(navLinks) navLinks.className = "hidden md:flex items-center space-x-6 transition-all duration-300 text-text-dark/70";
                    if(navAuth) navAuth.className = "flex items-center space-x-4 transition-all duration-300 text-text-dark/70";
                    
                    // Update active link borders
                    document.querySelectorAll('[data-nav]').forEach(el => {
                        if (el.classList.contains('border-white')) {
                            el.classList.remove('border-white', 'text-white');
                            el.classList.add('border-primary', 'text-primary');
                        }
                    });
                } else {
                    nav.className = "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 bg-transparent border border-transparent shadow-none py-4 px-8 md:px-12 rounded-full";
                    if(logoTitle) logoTitle.className = "font-serif text-lg font-bold tracking-tight leading-none transition-all duration-300 text-white";
                    if(logoSubtitle) logoSubtitle.className = "text-[8px] tracking-widest font-sans font-bold uppercase transition-all duration-300 text-white/80";
                    if(navLinks) navLinks.className = "hidden md:flex items-center space-x-6 transition-all duration-300 text-white/80";
                    if(navAuth) navAuth.className = "flex items-center space-x-4 transition-all duration-300 text-white/80";
                    
                    // Update active link borders
                    document.querySelectorAll('[data-nav]').forEach(el => {
                        if (el.classList.contains('border-primary')) {
                            el.classList.remove('border-primary', 'text-primary');
                            el.classList.add('border-white', 'text-white');
                        }
                    });
                }
            } else {
                if (scrollPos > 20) {
                    nav.className = "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 glass-nav py-2.5 px-8 md:px-12 rounded-full";
                } else {
                    nav.className = "fixed top-4 left-1/2 -translate-x-1/2 w-[92%] max-w-8xl z-50 transition-all duration-300 glass-nav py-3.5 px-8 md:px-12 rounded-full";
                }
            }
        };

        window.addEventListener('scroll', handleScroll);
        window.addEventListener('DOMContentLoaded', handleScroll);

        window.showToast = (message, type = 'success') => {
            const container = document.getElementById('toast-container');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-enter pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-2xl shadow-xl border text-xs font-bold ${
                type === 'success' ? 'bg-emerald-50 border-emerald-200 text-emerald-800' :
                type === 'error' ? 'bg-rose-50 border-rose-200 text-rose-800' :
                type === 'warning' ? 'bg-amber-50 border-amber-200 text-amber-800' :
                'bg-slate-50 border-slate-200 text-slate-800'
            }`;

            const iconMap = {
                success: 'check-circle',
                error: 'alert-circle',
                warning: 'alert-triangle',
                info: 'info'
            };

            const iconName = iconMap[type] || 'info';
            toast.innerHTML = `
                <i data-lucide="${iconName}" class="w-4.5 h-4.5 shrink-0"></i>
                <span class="flex-grow">${message}</span>
                <button class="shrink-0 text-current/50 hover:text-current font-bold text-sm ml-2" onclick="this.parentElement.remove()">✕</button>
            `;

            container.appendChild(toast);
            lucide.createIcons();

            setTimeout(() => {
                toast.classList.replace('toast-enter', 'toast-leave');
                toast.addEventListener('animationend', () => toast.remove());
            }, 4000);
        };

        // Trigger session-based alerts
        @if(session('success'))
            window.addEventListener('DOMContentLoaded', () => window.showToast("{{ session('success') }}", 'success'));
        @endif
        @if(session('error'))
            window.addEventListener('DOMContentLoaded', () => window.showToast("{{ session('error') }}", 'error'));
        @endif
    </script>
    
    <!-- Global Toast Container -->
    <div id="toast-container" class="fixed top-24 right-6 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none"></div>

    @yield('scripts')
</body>
</html>
