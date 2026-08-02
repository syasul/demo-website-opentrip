<!DOCTYPE html>
<html class="scroll-smooth" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Puncak & Bara | Open Trip Pendakian Gunung Profesional')</title>
    
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="/favicon.ico"/>
    <link rel="icon" type="image/png" href="/images/favicon.png" sizes="32x32"/>

    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <!-- Vite Assets (app.css & app.jsx) -->
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])

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
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-base);
            color: var(--primary);
            cursor: none;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Custom Premium Cursor */
        #cursor {
            width: 8px; height: 8px;
            background: var(--accent);
            border-radius: 50%;
            position: fixed; pointer-events: none;
            z-index: 10000;
            transition: transform 0.1s ease;
        }

        #cursor-follower {
            width: 40px; height: 40px;
            border: 1px solid var(--accent);
            border-radius: 50%;
            position: fixed; pointer-events: none;
            z-index: 9999;
            transition: left 0.15s cubic-bezier(0.25, 1, 0.5, 1), top 0.15s cubic-bezier(0.25, 1, 0.5, 1), transform 0.2s ease, width 0.2s ease, height 0.2s ease;
        }

        .cursor-hover #cursor { transform: scale(2.5); background: var(--accent); mix-blend-mode: difference; }
        .cursor-hover #cursor-follower { transform: scale(1.5); border-color: var(--accent); opacity: 0.5; }

        @media (max-width: 1024px) {
            #cursor, #cursor-follower { display: none !important; }
            body { cursor: auto !important; }
        }

        /* Tactical Overlays */
        .scanlines {
            position: fixed; inset: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.05) 50%), linear-gradient(90deg, rgba(255, 0, 0, 0.01), rgba(0, 255, 0, 0.005), rgba(0, 0, 255, 0.01));
            z-index: 9998; background-size: 100% 2px, 3px 100%;
            pointer-events: none;
            opacity: 0.08;
        }
        
        .vignette {
            position: fixed; inset: 0;
            background: radial-gradient(circle, transparent 50%, rgba(0,0,0,0.12) 100%);
            z-index: 9997; pointer-events: none;
        }

        /* Animated Grain */
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
            opacity: 0.04; z-index: 9999; pointer-events: none;
            animation: noise 2s steps(4) infinite;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--accent); }
        ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

        /* Floating WA Protocol */
        .wa-protocol {
            position: fixed; bottom: 40px; right: 40px;
            z-index: 90;
        }
    </style>
</head>
<body class="selection:bg-[#3D5A47] selection:text-white min-h-screen flex flex-col overflow-x-hidden">
    <div class="grain-overlay"></div>
    <div class="scanlines"></div>
    <div class="vignette"></div>
    
    <!-- Custom Cursor elements -->
    <div id="cursor"></div>
    <div id="cursor-follower"></div>

    <!-- Reading Progress Bar -->
    <div class="fixed top-0 left-0 h-0.5 bg-[#3D5A47] z-[110] transition-all duration-300 ease-out" id="reading-progress" style="width: 0%;"></div>

    <!-- Floating Action WhatsApp -->
    <div class="wa-protocol">
        <a href="https://wa.me/6281330012100" target="_blank" rel="noreferrer" class="flex items-center gap-4 group interactive">
            <span class="text-[9px] font-bold uppercase tracking-[0.4em] text-[#3D5A47] opacity-0 group-hover:opacity-100 transition-all bg-[#F3F2EE]/90 px-3 py-1.5 border border-[#3D5A47]/10">0813 3001 2100_</span>
            <div class="w-14 h-14 border border-[#3D5A47]/20 flex items-center justify-center bg-[#F3F2EE]/80 backdrop-blur-md group-hover:bg-[#3D5A47] group-hover:border-[#3D5A47] transition-all shadow-md">
                <svg class="w-5 h-5 text-[#3D5A47] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
            </div>
        </a>
    </div>

    <!-- React Navbar Container Mount -->
    <div id="navbar-root" data-props="{{ json_encode([
        'auth' => [
            'check' => Auth::check(),
            'user' => Auth::user(),
        ],
        'routes' => [
            'explore' => route('explore'),
            'blog' => route('blog'),
            'about' => route('about'),
            'contact' => route('contact')
        ]
    ]) }}"></div>

    <!-- Main Content Yield -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- React Footer Container Mount -->
    <div id="footer-root"></div>

    <!-- Global Layout Scripts -->
    <script>
        // Custom Cursor Logic
        const cursor = document.getElementById('cursor');
        const follower = document.getElementById('cursor-follower');
        
        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            if (cursor) {
                cursor.style.left = mouseX + 'px';
                cursor.style.top = mouseY + 'px';
            }
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

        // Mouse hover interactions
        document.addEventListener('mouseover', (e) => {
            const isInteractive = e.target.closest('a, button, input, select, textarea, [role="button"]');
            if (isInteractive) {
                document.body.classList.add('cursor-hover');
            } else {
                document.body.classList.remove('cursor-hover');
            }
        });

        // Reading progress scroll logic
        const progressBar = document.getElementById('reading-progress');
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            if (progressBar) progressBar.style.width = scrolled + "%";
        });
    </script>
    
    <div id="toast-container" class="fixed top-24 right-6 z-[60] flex flex-col gap-4 max-w-sm w-full pointer-events-none"></div>

    @yield('scripts')
</body>
</html>
