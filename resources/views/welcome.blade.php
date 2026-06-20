@extends('layouts.layout')

@section('title', 'Puncak & Bara | Bespoke Nature Editorial')

@section('content')
<div class="relative w-full bg-[#F3F2EE] selection:bg-accent selection:text-white min-h-screen">
    
    <!-- ORGANIC_TOPOGRAPHY_OVERLAY -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.03]" style="background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>

    <!-- NATURE_HERO_SPLIT -->
    <section class="relative min-h-screen flex flex-col justify-center px-6 lg:px-40 pt-32 lg:pt-24 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-center">
            
            <div class="lg:col-span-6 space-y-8 lg:space-y-12 relative z-10">
                <div class="space-y-6 reveal">
                    <div class="flex items-center gap-6">
                        <span class="text-[10px] font-black text-accent uppercase tracking-[1.5em] whitespace-nowrap">FIELD_JOURNAL_V1</span>
                        <div class="flex-grow h-px bg-accent/20"></div>
                    </div>
                    <h1 class="text-6xl md:text-8xl lg:text-[10rem] font-serif italic text-primary leading-[0.85] tracking-tight reveal-child">
                         Nature <br/>is the <span class="text-accent underline decoration-1">Master.</span>
                    </h1>
                </div>

                <div class="max-w-xl space-y-8 lg:space-y-10 reveal">
                    <p class="text-primary/70 text-lg lg:text-xl leading-relaxed font-medium">
                        Welcome to Puncak & Bara. We curate high-altitude archives and organic expeditions designed for those who seek the silent architecture of the wild.
                    </p>
                    <div class="flex flex-wrap gap-6 lg:gap-10">
                        <a href="{{ route('explore') }}" class="bg-accent text-white px-10 lg:px-16 py-5 lg:py-6 text-[11px] font-bold uppercase tracking-[0.4em] hover:bg-primary transition-all interactive shadow-xl">
                            Explore Archives
                        </a>
                        <div class="flex flex-col justify-center gap-1">
                            <span class="text-[8px] font-bold uppercase tracking-widest text-accent">SCROLL_DOWN</span>
                            <div class="w-12 h-px bg-accent"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ORGANIC_IMAGE_ASSET -->
            <div class="lg:col-span-6 relative h-[500px] lg:h-[800px] reveal">
                <div class="absolute inset-4 lg:inset-10 border border-accent/10 -translate-x-4 lg:-translate-x-10 translate-y-4 lg:translate-y-10"></div>
                <div class="relative w-full h-full overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80" 
                         class="w-full h-full object-cover brightness-95 contrast-110 active-zoom">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary/40 to-transparent"></div>
                    
                    <!-- Altitude Tag -->
                    <div class="absolute bottom-10 lg:bottom-16 left-10 lg:left-16 glass-organic p-6 lg:p-10 space-y-1">
                        <span class="text-[9px] font-bold text-accent uppercase tracking-widest block">CURRENT_ELEVATION</span>
                        <span class="text-2xl lg:text-3xl font-serif italic text-primary">3,676m_</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NATURE_MARQUEE (Organic Flow) -->
    <div class="py-16 bg-[#1E2923] border-y border-accent/10 relative z-30">
        <div class="flex whitespace-nowrap animate-marquee">
            @foreach(range(1, 10) as $i)
                <span class="text-[12px] font-medium uppercase tracking-[1.5em] mx-24 text-[#A8B5AA] italic">
                    BREATHE // ASCEND // PRESERVE // 0813 3001 2100 // NATURE_ARCHIVE // SYSTEM_STABLE //
                </span>
            @endforeach
        </div>
    </div>

    <!-- CORE_AXIOMS: ORGANIC_EDITION -->
    <section class="py-48 bg-white border-b border-accent/5">
        <div class="max-w-7xl mx-auto px-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-32">
                <div class="lg:col-span-5 space-y-10">
                    <span class="text-accent text-[10px] font-bold uppercase tracking-[1em] block reveal">OUR_ETHOS</span>
                    <h2 class="text-6xl md:text-8xl font-serif italic text-primary leading-tight reveal">
                        The Soul of <br/><span class="text-accent underline decoration-1">Adventure.</span>
                    </h2>
                    <p class="text-gray-500 text-lg leading-relaxed reveal">Every peak is a silent chapter. We provide the tools to read them with deep respect and architectural precision.</p>
                </div>
                
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-12">
                    @php
                        $ethos = [
                            ['t' => 'Pure Air Protocol', 'd' => 'Zero-emission operations and absolute ecological respect.', 'icon' => 'wind'],
                            ['t' => 'Heritage Mapping', 'd' => 'Deep integration with local mountain communities and lore.', 'icon' => 'map'],
                            ['t' => 'Organic Pulse', 'd' => 'Pacing calculated by your own rhythm and altitude response.', 'icon' => 'activity'],
                            ['t' => 'Eternal Views', 'd' => 'Curated vantage points reserved for the most patient eyes.', 'icon' => 'eye']
                        ];
                    @endphp
                    @foreach($ethos as $e)
                        <div class="p-12 border border-accent/5 hover:border-accent/40 bg-[#F9F9F7] transition-all duration-700 reveal">
                            <div class="w-12 h-12 bg-accent text-white flex items-center justify-center mb-8 shadow-lg">
                                <i data-lucide="{{ $e['icon'] }}" class="w-5 h-5"></i>
                            </div>
                            <h4 class="text-xl font-serif italic text-primary mb-4">{{ $e['t'] }}</h4>
                            <p class="text-sm text-gray-500 leading-relaxed">{{ $e['d'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVE_MATRIX: NATURE_COLLECTION -->
    <section class="py-48 bg-[#F3F2EE]">
        <div class="max-w-7xl mx-auto px-10">
            <div class="flex flex-col md:flex-row justify-between items-end gap-12 mb-32">
                <div class="space-y-6">
                    <span class="text-accent text-[10px] font-bold uppercase tracking-[1em] block reveal">FIELD_EXPLORATION</span>
                    <h2 class="text-7xl lg:text-9xl font-serif italic text-primary leading-none reveal">Curated <br/>Peaks.</h2>
                </div>
                <a href="{{ route('explore') }}" class="text-[11px] font-bold uppercase tracking-[0.5em] text-accent border-b border-accent/20 pb-2 hover:border-accent transition-all interactive reveal">View All Journals_</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                @foreach($trips->take(3) as $trip)
                    <div class="group relative bg-white border border-accent/5 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.03)] hover:shadow-[0_30px_60px_rgba(30,41,35,0.06)] hover:-translate-y-2 transition-all duration-700 reveal">
                        <div class="aspect-[3/4] overflow-hidden relative">
                            <img src="{{ $trip->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-[3000ms]">
                            <div class="absolute bottom-6 right-6 z-10">
                                <span class="bg-black/40 backdrop-blur-md border border-white/10 px-3 py-1.5 text-[9px] font-black uppercase tracking-widest text-white">
                                    {{ number_format($trip->ketinggian ?? 3142) }}M ASL
                                </span>
                            </div>
                        </div>
                        <div class="p-10 space-y-6 bg-white relative z-10">
                            <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest text-accent/60">
                                <span>{{ $trip->location }}</span>
                                <span class="flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full {{ strtolower($trip->level_kesulitan) == 'easy' ? 'bg-emerald-500' : (strtolower($trip->level_kesulitan) == 'medium' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                                    {{ $trip->level_kesulitan }}
                                </span>
                            </div>
                            <h3 class="text-2xl font-serif italic text-primary leading-snug">
                                <a href="{{ route('trips.show', $trip->slug) }}" class="interactive group-hover:text-accent transition-colors relative inline-block">
                                    {{ $trip->nama_gunung }}
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-500 group-hover:w-full"></span>
                                </a>
                            </h3>
                            <div class="pt-6 border-t border-accent/5 flex justify-between items-center">
                                <span class="text-lg font-bold text-primary italic">IDR {{ number_format($trip->harga/1000, 0, ',', '.') }}K</span>
                                <a href="{{ route('trips.show', $trip->slug) }}" class="text-accent text-[9px] font-black uppercase tracking-[0.2em] interactive flex items-center gap-2 group-hover:gap-3 transition-all duration-300">
                                    Journal_ <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CALL_TO_ACTION: THE_FINAL_BREATH -->
    <section class="py-64 bg-[#1E2923] text-center space-y-16">
        <div class="space-y-6 reveal">
            <span class="text-accent text-[12px] font-bold uppercase tracking-[1em]">READY_TO_DESCEND</span>
            <h2 class="text-7xl md:text-[12rem] font-serif italic text-white leading-none">
                 Leave <br/><span class="text-[#A8B5AA]">No Trace.</span>
            </h2>
        </div>
        <p class="text-[#A8B5AA]/60 text-xl max-w-2xl mx-auto font-medium reveal">Your next chapter begins at the tree line. Join the Sanford Nature Collective and synchronize with the altitude.</p>
        <div class="pt-12 reveal">
            <a href="{{ route('register') }}" class="bg-accent text-white px-20 py-8 text-[12px] font-bold uppercase tracking-[0.5em] hover:bg-white hover:text-primary transition-all interactive shadow-2xl">
                Begin Final Descent_
            </a>
        </div>
    </section>

</div>
@endsection

@section('scripts')
<script>
    window.addEventListener('scroll', () => {
        const zoomElements = document.querySelectorAll('.active-zoom');
        zoomElements.forEach(el => {
            const scroll = window.scrollY;
            el.style.transform = `scale(${1.05 + (scroll * 0.0001)}) translateY(${scroll * 0.03}px)`;
        });
    });
</script>
@endsection
