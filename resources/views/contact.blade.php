@extends('layouts.layout')

@section('title', 'Communication Hub | Puncak & Bara')

@section('content')
<!-- Typographic Header -->
<header class="bg-black text-white pt-40 pb-24 border-b border-white/10 selection:bg-accent selection:text-black">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-end">
            <div class="md:col-span-8 space-y-6">
                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent block reveal">The Inquiry Protocol</span>
                <h1 class="text-7xl md:text-[8rem] font-black uppercase tracking-tighter leading-[0.8] reveal">
                    Connect<span class="text-accent underline decoration-1">.</span>
                </h1>
            </div>
            <div class="md:col-span-4 pb-4">
                <p class="text-gray-500 text-sm font-medium leading-relaxed reveal">Direct communication channels established for logistical coordination, technical inquiries, and project partnerships.</p>
            </div>
        </div>
    </div>
</header>

<section class="max-w-7xl mx-auto px-6 py-24 selection:bg-black selection:text-white">
    <!-- Channel Grid: Architectural Bento -->
            <div class="space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em]">Official Liaison</h3>
                <p class="text-xl font-black italic tracking-tighter truncate">independenttendiyvisual@gmail.com</p>
                <p class="text-gray-400 text-[10px] font-medium leading-relaxed">For project briefings, technical documentation, and partnership requests.</p>
            </div>
            <a href="mailto:independenttendiyvisual@gmail.com" class="inline-block border-b-2 border-black pb-1 text-[10px] font-black uppercase tracking-[0.3em] interactive">Transmit Email_</a>
        </div>

        <div class="p-12 space-y-8 hover:bg-gray-50 transition-colors group">
            <div class="w-12 h-12 border border-black flex items-center justify-center group-hover:bg-black group-hover:text-white transition-all">
                <i data-lucide="map-pin" class="w-5 h-5"></i>
            </div>
            <div class="space-y-4">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em]">Physical Hub</h3>
                <p class="text-2xl font-black italic tracking-tighter">SANFORD OPS.</p>
                <p class="text-gray-400 text-[10px] font-medium leading-relaxed">Strategic headquarters for route planning and technical equipment verification.</p>
            </div>
            <span class="text-[10px] font-black uppercase tracking-[0.3em] text-accent">Location: Malang, East Java</span>
        </div>
    </div>

    <!-- FAQ Protocol: Analytical Breakdown -->
    <div class="mt-40 space-y-24">
        <div class="flex flex-col md:flex-row justify-between items-end gap-8 border-b border-gray-100 pb-12 reveal">
            <h2 class="text-5xl font-black uppercase tracking-tighter">Support Protocol<span class="text-accent underline decoration-1">.</span></h2>
            <p class="text-gray-400 text-xs font-medium tracking-widest uppercase">Frequently Referenced Information</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-20 gap-y-12 reveal">
            <!-- FAQ 1 -->
            <div class="space-y-4 pb-12 border-b border-gray-50">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] flex items-center gap-4">
                    <span class="text-accent">01_</span> Eligibility For Beginners
                </h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">
                    All participants are welcome. We curate specific expeditions categorized under "Pemula" (Beginner) to ensure controlled progression and professional guidance for first-time ascents.
                </p>
            </div>

            <!-- FAQ 2 -->
            <div class="space-y-4 pb-12 border-b border-gray-50">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] flex items-center gap-4">
                    <span class="text-accent">02_</span> Logistical Inventory
                </h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">
                    Core infrastructure (dome tents, air mattresses, sleeping bags, culinary equipment) is managed by the Sanford team. Participants are only required to maintain technical personal apparel and specific medication.
                </p>
            </div>

            <!-- FAQ 3 -->
            <div class="space-y-4 pb-12 border-b border-gray-50">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] flex items-center gap-4">
                    <span class="text-accent">03_</span> Cancellation Sequence
                </h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">
                    Financial recovery protocols allow for 50% refund at H-14. Below H-7, resource allocation is finalized. Personnel substitution is permitted up to H-3 without investigative penalties.
                </p>
            </div>

            <!-- FAQ 4 -->
            <div class="space-y-4 pb-12 border-b border-gray-50">
                <h4 class="text-sm font-black uppercase tracking-[0.2em] flex items-center gap-4">
                    <span class="text-accent">04_</span> Porter Allocation
                </h4>
                <p class="text-gray-500 text-sm leading-relaxed font-medium">
                    Standardized porter support covers communal logistics and structural equipment. Personal load management (carrier/gear) remains the responsibility of the individual unless a private tactical porter is requested at H-3.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action: The Direct Line -->
<section class="max-w-7xl mx-auto px-6 pb-40 reveal">
    <div class="bg-black text-white p-20 flex flex-col md:flex-row justify-between items-center gap-12">
        <div class="space-y-6">
            <h2 class="text-5xl font-black uppercase tracking-tighter leading-none">Ready To Coordinate?</h2>
            <p class="text-gray-500 text-sm font-medium tracking-wide">Our briefing team is standing by for your technical verification.</p>
        </div>
        <a href="https://wa.me/6281330012100" target="_blank" class="bg-white text-black px-12 py-8 text-[11px] font-black uppercase tracking-[0.5em] hover:bg-accent transition-all interactive">Initialize Protocol_</a>
    </div>
</section>
@endsection
