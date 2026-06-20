@extends('layouts.layout')

@section('title', 'Field Identity | Puncak & Bara')

@section('content')
<!-- Typographic Header -->
<header class="bg-black text-white pt-40 pb-24 border-b border-white/10 selection:bg-accent selection:text-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-end">
            <div class="md:col-span-8 space-y-6">
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent block reveal">The Operational Ethos</span>
                <h1 class="text-7xl md:text-[8rem] font-black uppercase tracking-tighter leading-[0.8] reveal">
                    Identity<span class="text-accent underline decoration-1">.</span>
                </h1>
            </div>
            <div class="md:col-span-4 pb-4">
                <p class="text-gray-500 text-sm font-medium leading-relaxed reveal">CV Puncak Bara Mandiri is a certified high-altitude expedition coordinator specializing in technical logistics and professional mountain guiding.</p>
            </div>
        </div>
    </div>
</header>

<!-- Main Identity Section -->
<section class="bg-[#F3F2EE] selection:bg-black selection:text-white py-24">
    <div class="max-w-7xl mx-auto px-6 space-y-24">
        
        <!-- Large Banner Image -->
        <div class="relative h-[50vh] overflow-hidden shadow-2xl reveal">
            <img src="https://images.unsplash.com/photo-1454496522488-7a8e488e8606?auto=format&fit=crop&w=1200&q=80" class="w-full h-full object-cover active-zoom brightness-90" alt="Mountain Ascent">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
            <div class="absolute bottom-10 left-10 text-white space-y-2 z-10">
                <span class="text-[8px] font-bold uppercase tracking-[0.5em] text-accent">FIELD_ARCHIVE_FILE_01</span>
                <h3 class="text-2xl font-black uppercase tracking-tighter">Ascending properly since 2020</h3>
            </div>
        </div>

        <!-- Bento Grid: The Pillars -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 reveal">
            <!-- Pillar 1 -->
            <div class="bg-white p-12 space-y-8 border border-gray-100 hover:shadow-xl transition-all duration-500 group">
                <div class="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-accent group-hover:text-white transition-all">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-accent">Professional APGI Guides</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">
                        Safety is not a feature; it is our primary protocol. All trip leaders are certified by the **APGI (Asosiasi Pemandu Gunung Indonesia)** and trained in wilderness first aid and high-altitude emergency sequence.
                    </p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white p-12 space-y-8 border border-gray-100 hover:shadow-xl transition-all duration-500 group">
                <div class="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-accent group-hover:text-white transition-all">
                    <i data-lucide="leaf" class="w-5 h-5"></i>
                </div>
                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-[0.4em] text-accent">Zero Waste Policy</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-medium">
                        We operate under strict environmental boundaries. Every gram of logistics brought up the peak is documented, packed out, and verified at basecamp checkpoints to protect fragile volcanic ecosystems.
                    </p>
                </div>
            </div>
        </div>

        <!-- Corporate Credentials -->
        <div class="space-y-12">
            <h2 class="text-4xl font-black uppercase tracking-tighter border-b border-gray-200 pb-6">Legalities & Affiliation</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white p-12 space-y-8 border border-gray-100">
                    <span class="text-[9px] font-bold uppercase tracking-[0.4em] text-accent">Strategic Registry</span>
                    <div class="space-y-6">
                        <div class="flex justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Legal Name</span>
                            <span class="text-xs font-black uppercase text-primary tracking-wider">CV Puncak Bara Mandiri</span>
                        </div>
                        <div class="flex justify-between border-b border-gray-100 pb-4">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">TDUP License</span>
                            <span class="text-xs font-black uppercase text-primary tracking-wider">503/TDUP-WISATA/2026</span>
                        </div>
                        <div class="flex justify-between pb-2">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Operational HQ</span>
                            <span class="text-xs font-black uppercase text-primary tracking-wider text-right">Jl. Rinjani Raya No. 45, Malang</span>
                        </div>
                    </div>
                </div>

                <div class="bg-black text-white p-12 space-y-8 flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="text-[9px] font-black uppercase tracking-[0.5em] text-accent">Authorized Partner</span>
                        <h4 class="text-2xl font-black uppercase tracking-tighter">National Park Permits</h4>
                        <p class="text-gray-400 text-xs leading-relaxed font-medium">We maintain active administrative coordination with TNGGP (Gede Pangrango), TNBTS (Bromo Tengger Semeru), and TNGR (Rinjani) networks.</p>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-accent">Official Conservation Partner</span>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Call to Action: The Direct Line -->
<section class="max-w-7xl mx-auto px-6 py-40 reveal">
    <div class="bg-black text-white p-20 flex flex-col md:flex-row justify-between items-center gap-12">
        <div class="space-y-6">
            <h2 class="text-5xl font-black uppercase tracking-tighter leading-none">Ready To Coordinate?</h2>
            <p class="text-gray-500 text-sm font-medium tracking-wide">Our briefing team is standing by for your technical verification.</p>
        </div>
        <a href="https://wa.me/6281330012100" target="_blank" class="bg-white text-black px-12 py-8 text-[11px] font-black uppercase tracking-[0.5em] hover:bg-accent transition-all interactive">Initialize Protocol_</a>
    </div>
</section>
@endsection
