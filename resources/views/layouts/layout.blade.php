<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Puncak & Bara | Open Trip Pendakian Gunung Profesional')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: 'var(--primary)',
                        accent: 'var(--accent)',
                        secondary: 'var(--accent-soft)',
                    },
                    fontFamily: {
                        serif: ['Fraunces', 'serif'],
                        sans: ['Outfit', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Outfit:wght@100..900&family=Inter:wght@400;700;900&display=swap" rel="stylesheet"/>
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <style>
        :root {
            --primary: #1E2923; /* Deep Lichen */
            --accent: #3D5A47; /* Moss Green */
            --accent-soft: #A8B5AA;
            --bg-base: #F3F2EE; /* Soft Sand */
            --bg-glass: rgba(243, 242, 238, 0.85);
            --border: rgba(61, 90, 71, 0.12);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-base);
            color: var(--primary);
            cursor: none;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            letter-spacing: -0.01em;
        }

        /* Topography Infused Background */
        .grid-matrix {
            position: fixed; inset: 0;
            background-image: 
                radial-gradient(var(--border) 1.5px, transparent 1.5px);
            background-size: 40px 40px;
            pointer-events: none;
            z-index: -1;
            opacity: 0.6;
        }

        /* Organic Glassmorphism */
        .glass-organic {
            background: var(--bg-glass);
            backdrop-filter: blur(15px);
            border: 1px solid var(--border);
        }

        /* Evolution Reveal (Fluid) */
        .reveal {
            opacity: 1; /* Default to visible for robustness */
            transform: none;
            transition: all 1.6s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .reveal.ready {
            opacity: 0;
            transform: translateY(30px);
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Soft Organic Cursor */
        #cursor {
            width: 8px; height: 8px;
            background: var(--accent);
            border-radius: 50%;
            position: fixed; pointer-events: none;
            z-index: 10000;
        }

        #cursor-follower {
            width: 40px; height: 40px;
            border: 1px solid var(--accent);
            border-radius: 50%;
            position: fixed; pointer-events: none;
            z-index: 9999;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cursor-hover #cursor { transform: scale(2.5); background: var(--accent); mix-blend-mode: difference; }
        .cursor-hover #cursor-follower { transform: scale(1.5); border-color: var(--accent); opacity: 0.5; }

        /* Architectural Grid & Borders */
        .grid-line {
            position: relative;
        }
        .grid-line::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: rgba(61,90,71,0.1);
            transition: width 0.6s cubic-bezier(0.2, 0, 0, 1);
        }
        .reveal.active .grid-line::after {
            width: 100%;
        }

        .reveal-child {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-child.active {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 1024px) {
            #cursor, #cursor-follower, .wa-protocol span { display: none !important; }
            body { cursor: auto !important; }
        }


        /* Tactical Overlays */
        .scanlines {
            position: fixed; inset: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.05) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.01), rgba(0, 255, 0, 0.005), rgba(0, 0, 255, 0.01));
            z-index: 9998; background-size: 100% 2px, 3px 100%;
            pointer-events: none;
        }
        .vignette {
            position: fixed; inset: 0;
            background: radial-gradient(circle, transparent 50%, rgba(0,0,0,0.15) 100%);
            z-index: 9997; pointer-events: none;
        }
        
        .transition-soft { transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1); }
        
        /* Floating WA Protocol */
        .wa-protocol {
            position: fixed; bottom: 40px; right: 40px;
            z-index: 100;
        }
        .wa-protocol span {
            color: var(--accent);
            font-weight: 800;
        }

        /* Animated Architectural Grain */
        @keyframes noise {
            0%, 100% { transform: translate(0,0) }
            10% { transform: translate(-5%,-10%) }
            20% { transform: translate(-15%,5%) }
            30% { transform: translate(7%,-25%) }
            40% { transform: translate(-5%,25%) }
            50% { transform: translate(-15%,10%) }
            60% { transform: translate(15%,0) }
            70% { transform: translate(0,15%) }
            80% { transform: translate(3%,35%) }
            90% { transform: translate(-10%,10%) }
        }
        .grain-overlay {
            position: fixed; inset: -200%; 
            background-image: url('https://grainy-gradients.vercel.app/noise.svg');
            opacity: 0.05; z-index: 9999; pointer-events: none;
            animation: noise 2s steps(4) infinite;
        }

        /* System Pulse Effect */
        @keyframes pulse-thin {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        #hud-coords { animation: pulse-thin 4s infinite; }

        /* Minimalist Scrollbar & Smoothness */
        html { scroll-behavior: smooth; }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--accent); border-radius: 0; }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* Tactical Overlays Refinement */
        .scanlines {
            pointer-events: none;
            opacity: 0.1;
        }

        /* Reading Progress */
        #reading-progress { transform-origin: left; }
    </style>
</head>
<body class="selection:bg-accent selection:text-black min-h-screen flex flex-col overflow-x-hidden">
    <div class="grain-overlay"></div>
    <div class="scanlines"></div>
    <div class="vignette"></div>
    
    <!-- Custom Cursor -->
    <div id="cursor"></div>
    <div id="cursor-follower"></div>


    <!-- Reading Progress Bar -->
    <div class="fixed top-0 left-0 h-0.5 bg-accent z-[60] transition-all duration-300 ease-out" id="reading-progress" style="width: 0%;"></div>

    <!-- Floating Action -->
    <div class="wa-protocol reveal">
        <a href="https://wa.me/6281330012100" target="_blank" class="flex items-center gap-4 group interactive">
            <span class="text-[9px] font-black uppercase tracking-[0.4em] text-white opacity-0 group-hover:opacity-100 transition-all">0813 3001 2100_</span>
            <div class="w-14 h-14 border border-white/20 flex items-center justify-center bg-transparent group-hover:bg-accent group-hover:border-accent transition-all">
                <i data-lucide="message-square" class="w-5 h-5 text-white"></i>
            </div>
        </a>
    </div>

    <!-- Floating Organic Nav -->
    <nav id="main-nav" class="fixed top-0 left-0 w-full z-[100] glass-organic px-6 lg:px-12 h-24 flex items-center justify-between shadow-sm transition-all duration-500 flex-nowrap">
        <div class="flex items-center gap-10 lg:gap-16 flex-nowrap">
            <a href="{{ route('home') }}" class="group interactive shrink-0">
                <span class="text-2xl lg:text-3xl font-serif italic text-accent whitespace-nowrap">Puncak&Bara</span>
            </a>
            <div class="hidden lg:flex items-center gap-10 opacity-60 flex-nowrap">
                <a class="text-[10px] font-bold uppercase tracking-[0.3em] hover:text-accent transition-all interactive whitespace-nowrap" href="{{ route('explore') }}">Expeditions</a>
                <a class="text-[10px] font-bold uppercase tracking-[0.3em] hover:text-accent transition-all interactive whitespace-nowrap" href="{{ route('blog') }}">Archives</a>
                <a class="text-[10px] font-bold uppercase tracking-[0.3em] hover:text-accent transition-all interactive whitespace-nowrap" href="{{ route('blog') }}">Journal</a>
            </div>
        </div>
        
        <div class="flex items-center gap-4 lg:gap-10 shrink-0 flex-nowrap">
            <div class="flex items-center gap-4 lg:gap-8 flex-nowrap">
                @if(Auth::check())
                    <a href="{{ route('user.dashboard') }}" class="text-[10px] font-bold uppercase tracking-[0.3em] border border-accent/20 px-6 lg:px-8 py-3 hover:bg-accent hover:text-white transition-all interactive whitespace-nowrap">Terminal_</a>
                @else
                    <a href="{{ route('login') }}" class="hidden md:block text-[10px] font-bold uppercase tracking-[0.3em] interactive text-primary hover:text-accent whitespace-nowrap">Login</a>
                    <a href="{{ route('register') }}" class="bg-accent text-white px-6 lg:px-10 py-4 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-primary transition-all interactive shadow-xl whitespace-nowrap">Begin Journey</a>
                @endif
            </div>

            <!-- Mobile Toggle -->
            <button onclick="toggleMobileMenu()" class="lg:hidden w-10 h-10 flex flex-col items-center justify-center gap-1.5 interactive shrink-0">
                <div class="w-6 h-0.5 bg-accent"></div>
                <div class="w-6 h-0.5 bg-accent"></div>
                <div class="w-4 h-0.5 bg-accent self-end"></div>
            </button>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="fixed inset-0 bg-[#F3F2EE] z-[200] translate-x-full transition-transform duration-700 flex flex-col p-12">
            <div class="flex justify-between items-center mb-24">
                <span class="text-2xl font-serif italic text-accent">Menu_</span>
                <button onclick="toggleMobileMenu()" class="text-[10px] font-bold uppercase tracking-[0.5em] text-accent">Close_</button>
            </div>
            <div class="flex flex-col gap-12 mb-24">
                <a href="{{ route('home') }}" class="text-5xl font-serif italic text-primary">Home_</a>
                <a href="{{ route('explore') }}" class="text-5xl font-serif italic text-primary">Expeditions_</a>
                <a href="{{ route('blog') }}" class="text-5xl font-serif italic text-primary">Archives_</a>
                <a href="{{ route('blog') }}" class="text-5xl font-serif italic text-primary">Journal_</a>
            </div>
            <div class="mt-auto flex flex-col gap-6">
                @if(Auth::guard('web')->check())
                    <a href="{{ route('user.dashboard') }}" class="bg-accent text-white text-center py-6 text-[12px] font-bold uppercase tracking-[0.5em]">Terminal_</a>
                @else
                    <a href="{{ route('login') }}" class="border border-accent/20 text-center py-6 text-[12px] font-bold uppercase tracking-[0.5em]">Login_</a>
                    <a href="{{ route('register') }}" class="bg-accent text-white text-center py-6 text-[12px] font-bold uppercase tracking-[0.5em]">Begin Journey_</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Side Altitude Tracker (Nature Style) -->
    <div class="fixed right-6 top-1/2 -translate-y-1/2 z-50 hidden 2xl:flex flex-col items-center gap-20 pointer-events-none opacity-20 transition-opacity hover:opacity-40">
        <div class="h-32 w-px bg-accent/40"></div>
        <div class="rotate-90 origin-center text-[10px] font-bold uppercase tracking-[0.8em] whitespace-nowrap text-accent">ELEVATION_TRACKER</div>
        <div class="h-32 w-px bg-accent/40"></div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Bespoke Footer -->
    <footer class="bg-black text-white pt-32 pb-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-20 pb-32 border-b border-white/5">
                <div class="lg:col-span-6 space-y-12">
                    <div class="space-y-4">
                        <span class="text-[10px] font-black uppercase tracking-[0.6em] text-accent">THE MANIFESTO</span>
                        <h2 class="text-6xl md:text-[5.5rem] font-black tracking-tighter uppercase leading-[0.8]">Architects of <br/><span class="italic font-serif font-light lowercase tracking-normal">high-altitude</span> <br/>experience.</h2>
                    </div>
                    <div class="flex flex-col md:flex-row gap-12 items-start md:items-center">
                        <div class="space-y-4">
                            <span class="text-[9px] font-black text-gray-600 uppercase tracking-[0.4em]">Direct Protocol</span>
                            <p class="text-xl font-black italic tracking-tighter">0813 3001 2100</p>
                        </div>
                        <div class="w-px h-12 bg-white/10 hidden md:block"></div>
                        <div class="space-y-2">
                            <a href="#" class="text-[10px] font-black uppercase tracking-[0.4em] hover:text-accent transition-colors interactive">Instagram_</a>
                            <a href="#" class="text-[10px] font-black uppercase tracking-[0.4em] hover:text-accent transition-colors interactive block">Archive.org_</a>
                        </div>
                    </div>
                </div>
                
                <div class="lg:col-span-3 space-y-10">
                    <h4 class="text-[9px] font-black uppercase tracking-[0.6em] text-gray-500">Navigation_Archive</h4>
                    <ul class="space-y-4 text-[10px] font-black uppercase tracking-[0.3em]">
                        <li><a href="{{ route('explore') }}" class="hover:text-accent transition-colors interactive">The Expeditions</a></li>
                        <li><a href="{{ route('blog') }}" class="hover:text-accent transition-colors interactive">The Logbook</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-accent transition-colors interactive">The Identity</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-accent transition-colors interactive">Contact Protocol</a></li>
                    </ul>
                </div>

                <div class="lg:col-span-3 space-y-10">
                    <h4 class="text-[9px] font-black uppercase tracking-[0.6em] text-gray-500">Communication</h4>
                    <p class="text-[10px] text-gray-500 leading-relaxed font-medium">For technical briefings or logistical inquiries, contact the field team directly via encrypted channels.</p>
                    <div class="pt-4 border-t border-white/5">
                        <span class="text-[8px] font-black text-accent uppercase tracking-[0.8em]">MEMBER OF SANFORD ARCHIVE</span>
                    </div>
                </div>
            </div>
            
            <div class="pt-16 flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="flex flex-col gap-2">
                    <span class="text-[9px] font-black text-gray-600 uppercase tracking-[0.5em]">&copy; 2026 PUNCAK & BARA. ALL RIGHTS RESERVED.</span>
                    <span class="text-[8px] font-black text-gray-800 uppercase tracking-[0.3em]">EST. 2024 / INDONESIA</span>
                </div>
                
                <div class="flex items-center gap-12">
                    <div class="flex flex-col items-end">
                        <span class="text-[8px] font-black text-gray-500 uppercase tracking-[0.4em]">Handcrafted by</span>
                        <span class="text-[11px] font-black tracking-[0.4em] uppercase text-accent group interactive">INXDVI_</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // 1. Core System: Tactical Briefing
        lucide.createIcons();

        // 2. Structural Architecture: Cursor & HUD
        const cursor = document.getElementById('cursor');
        const follower = document.getElementById('cursor-follower');
        const hudCoords = document.getElementById('hud-coords');
        const nav = document.getElementById('main-nav');
        
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;
        let isMagnetic = false;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            if (cursor) {
                cursor.style.left = mouseX + 'px';
                cursor.style.top = mouseY + 'px';
            }
            
            // Diagnostics: Update HUD
            if (hudCoords) {
                hudCoords.innerText = `${String(mouseX).padStart(4, '0')} // ${String(mouseY).padStart(4, '0')}`;
            }
        });

        // 3. Motion Engine: Elastic Follower & Magnetic Pull
        function animateFollower() {
            if (follower && !isMagnetic) {
                followerX += (mouseX - followerX) * 0.15;
                followerY += (mouseY - followerY) * 0.15;
                follower.style.left = (followerX - 20) + 'px';
                follower.style.top = (followerY - 20) + 'px';
            }
            requestAnimationFrame(animateFollower);
        }
        animateFollower();

        // 4. Interactive Protocol: Magnetics & Hover
        document.querySelectorAll('.interactive').forEach(el => {
            el.addEventListener('mouseenter', (e) => {
                document.body.classList.add('interactive-hover');
                // Magnetic effect
                const bounds = el.getBoundingClientRect();
                const centerX = bounds.left + bounds.width / 2;
                const centerY = bounds.top + bounds.height / 2;
                
                isMagnetic = true;
                if (follower) {
                    follower.style.transition = 'all 0.5s cubic-bezier(0.23, 1, 0.32, 1)';
                    follower.style.left = (centerX - 24) + 'px';
                    follower.style.top = (centerY - 24) + 'px';
                    follower.style.width = (bounds.width + 12) + 'px';
                    follower.style.height = (bounds.height + 12) + 'px';
                    follower.style.transform = 'translate(-6px, -6px)';
                }
            });

            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('interactive-hover');
                isMagnetic = false;
                if (follower) {
                    follower.style.transition = '';
                    follower.style.width = '40px';
                    follower.style.height = '40px';
                    follower.style.transform = '';
                }
            });
        });

        // 5. Environmental Dynamics: Reading Progress & Reveal
        const progressBar = document.getElementById('reading-progress');
        
        window.addEventListener('scroll', () => {
            if (nav) {
                if (window.scrollY > 20) {
                    nav.classList.add('shadow-xl', 'h-20');
                    nav.classList.remove('shadow-sm', 'h-24');
                } else {
                    nav.classList.remove('shadow-xl', 'h-20');
                    nav.classList.add('shadow-sm', 'h-24');
                }
            }

            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            if (progressBar) progressBar.style.width = scrolled + "%";
        });

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    entry.target.querySelectorAll('.reveal-child').forEach((child, i) => {
                        setTimeout(() => child.classList.add('active'), i * 150);
                    });
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal').forEach(el => {
            el.classList.add('ready'); // Hide for animation only if JS is working
            revealObserver.observe(el);
        });

        const mobileMenu = document.getElementById('mobile-menu');
        function toggleMobileMenu() {
            if (mobileMenu) {
                mobileMenu.classList.toggle('translate-x-full');
            }
        }
    </script>
    
    <!-- Tactical HUD Element -->
    <div class="fixed top-32 left-6 z-[60] hidden 2xl:flex flex-col gap-4 opacity-15 pointer-events-none">
        <div class="space-y-1">
            <p class="text-[8px] font-black text-primary uppercase tracking-[0.5em]">POSITION_PROTOCOL</p>
            <p id="hud-coords" class="text-[10px] font-black text-accent font-mono">0000 // 0000</p>
        </div>
        <div class="space-y-1">
            <p class="text-[8px] font-black text-primary uppercase tracking-[0.5em]">SYSTEM_ARCHIVE</p>
            <p class="text-[10px] font-black text-primary uppercase tracking-widest">STATE_OPERATIONAL</p>
        </div>
    </div>
    
    <div id="toast-container" class="fixed top-24 right-6 z-[60] flex flex-col gap-4 max-w-sm w-full pointer-events-none"></div>

    @yield('scripts')
</body>
</html>
