<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Protocol Panel | Puncak & Bara</title>
    
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
                        accent: '#10B981',
                    }
                }
            }
        }
    </script>
    <!-- Tactical Styling -->
    <style>
        * { cursor: none !important; }
        ::selection { background: #10B981; color: #000; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #fff; }
        ::-webkit-scrollbar-thumb { background: #000; }
        ::-webkit-scrollbar-thumb:hover { background: #10B981; }

        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }
        
        /* Bespoke Grain Texture Overlay */
        .grain-overlay {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: url("https://grainy-gradients.vercel.app/noise.svg");
            opacity: 0.05;
            pointer-events: none;
            z-index: 9999;
            mix-blend-mode: multiply;
        }

        .custom-cursor {
            width: 8px;
            height: 8px;
            background: #10B981;
            border-radius: 0;
            position: fixed;
            pointer-events: none;
            z-index: 10000;
            transition: transform 0.15s ease-out, background 0.3s ease;
        }
        
        .custom-cursor-follower {
            width: 40px;
            height: 40px;
            border: 0.5px solid #000;
            position: fixed;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.3s ease-out, border-color 0.3s ease;
        }

        .interactive-hover .custom-cursor { transform: scale(4); opacity: 0.15; }
        .interactive-hover .custom-cursor-follower { transform: scale(1.5); background: #10B981; border-color: transparent; mix-blend-mode: difference; }

        .reveal { opacity: 0; transform: translateY(30px); transition: all 1.2s cubic-bezier(0.16, 1, 0.3, 1); }
        .reveal.active { opacity: 1; transform: translateY(0); }

        @media (max-width: 1024px) {
            .custom-cursor, .custom-cursor-follower { display: none !important; }
            * { cursor: auto !important; }
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col selection:bg-accent selection:text-black">
    <div class="grain-overlay"></div>
    <div class="custom-cursor"></div>

    <!-- Navigation Hub Protocol -->
    <nav class="bg-black text-white border-b border-white/5 sticky top-0 z-[100]">
        <div class="max-w-7xl mx-auto px-6 h-24 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex flex-col gap-0.5 group interactive">
                <span class="text-lg font-black tracking-tighter uppercase leading-none">Puncak / Bara</span>
                <span class="text-[8px] font-black uppercase tracking-[0.6em] text-accent">INXDVI_CONTROL</span>
            </a>
            
            <div class="flex items-center gap-12">
                <div class="flex flex-col items-end hidden md:flex">
                    <span class="text-[9px] font-black uppercase tracking-[0.4em] text-gray-500">Signal_Authenticated</span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em]">{{ Auth::user()->name }}</span>
                </div>
                <div class="h-8 w-px bg-white/10"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-12 h-12 border border-white/10 flex items-center justify-center hover:bg-accent hover:text-black transition-all interactive group">
                        <i data-lucide="power" class="w-5 h-5 transition-transform group-hover:rotate-12"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-16 flex flex-col lg:flex-row gap-20 w-full flex-grow">
        <!-- Vertical Control Menu -->
        <aside class="w-full lg:w-72 shrink-0 space-y-16">
            <div class="space-y-8">
                <span class="text-[9px] font-black uppercase tracking-[0.6em] text-gray-300">Terminal_Nav</span>
                <div class="flex flex-col gap-px bg-gray-100 border border-gray-100">
                    <a href="{{ route('user.dashboard') }}" class="flex items-center justify-between p-6 bg-white {{ request()->routeIs('user.dashboard') ? 'bg-black text-white' : 'hover:bg-gray-50' }} transition-all interactive">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em]">01 // MISSION_LOG</span>
                        <i data-lucide="monitor" class="w-4 h-4"></i>
                    </a>
                    
                    <a href="{{ route('user.profile') }}" class="flex items-center justify-between p-6 bg-white {{ request()->routeIs('user.profile') ? 'bg-black text-white' : 'hover:bg-gray-50' }} transition-all interactive">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em]">02 // BIOMETRICS</span>
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                    </a>
                    
                    <a href="{{ route('explore') }}" class="flex items-center justify-between p-6 bg-white hover:bg-black hover:text-white transition-all interactive">
                        <span class="text-[10px] font-black uppercase tracking-[0.4em]">03 // DEPLOY_NEW</span>
                        <i data-lucide="plus-square" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <div class="p-8 bg-gray-50 border border-gray-100 space-y-6 relative overflow-hidden">
                <div class="absolute bottom-[-10%] right-[-10%] opacity-[0.03] rotate-12">
                    <i data-lucide="shield" class="w-32 h-32 text-black"></i>
                </div>
                <h5 class="text-[9px] font-black uppercase tracking-[0.5em] text-gray-400">System_Integrity</h5>
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-1.5 h-1.5 bg-accent animate-pulse"></div>
                        <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-600">ARCHIVE_ACCESS_VERIFIED</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Dynamic Content Workspace -->
        <main class="flex-grow min-w-0">
            @yield('user-content')
        </main>
    </div>

    <!-- Peripheral Footer -->
    <footer class="border-t border-gray-100 py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="flex flex-col gap-1">
                <span class="text-[9px] font-black uppercase tracking-[0.6em] text-gray-300">&copy; 2026 ARCHIVE_PROTOCOL</span>
                <span class="text-[8px] font-black uppercase tracking-[0.4em] text-gray-200">SANFORD_DISTRICT_IDN</span>
            </div>
            
            <div class="flex flex-col items-center md:items-end">
                <span class="text-[9px] font-black text-gray-300 uppercase tracking-[0.5em]">Handcrafted by</span>
                <span class="text-[11px] font-black tracking-[0.4em] uppercase text-accent interactive group">INXDVI_</span>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
        
        // Reveal Logic
        const observerOptions = { threshold: 0.1 };
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

        // Interactive Cursor Protocol
        const cursor = document.querySelector('.custom-cursor');
        const follower = document.querySelector('.custom-cursor-follower');
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.left = mouseX + 'px';
            cursor.style.top = mouseY + 'px';
        });

        function animateFollower() {
            if (follower) {
                followerX += (mouseX - followerX) * 0.15;
                followerY += (mouseY - followerY) * 0.15;
                follower.style.left = (followerX - 20) + 'px';
                follower.style.top = (followerY - 20) + 'px';
            }
            requestAnimationFrame(animateFollower);
        }
        animateFollower();

        document.querySelectorAll('.interactive').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('interactive-hover'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('interactive-hover'));
        });
    </script>
    @yield('scripts')
</body>
</html>
