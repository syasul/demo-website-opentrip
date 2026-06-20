@extends('layouts.layout')

@section('title', 'Puncak & Bara | Premium Open Trip Pendakian Gunung Indonesia')

@section('content')
<!-- Outer Hero Wrapper to make it float inside capsule layout -->
<div class="px-4 pt-4 md:px-6 md:pt-6 max-w-8xl mx-auto w-full relative">
    <!-- Ambient Glowing Blobs inside the page margin for depth -->
    <div class="absolute -top-20 left-1/4 w-80 h-80 bg-primary-light/15 rounded-full blur-[100px] animate-pulse-slow pointer-events-none z-0"></div>
    <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-secondary/10 rounded-full blur-[120px] animate-pulse-slow pointer-events-none z-0" style="animation-delay: 2s;"></div>

    <!-- Hero Section with Mountain Parallax Feel (capsule image style) -->
    <section class="relative min-h-[90vh] lg:min-h-[85vh] flex items-center justify-center overflow-hidden bg-slate-950 text-white rounded-[2.5rem] shadow-2xl border border-white/10 z-10 py-12 lg:py-20">
        <!-- Autoplay Carousel Mountain Backgrounds -->
        <div id="hero-carousel" class="absolute inset-0 w-full h-full">
            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-[1500ms] opacity-80" alt="Mountain 1">
            <img src="https://images.unsplash.com/photo-1589182373726-e4f658ab50f0?auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-[1500ms] opacity-0" alt="Mountain 2">
            <img src="https://images.unsplash.com/photo-1568230315894-1edd16d248b7?auto=format&fit=crop&w=1920&q=80" class="absolute inset-0 w-full h-full object-cover object-center transition-opacity duration-[1500ms] opacity-0" alt="Mountain 3">
        </div>
        
        <!-- Double Gradient Overlay for perfect text visibility and rich lighting -->
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-slate-950/40"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/25 to-transparent"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-8 text-center lg:text-left lg:grid lg:grid-cols-12 lg:gap-12 items-center w-full">
            <!-- Left Side: Content & Search -->
            <div class="space-y-8 lg:col-span-7 flex flex-col justify-center">
                <!-- Premium Badge with pulsing ring -->
                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 text-secondary text-[10px] font-extrabold uppercase tracking-widest animate-float shadow-xl self-center lg:self-start">
                    <span class="flex h-2 w-2 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-secondary"></span>
                    </span>
                    <i data-lucide="award" class="w-3.5 h-3.5 text-secondary"></i> #1 Pemandu Berlisensi APGI
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold leading-tight font-serif tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)]">
                    Sentuh Langit<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-secondary via-accent-orange to-accent-blue drop-shadow-sm">Indonesia.</span>
                </h1>
                
                <p class="text-sm md:text-base text-white/90 max-w-xl font-sans leading-relaxed drop-shadow-sm mx-auto lg:mx-0">
                    Penyedia Open Trip pendakian gunung dengan standar keselamatan tinggi, porter berpengalaman, dan menu makanan hangat bergizi di setiap camp.
                </p>

                <!-- Search Bar Container with enhanced glassmorphism -->
                <div class="max-w-2xl bg-white/10 backdrop-blur-xl p-2.5 rounded-3xl md:rounded-full shadow-2xl flex flex-col md:flex-row gap-2 border border-white/25">
                    <form action="{{ route('explore') }}" method="GET" class="w-full flex flex-col md:flex-row gap-2 relative">
                        <div class="flex-grow flex items-center gap-3 px-4 py-2 border-b md:border-b-0 md:border-r border-white/10 focus-within:ring-1 focus-within:ring-white/20 rounded-full transition-all relative">
                            <i data-lucide="search" class="w-4.5 h-4.5 text-white/70"></i>
                            <input type="text" id="search-input" name="search" autocomplete="off" placeholder="Cari Rinjani, Semeru, Gede..." class="bg-transparent border-0 outline-none text-white text-xs w-full placeholder-white/50">
                            <!-- Autocomplete dropdown -->
                            <div id="search-suggestions" class="absolute left-0 right-0 top-full mt-4 bg-white text-text-dark rounded-2xl shadow-2xl border border-primary/5 p-3 hidden z-50 max-h-60 overflow-y-auto"></div>
                        </div>
                        
                        <div class="flex items-center gap-3 px-4 py-2 border-b md:border-b-0 md:border-r border-white/10 min-w-[160px] focus-within:ring-1 focus-within:ring-white/20 rounded-full transition-all">
                            <i data-lucide="gauge" class="w-4.5 h-4.5 text-white/70"></i>
                            <select name="difficulty" class="bg-transparent border-0 outline-none text-white text-xs w-full font-bold cursor-pointer [appearance:none] [&_option]:text-text-dark">
                                <option value="" class="text-text-dark">Kesulitan</option>
                                <option value="Pemula" class="text-text-dark">Pemula</option>
                                <option value="Menengah" class="text-text-dark">Menengah</option>
                                <option value="Tinggi" class="text-text-dark">Tinggi</option>
                            </select>
                        </div>
 
                        <button type="submit" class="bg-secondary hover:bg-secondary/90 text-primary font-extrabold text-xs px-8 py-3 rounded-full transition-all shadow-lg hover:scale-[1.03] active:scale-[0.97] whitespace-nowrap">
                            Cari Petualangan
                        </button>
                    </form>
                </div>

                <!-- Desktop Horizontal Minimalist Stats Pills -->
                <div class="hidden lg:flex items-center gap-4 pt-4">
                    <div class="glass-card px-5 py-2.5 rounded-2xl flex items-center gap-3 border border-white/25 shadow-md">
                        <span class="text-xl font-bold font-serif text-white">1.2k+</span>
                        <span class="text-[9px] font-bold text-white/70 uppercase tracking-widest leading-none">Pendaki<br/>Puas</span>
                    </div>
                    <div class="glass-card px-5 py-2.5 rounded-2xl flex items-center gap-3 border border-white/25 shadow-md">
                        <span class="text-xl font-bold font-serif text-white">15+</span>
                        <span class="text-[9px] font-bold text-white/70 uppercase tracking-widest leading-none">Gunung<br/>Aktif</span>
                    </div>
                    <div class="glass-card px-5 py-2.5 rounded-2xl flex items-center gap-3 border border-white/25 shadow-md">
                        <span class="text-xl font-bold font-serif text-secondary">99.8%</span>
                        <span class="text-[9px] font-bold text-white/70 uppercase tracking-widest leading-none">Safety<br/>Rate</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Interactive Layered Card Deck -->
            <div class="lg:col-span-5 mt-16 lg:mt-0 hidden lg:flex items-center justify-center relative h-[450px] w-full">
                <!-- Stack Background Card (Mount Semeru) -->
                <div class="absolute w-[280px] h-[360px] rounded-[2.5rem] overflow-hidden border border-white/10 shadow-2xl opacity-60 rotate-6 translate-x-12 translate-y-4 transition-all duration-500 hover:opacity-85 hover:scale-[1.02] pointer-events-none">
                    <img src="https://images.unsplash.com/photo-1624467576579-be2fb9795ff0?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Gunung Semeru">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 text-left">
                        <span class="text-[8px] font-bold uppercase tracking-widest text-secondary block">East Java</span>
                        <span class="font-serif text-lg font-bold text-white">Mount Semeru</span>
                    </div>
                </div>

                <!-- Main Front Card (Mount Rinjani) -->
                <div class="absolute w-[290px] h-[380px] rounded-[2.5rem] overflow-hidden border border-white/25 shadow-2xl -rotate-3 transition-all duration-500 hover:rotate-0 hover:scale-[1.03] group animate-float-slow bg-slate-900/40 z-10">
                    <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="Gunung Rinjani">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/30 to-transparent"></div>
                    
                    <!-- Card Badges -->
                    <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-md px-3.5 py-1.5 rounded-full text-[9px] font-extrabold text-primary border border-primary/5 shadow-md flex items-center gap-1.5">
                        <i data-lucide="map-pin" class="w-3 h-3 text-secondary"></i> Lombok
                    </div>
                    <div class="absolute top-6 right-6 bg-secondary text-primary px-3 py-1.5 rounded-full text-[9px] font-extrabold shadow-md flex items-center gap-1">
                        <i data-lucide="star" class="w-3 h-3 text-primary fill-primary"></i> 4.9
                    </div>

                    <!-- Bottom Info panel -->
                    <div class="absolute bottom-6 left-6 right-6 text-left space-y-3">
                        <div>
                            <span class="text-[8px] font-bold uppercase tracking-widest text-secondary block">3,726 MDPL</span>
                            <span class="font-serif text-xl font-bold text-white">Gunung Rinjani</span>
                        </div>
                        <div class="flex justify-between items-center pt-2.5 border-t border-white/10">
                            <div class="flex flex-col">
                                <span class="text-[7px] uppercase tracking-wider text-white/50 font-bold leading-none">Mulai dari</span>
                                <span class="text-sm font-extrabold text-secondary mt-0.5">Rp 1.500.000</span>
                            </div>
                            <a href="{{ route('explore') }}?search=Rinjani" class="bg-primary hover:bg-primary-light text-white font-extrabold text-[9px] px-4 py-2.5 rounded-full transition-all shadow-md">
                                Pesan Trip
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Floating Review Pill -->
                <div class="absolute -bottom-4 -left-6 bg-slate-950/95 backdrop-blur-xl border border-white/15 px-4 py-3 rounded-2xl shadow-2xl flex items-center gap-2.5 animate-float-reverse z-20 max-w-[210px] text-left">
                    <div class="w-8 h-8 rounded-full bg-secondary/30 border border-secondary flex items-center justify-center text-xs font-bold text-secondary shrink-0">R</div>
                    <div class="flex flex-col">
                        <span class="text-[8px] font-bold text-white/50 leading-none">Ulasan Pendaki</span>
                        <span class="text-[9px] text-white font-medium mt-1 leading-snug">"Porter ramah & makanannya enak!"</span>
                    </div>
                </div>

                <!-- Floating Safety badge seal -->
                <div class="absolute -top-4 -right-2 w-16 h-16 rounded-full bg-primary border border-secondary flex flex-col items-center justify-center shadow-xl animate-float-slow z-20">
                    <i data-lucide="shield-check" class="w-5 h-5 text-secondary"></i>
                    <span class="text-[6px] font-extrabold uppercase tracking-widest text-white mt-1">100% Aman</span>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Mobile Stats Panel (only shows on small screens where inset stats is hidden) -->
<section class="lg:hidden max-w-8xl mx-auto px-4 md:px-8 mt-6">
    <div class="glass-card rounded-[2.5rem] p-8 shadow-lg border border-white/60 grid grid-cols-2 gap-6 text-center">
        <div class="space-y-1">
            <span class="text-2xl font-extrabold font-serif text-primary">1.2k+</span>
            <p class="text-[9px] font-bold text-text-dark/50 uppercase tracking-wider">Pendaki Puas</p>
        </div>
        <div class="space-y-1">
            <span class="text-2xl font-extrabold font-serif text-primary">15+</span>
            <p class="text-[9px] font-bold text-text-dark/50 uppercase tracking-wider">Gunung Aktif</p>
        </div>
        <div class="space-y-1">
            <span class="text-2xl font-extrabold font-serif text-secondary">99.8%</span>
            <p class="text-[9px] font-bold text-text-dark/50 uppercase tracking-wider">Safety Rate</p>
        </div>
        <div class="space-y-1">
            <span class="text-2xl font-extrabold font-serif text-primary">50+</span>
            <p class="text-[9px] font-bold text-text-dark/50 uppercase tracking-wider">Pemandu APGI</p>
        </div>
    </div>
</section>

<!-- Values Section (Why Us) -->
<section class="max-w-8xl mx-auto px-4 md:px-8 py-24 relative">
    <!-- Asymmetric Section Header Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
        <div class="lg:col-span-7">
            <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Mengapa Memilih Kami?</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Standar Baru Keamanan Pendakian</h2>
        </div>
        <div class="lg:col-span-5">
            <p class="text-text-dark/65 text-sm leading-relaxed max-w-lg">
                Kami tidak sekadar membawa Anda naik gunung. Kami merancang petualangan yang aman, terencana, dan menyenangkan dengan standar kenyamanan premium di atas awan.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Value Item 1 -->
        <div class="glass-card p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex flex-col space-y-6 border border-white/60 group reveal">
            <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-500 shadow-md">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold font-serif text-primary">Safety First Protocol</h3>
            <p class="text-text-dark/70 text-xs leading-relaxed">
                Pemeriksaan kesehatan peserta sebelum mendaki, pembekalan obat-obatan darurat lengkap, dan pemandu bersertifikat APGI yang siap siaga.
            </p>
        </div>

        <!-- Value Item 2 -->
        <div class="glass-card p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex flex-col space-y-6 border border-white/60 group reveal" style="animation-delay: 100ms;">
            <div class="w-14 h-14 rounded-2xl bg-secondary/10 flex items-center justify-center text-secondary group-hover:bg-secondary group-hover:text-primary transition-all duration-500 shadow-md">
                <i data-lucide="chef-hat" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold font-serif text-primary">Menu Premium Camp</h3>
            <p class="text-text-dark/70 text-xs leading-relaxed">
                Tidak ada mi instan setiap hari. Porter kami menyajikan sup hangat, ayam goreng, buah segar, susu, dan teh jahe di area berkemah.
            </p>
        </div>

        <!-- Value Item 3 -->
        <div class="glass-card p-10 rounded-[2.5rem] shadow-sm hover:shadow-xl hover:scale-[1.03] transition-all duration-300 flex flex-col space-y-6 border border-white/60 group reveal" style="animation-delay: 200ms;">
            <div class="w-14 h-14 rounded-2xl bg-accent-blue/20 flex items-center justify-center text-primary-light group-hover:bg-primary-light group-hover:text-white transition-all duration-500 shadow-md">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold font-serif text-primary">Grup Terbatas (Max 15)</h3>
            <p class="text-text-dark/70 text-xs leading-relaxed">
                Kami membatasi jumlah kuota per trip untuk memastikan rasio pemandu dan peserta tetap ideal demi keselamatan bersama.
            </p>
        </div>
    </div>
</section>

<!-- Featured Trips Section (Asymmetric Bento Layout) -->
<section class="bg-bg-alt py-24 border-y border-primary/5 relative">
    <!-- Soft light behind trip grid -->
    <div class="absolute bottom-1/4 left-10 w-96 h-96 bg-primary/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-8xl mx-auto px-4 md:px-8">
        <!-- Asymmetric Header -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
            <div class="lg:col-span-7">
                <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Petualangan Terdekat</span>
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Jadwal Trip Terdekat</h2>
            </div>
            <div class="lg:col-span-5 flex flex-col items-start lg:items-end justify-between h-full">
                <p class="text-text-dark/65 text-sm leading-relaxed max-w-md mb-6 lg:text-right">
                    Pilih petualangan terdekat Anda dan rasakan pendakian premium dengan standar pelayanan bintang lima.
                </p>
                <a href="{{ route('explore') }}" class="group inline-flex items-center gap-2 text-primary hover:text-primary-light font-extrabold text-xs border-b-2 border-primary pb-1 transition-all">
                    Lihat Semua Gunung <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                </a>
            </div>
        </div>

        @php
            $featuredTrip = $trips->first();
            $otherTrips = $trips->skip(1);
        @endphp

        <!-- Horizontal Category Chips -->
        <div class="flex items-center gap-3 overflow-x-auto pb-6 mb-10 scrollbar-none scroll-smooth">
            <button onclick="filterTrips('Semua', this)" class="category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-primary text-white transition-all shadow-sm flex items-center gap-1.5 shrink-0">
                <i data-lucide="compass" class="w-3.5 h-3.5"></i> Semua
            </button>
            <button onclick="filterTrips('Pemula', this)" class="category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-white text-text-dark/70 hover:bg-primary/5 transition-all flex items-center gap-1.5 shrink-0">
                <i data-lucide="users" class="w-3.5 h-3.5"></i> Pemula
            </button>
            <button onclick="filterTrips('Menengah', this)" class="category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-white text-text-dark/70 hover:bg-primary/5 transition-all flex items-center gap-1.5 shrink-0">
                <i data-lucide="shield" class="w-3.5 h-3.5"></i> Menengah
            </button>
            <button onclick="filterTrips('Tinggi', this)" class="category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-white text-text-dark/70 hover:bg-primary/5 transition-all flex items-center gap-1.5 shrink-0">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i> Tinggi
            </button>
        </div>

        @if($trips->isNotEmpty())
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Column: Featured Main Trip (Large Asymmetrical Card) -->
                @if($featuredTrip)
                    <div class="lg:col-span-7 glass-card rounded-[2.5rem] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-white/60 flex flex-col justify-between reveal group" data-difficulty="{{ $featuredTrip->level_kesulitan }}">
                        <div class="relative h-[28rem] shrink-0 overflow-hidden">
                            <img src="{{ $featuredTrip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[4000ms]" alt="{{ $featuredTrip->nama_gunung }}">
                            <!-- Blur Overlay at bottom of image for text readability -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
                            
                            <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-md px-4 py-2 rounded-full text-[10px] font-extrabold text-primary border border-primary/5 shadow-md flex items-center gap-1.5">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-secondary"></i> {{ $featuredTrip->location }}
                            </div>
                            <div class="absolute top-6 right-6 bg-primary text-white px-4 py-2 rounded-full text-[10px] font-extrabold shadow-md">
                                {{ $featuredTrip->level_kesulitan }}
                            </div>
                        </div>
                        
                        <div class="p-10 flex-grow flex flex-col justify-between space-y-6 bg-white/30">
                            <div class="space-y-4">
                                <h3 class="text-2xl md:text-4xl font-bold font-serif text-primary hover:text-primary-light transition-colors">
                                    <a href="{{ route('trips.show', $featuredTrip->slug) }}">{{ $featuredTrip->nama_gunung }}</a>
                                </h3>
                                <p class="text-text-dark/65 text-xs md:text-sm leading-relaxed line-clamp-3">
                                    {{ $featuredTrip->deskripsi }}
                                </p>
                            </div>
                            
                            <div class="pt-6 border-t border-primary/10 flex justify-between items-center text-xs text-text-dark/65 font-sans">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="calendar" class="w-4 h-4 text-secondary"></i>
                                    <span class="font-bold">{{ $featuredTrip->tanggal_berangkat->format('d M') }} - {{ $featuredTrip->tanggal_pulang->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-1.5 font-bold text-primary bg-primary/5 px-3 py-1 rounded-full">
                                    <i data-lucide="users-2" class="w-4 h-4 text-primary-light"></i>
                                    <span>Sisa {{ $featuredTrip->sisa_kuota }} Slot</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center pt-6 border-t border-primary/10">
                                <div class="flex flex-col">
                                    <span class="text-[9px] uppercase tracking-wider text-text-dark/50 font-bold leading-none">Harga Paket</span>
                                    <span class="text-2xl font-black text-secondary mt-1">Rp {{ number_format($featuredTrip->harga, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('trips.show', $featuredTrip->slug) }}" class="bg-primary hover:bg-primary-light text-white font-extrabold text-xs px-6 py-3.5 rounded-full transition-all hover:scale-105 shadow-md shadow-primary/20">
                                    Detail Trip
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Right Column: Other Smaller Trip Cards stacked vertically -->
                <div class="lg:col-span-5 flex flex-col justify-between gap-6">
                    @forelse($otherTrips as $trip)
                        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 border border-white/60 flex flex-col justify-between reveal group flex-grow" data-difficulty="{{ $trip->level_kesulitan }}">
                            <div class="relative h-48 shrink-0 overflow-hidden">
                                <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-[4000ms]" alt="{{ $trip->nama_gunung }}">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-full text-[9px] font-extrabold text-primary border border-primary/5 shadow-md flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3 h-3 text-secondary"></i> {{ $trip->location }}
                                </div>
                            </div>
                            
                            <div class="p-8 flex-grow flex flex-col justify-between space-y-4 bg-white/20">
                                <div class="space-y-2">
                                    <div class="flex justify-between items-center">
                                        <h3 class="text-lg font-bold font-serif text-primary hover:text-primary-light transition-colors">
                                            <a href="{{ route('trips.show', $trip->slug) }}">{{ $trip->nama_gunung }}</a>
                                        </h3>
                                        <span class="text-[9px] font-bold text-secondary uppercase tracking-widest bg-secondary/10 px-2 py-0.5 rounded-md">{{ $trip->level_kesulitan }}</span>
                                    </div>
                                    <p class="text-text-dark/65 text-xs line-clamp-2 leading-relaxed">
                                        {{ $trip->deskripsi }}
                                    </p>
                                </div>
                                
                                <div class="flex justify-between items-center pt-4 border-t border-primary/10">
                                    <div class="flex flex-col">
                                        <span class="text-[9px] uppercase tracking-wider text-text-dark/50 font-bold leading-none">Harga</span>
                                        <span class="text-lg font-extrabold text-secondary">Rp {{ number_format($trip->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <a href="{{ route('trips.show', $trip->slug) }}" class="bg-primary/10 hover:bg-primary text-primary hover:text-white font-extrabold text-[10px] px-5 py-2.5 rounded-full transition-all">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="h-full flex items-center justify-center text-text-dark/50 text-xs py-12 glass-card rounded-[2.5rem] border border-white/40">
                            Tidak ada trip pendakian lainnya saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        @else
            <div class="text-center py-12 text-text-dark/50">
                Belum ada trip aktif terjadwal saat ini.
            </div>
        @endif
    </div>
</section>

<!-- About Us Section (Merged Widget Capsule with rich depth) -->
<section class="max-w-8xl mx-auto px-4 md:px-8 py-24">
    <div class="rounded-[2.5rem] overflow-hidden grid grid-cols-1 lg:grid-cols-12 shadow-2xl border border-white/60">
        <!-- Left side: Forest Deep card with a beautiful gradient -->
        <div class="lg:col-span-5 bg-gradient-to-br from-primary to-primary-light text-white p-12 md:p-16 flex flex-col justify-between space-y-10 relative overflow-hidden group">
            <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-white/5 rounded-full blur-2xl pointer-events-none group-hover:scale-150 transition-transform duration-500"></div>
            
            <div class="space-y-6">
                <span class="text-xs font-bold text-secondary uppercase tracking-widest block">Tentang Kami</span>
                <h2 class="text-3xl md:text-4xl font-bold font-serif leading-tight">Melangkah Bersama Puncak & Bara</h2>
                <p class="text-white/80 text-xs md:text-sm leading-relaxed">
                    Puncak & Bara lahir dari cinta mendalam pada bentang alam Indonesia. Kami hadir untuk membuktikan bahwa mendaki gunung bisa dinikmati dengan aman, terencana, dan penuh kenyamanan, tanpa mengorbankan petualangan murni.
                </p>
            </div>
            <a href="{{ route('about') }}" class="w-max bg-white text-primary hover:bg-bg-light font-extrabold text-xs px-8 py-3.5 rounded-full transition-all hover:scale-105 shadow-lg">
                Pelajari Selengkapnya
            </a>
        </div>
        <!-- Right side: High quality image with gold sunset mask -->
        <div class="lg:col-span-7 h-80 lg:h-auto min-h-[400px] relative">
            <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80" class="absolute inset-0 w-full h-full object-cover" alt="Trekking together">
            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 via-transparent to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
        </div>
    </div>
</section>

<!-- Mountain Difficulty Guide (Bento Adventure Tiles) -->
<section class="max-w-8xl mx-auto px-4 md:px-8 py-24 relative">
    <div class="absolute top-10 right-10 w-80 h-80 bg-secondary/5 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Asymmetric Header -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
        <div class="lg:col-span-7">
            <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Panduan Fisik & Jalur</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Pilih Jalur Sesuai Batas Kemampuanmu</h2>
        </div>
        <div class="lg:col-span-5">
            <p class="text-text-dark/65 text-sm leading-relaxed max-w-lg">
                Kami mengklasifikasikan tingkat kesulitan pendakian untuk menjamin kenyamanan, kesiapan stamina, dan keselamatan perjalanan Anda.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Pemula -->
        <a href="{{ route('explore', ['difficulty' => 'Pemula']) }}" class="relative h-[26rem] rounded-[2.5rem] overflow-hidden group shadow-md hover:shadow-2xl transition-all duration-500 border border-white/40 flex flex-col justify-end reveal">
            <!-- Full Background Image -->
            <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=600&q=80" 
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                 alt="Mountain Easy">
            <!-- Dark Gradient mask -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            
            <div class="absolute top-6 left-6">
                <span class="px-3 py-1.5 rounded-full bg-emerald-500/25 backdrop-blur-md text-emerald-400 text-[9px] font-extrabold uppercase tracking-widest border border-emerald-400/30">Pemula</span>
            </div>
            
            <div class="relative z-10 p-8 space-y-3 text-white">
                <h3 class="text-2xl font-bold font-serif leading-tight">Jalur Ramah Pemula</h3>
                <p class="text-white/70 text-xs leading-relaxed line-clamp-3">
                    Trek landai, waktu tempuh 4-6 jam, dan fasilitas basecamp lengkap. Sempurna untuk pendakian pertama atau liburan santai akhir pekan.
                </p>
                <div class="text-[10px] font-extrabold text-secondary flex items-center gap-1.5 pt-2 group-hover:translate-x-1.5 transition-transform">
                    Cari Trip Pemula <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </a>

        <!-- Menengah -->
        <a href="{{ route('explore', ['difficulty' => 'Menengah']) }}" class="relative h-[26rem] rounded-[2.5rem] overflow-hidden group shadow-md hover:shadow-2xl transition-all duration-500 border border-white/40 flex flex-col justify-end reveal" style="animation-delay: 100ms;">
            <!-- Full Background Image -->
            <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?auto=format&fit=crop&w=600&q=80" 
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                 alt="Mountain Moderate">
            <!-- Dark Gradient mask -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            
            <div class="absolute top-6 left-6">
                <span class="px-3 py-1.5 rounded-full bg-amber-500/25 backdrop-blur-md text-amber-400 text-[9px] font-extrabold uppercase tracking-widest border border-amber-400/30">Menengah</span>
            </div>
            
            <div class="relative z-10 p-8 space-y-3 text-white">
                <h3 class="text-2xl font-bold font-serif leading-tight">Tantangan Moderat</h3>
                <p class="text-white/70 text-xs leading-relaxed line-clamp-3">
                    Jalur bervariasi dengan tanjakan curam, elevasi hingga 3.000 MDPL, dan camping 2 hari 1 malam. Membutuhkan stamina fisik yang baik.
                </p>
                <div class="text-[10px] font-extrabold text-secondary flex items-center gap-1.5 pt-2 group-hover:translate-x-1.5 transition-transform">
                    Cari Trip Menengah <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </a>

        <!-- Tinggi -->
        <a href="{{ route('explore', ['difficulty' => 'Tinggi']) }}" class="relative h-[26rem] rounded-[2.5rem] overflow-hidden group shadow-md hover:shadow-2xl transition-all duration-500 border border-white/40 flex flex-col justify-end reveal" style="animation-delay: 200ms;">
            <!-- Full Background Image -->
            <img src="https://images.unsplash.com/photo-1568230315894-1edd16d248b7?auto=format&fit=crop&w=600&q=80" 
                 class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                 alt="Mountain Challenging">
            <!-- Dark Gradient mask -->
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            
            <div class="absolute top-6 left-6">
                <span class="px-3 py-1.5 rounded-full bg-rose-500/25 backdrop-blur-md text-rose-400 text-[9px] font-extrabold uppercase tracking-widest border border-rose-400/30">Tinggi</span>
            </div>
            
            <div class="relative z-10 p-8 space-y-3 text-white">
                <h3 class="text-2xl font-bold font-serif leading-tight">Ekspedisi Ekstrem</h3>
                <p class="text-white/70 text-xs leading-relaxed line-clamp-3">
                    Trek ekstrem, cuaca dingin ekstrem, durasi 3-5 hari. Memerlukan latihan fisik serius, kesiapan mental, dan peralatan standar ekspedisi.
                </p>
                <div class="text-[10px] font-extrabold text-secondary flex items-center gap-1.5 pt-2 group-hover:translate-x-1.5 transition-transform">
                    Cari Trip Tinggi <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </div>
            </div>
        </a>
    </div>
</section>

<!-- Testimonial Section -->
<section class="max-w-8xl mx-auto px-4 md:px-8 py-24 border-t border-primary/5">
    <!-- Asymmetric Header -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
        <div class="lg:col-span-7">
            <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Testimoni</span>
            <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Suara dari Puncak Tertinggi</h2>
        </div>
        <div class="lg:col-span-5">
            <p class="text-text-dark/65 text-sm leading-relaxed max-w-lg">
                Ulasan terverifikasi langsung dari para pendaki yang telah menaklukkan puncak-puncak tertinggi nusantara bersama Puncak & Bara.
            </p>
        </div>
    </div>

    <div class="flex overflow-x-auto gap-8 pb-8 scrollbar-none snap-x" id="testimonial-slider">
        @forelse($reviews as $rev)
            <div class="glass-card p-10 rounded-[2.5rem] shadow-sm flex flex-col justify-between space-y-8 border border-white/60 relative group reveal shrink-0 w-80 md:w-96 snap-center">
                <!-- Large double quotation mark in background -->
                <span class="absolute top-4 right-8 text-8xl font-serif text-primary/5 select-none pointer-events-none font-black">“</span>
                
                <p class="text-text-dark/75 italic text-xs md:text-sm leading-relaxed relative z-10">
                    "{{ $rev->komentar }}"
                </p>
                
                <div class="flex items-center gap-3 pt-6 border-t border-primary/10">
                    <div class="w-10 h-10 rounded-full bg-secondary/15 text-primary flex items-center justify-center font-bold text-sm">
                        {{ substr($rev->user->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-primary">{{ $rev->user->name }}</span>
                        <span class="text-[9px] text-text-dark/50 font-sans">Mendaki {{ $rev->trip->nama_gunung }}</span>
                    </div>
                    <div class="ml-auto flex text-yellow-500">
                        @for($i=0; $i<$rev->rating; $i++)
                            <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                        @endfor
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-6 text-text-dark/50">
                Belum ada ulasan terverifikasi saat ini.
            </div>
        @endforelse
    </div>
</section>

<!-- Gallery Section (Galeri Petualangan) -->
<section class="bg-bg-alt py-24 border-y border-primary/5">
    <div class="max-w-8xl mx-auto px-4 md:px-8">
        <!-- Asymmetric Header -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
            <div class="lg:col-span-7">
                <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Galeri Foto</span>
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Momen Indah di Atas Awan</h2>
            </div>
            <div class="lg:col-span-5">
                <p class="text-text-dark/65 text-sm leading-relaxed max-w-lg">
                    Dokumentasi asli dari jepretan kamera perjalanan open trip pendakian bersama para pendaki kami.
                </p>
            </div>
        </div>

        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 [column-fill:_balance]">
            <!-- Item 1 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[380px] shadow-md group border border-white/60 reveal">
                <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Summit Rinjani">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Summit Rinjani</span>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[260px] shadow-md group border border-white/60 reveal" style="animation-delay: 50ms;">
                <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Ranu Kumbolo Camp">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Ranu Kumbolo</span>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[440px] shadow-md group border border-white/60 reveal" style="animation-delay: 100ms;">
                <img src="https://images.unsplash.com/photo-1526772662000-3f88f10405ff?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Surya Kencana Edelweiss">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Surya Kencana</span>
                </div>
            </div>

            <!-- Item 4 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[300px] shadow-md group border border-white/60 reveal" style="animation-delay: 150ms;">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Mountain Sunrise">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Awan Pagi</span>
                </div>
            </div>

            <!-- Item 5 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[420px] shadow-md group border border-white/60 reveal" style="animation-delay: 200ms;">
                <img src="https://images.unsplash.com/photo-1504280390367-361c6d9f38f4?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Camp Tent under Stars">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Camp Bintang</span>
                </div>
            </div>

            <!-- Item 6 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[280px] shadow-md group border border-white/60 reveal" style="animation-delay: 250ms;">
                <img src="https://images.unsplash.com/photo-1470240731273-7821a6eeb6bd?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Sunrise Forest Trail">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Jalur Hutan</span>
                </div>
            </div>

            <!-- Item 7 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[360px] shadow-md group border border-white/60 reveal" style="animation-delay: 300ms;">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Lake Mountain Reflection">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Refleksi Danau</span>
                </div>
            </div>

            <!-- Item 8 -->
            <div class="break-inside-avoid inline-block w-full mb-6 relative rounded-[2rem] overflow-hidden h-[310px] shadow-md group border border-white/60 reveal" style="animation-delay: 350ms;">
                <img src="https://images.unsplash.com/photo-1486915309851-b0cc1f8a0084?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Bonfire Night Camp">
                <div class="absolute inset-0 bg-primary/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                    <span class="text-[10px] font-bold text-white bg-primary/80 px-4 py-2 rounded-full border border-white/20">Api Unggun</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog / Articles Section -->
<section class="py-24">
    <div class="max-w-8xl mx-auto px-4 md:px-8">
        <!-- Asymmetric Header -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-20 reveal">
            <div class="lg:col-span-7">
                <span class="text-xs font-bold text-secondary uppercase tracking-widest block mb-3">Artikel & Tips</span>
                <h2 class="text-3xl md:text-5xl lg:text-6xl font-bold font-serif text-primary leading-tight">Persiapan Pendakian Anda</h2>
            </div>
            <div class="lg:col-span-5">
                <p class="text-text-dark/65 text-sm leading-relaxed max-w-lg">
                    Dapatkan tips keselamatan, informasi kelengkapan alat, dan panduan mendaki gunung langsung dari instruktur senior kami.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($articles as $art)
                <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-md hover:shadow-xl hover:scale-[1.02] transition-all duration-300 flex flex-col border border-white/60 reveal">
                    <div class="relative h-52 bg-slate-100 overflow-hidden">
                        <img src="{{ $art->gambar_cover ?: 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover" alt="{{ $art->judul }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                    </div>
                    
                    <div class="p-8 flex-grow flex flex-col justify-between space-y-6 bg-white/20">
                        <div class="space-y-3">
                            <span class="text-[9px] font-bold text-secondary uppercase tracking-widest bg-secondary/10 px-2 py-0.5 rounded-md">Panduan Pendaki</span>
                            <h3 class="text-lg font-bold font-serif text-primary hover:text-primary-light transition-colors leading-snug">
                                <a href="{{ route('blog.show', $art->slug) }}">{{ $art->judul }}</a>
                            </h3>
                            <p class="text-text-dark/70 text-xs line-clamp-3 leading-relaxed">
                                {{ $art->konten }}
                            </p>
                        </div>
                        <a href="{{ route('blog.show', $art->slug) }}" class="text-[10px] font-extrabold text-primary hover:text-primary-light inline-flex items-center gap-1.5 transition-all">
                            Baca Selengkapnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-6 text-text-dark/50">
                    Belum ada artikel dipublikasikan.
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // 1. Hero Autoplay Carousel
    let activeHeroIndex = 0;
    const heroImages = document.querySelectorAll('#hero-carousel img');
    if (heroImages.length > 0) {
        setInterval(() => {
            heroImages[activeHeroIndex].classList.replace('opacity-80', 'opacity-0');
            activeHeroIndex = (activeHeroIndex + 1) % heroImages.length;
            heroImages[activeHeroIndex].classList.replace('opacity-0', 'opacity-80');
        }, 5000);
    }

    // 2. Search Autocomplete with Debounce
    const searchInput = document.getElementById('search-input');
    const suggestionsBox = document.getElementById('search-suggestions');
    if (searchInput && suggestionsBox) {
        const seededMountains = [
            { name: "Gunung Rinjani", slug: "gunung-rinjani-3726-mdpl", location: "Lombok, NTB" },
            { name: "Gunung Semeru", slug: "gunung-semeru-puncak-mahameru", location: "Lumajang, Jatim" },
            { name: "Gunung Merbabu", slug: "gunung-merbabu-savana-merbabu", location: "Boyolali, Jateng" },
            { name: "Gunung Gede", slug: "gunung-gede-alun-alun-surya-kencana", location: "Cianjur, Jabar" }
        ];

        let debounceTimer;
        searchInput.addEventListener('input', (e) => {
            clearTimeout(debounceTimer);
            const query = e.target.value.toLowerCase().trim();

            if (!query) {
                suggestionsBox.classList.add('hidden');
                return;
            }

            debounceTimer = setTimeout(() => {
                const matches = seededMountains.filter(m => m.name.toLowerCase().includes(query) || m.location.toLowerCase().includes(query));
                if (matches.length > 0) {
                    suggestionsBox.innerHTML = matches.map(m => `
                        <a href="/trips/${m.slug}" class="flex items-center gap-2 p-2 hover:bg-bg-alt rounded-xl text-xs font-bold text-primary transition-colors">
                            <i data-lucide="mountain" class="w-3.5 h-3.5 text-secondary font-bold"></i>
                            <span>${m.name} (${m.location})</span>
                        </a>
                    `).join('');
                    suggestionsBox.classList.remove('hidden');
                    lucide.createIcons();
                } else {
                    suggestionsBox.innerHTML = `<div class="text-[10px] text-text-dark/50 p-2 font-semibold">Gunung tidak ditemukan...</div>`;
                    suggestionsBox.classList.remove('hidden');
                }
            }, 300);
        });

        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.classList.add('hidden');
            }
        });
    }

    // 3. Category Chips Live Filtering
    function filterTrips(level, button) {
        document.querySelectorAll('.category-chip').forEach(btn => {
            btn.className = "category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-white text-text-dark/70 hover:bg-primary/5 transition-all flex items-center gap-1.5 shrink-0";
        });
        button.className = "category-chip px-5 py-2 rounded-full border border-primary/10 text-xs font-bold bg-primary text-white transition-all shadow-sm flex items-center gap-1.5 shrink-0";

        document.querySelectorAll('[data-difficulty]').forEach(card => {
            const diff = card.getAttribute('data-difficulty');
            if (level === 'Semua' || diff === level) {
                card.style.display = 'flex';
                card.classList.add('page-transition');
            } else {
                card.style.display = 'none';
                card.classList.remove('page-transition');
            }
        });
    }

    // 4. Testimonial Auto Scroll
    const testimonialSlider = document.getElementById('testimonial-slider');
    if (testimonialSlider) {
        let scrollInterval;
        const startAutoScroll = () => {
            scrollInterval = setInterval(() => {
                const maxScroll = testimonialSlider.scrollWidth - testimonialSlider.clientWidth;
                if (testimonialSlider.scrollLeft >= maxScroll - 10) {
                    testimonialSlider.scrollTo({ left: 0, behavior: 'smooth' });
                } else {
                    testimonialSlider.scrollBy({ left: 320, behavior: 'smooth' });
                }
            }, 4000);
        };
        const stopAutoScroll = () => clearInterval(scrollInterval);

        testimonialSlider.addEventListener('mouseenter', stopAutoScroll);
        testimonialSlider.addEventListener('mouseleave', startAutoScroll);
        startAutoScroll();
    }
</script>
@endsection
