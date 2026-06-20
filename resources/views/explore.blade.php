@extends('layouts.layout')

@section('title', 'Expedition Journals | Sanford Archive')

@section('content')
<div class="bg-[#F3F2EE] selection:bg-accent selection:text-white min-h-screen pt-40 pb-32">
    
    <!-- JOURNAL_HEADER -->
    <div class="max-w-7xl mx-auto px-6 lg:px-10 mb-20 lg:mb-32 border-b border-accent/10 pb-16 lg:pb-24 relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-end relative z-10">
            <div class="lg:col-span-8 space-y-8 lg:space-y-12">
                <div class="flex items-center gap-6">
                    <span class="text-accent text-[10px] font-bold uppercase tracking-[1.5em] block reveal">COLLECTIVE_ARCHIVE</span>
                    <div class="flex-grow h-px bg-accent/20"></div>
                </div>
                <h1 class="text-6xl md:text-8xl lg:text-[11rem] font-serif italic text-primary leading-[0.8] reveal">
                    Field <br/><span class="text-accent underline decoration-1">Journals.</span>
                </h1>
            </div>
            <div class="lg:col-span-4 pb-4 reveal">
                <p class="text-primary/60 text-lg lg:text-xl font-medium leading-relaxed border-l-4 border-accent pl-10">
                    A curated repository of Indonesia's silent peaks. Each entry is a testament to the architectural soul of the wild.
                </p>
            </div>
        </div>
        <!-- Organic Texture Overlay -->
        <div class="absolute right-0 top-0 h-full w-full opacity-5 pointer-events-none text-[30vw] font-serif italic text-accent flex items-center justify-end">
            Journals
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-10">
        <!-- ORGANIC_FILTER_STATION -->
        <div class="glass-organic p-12 mb-24 relative z-30 shadow-2xl reveal">
            <form action="{{ route('explore') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <div class="md:col-span-4 space-y-4">
                    <label class="text-[9px] font-bold uppercase tracking-[0.5em] text-accent/60">Identify_Peak</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ENTER_PEAK_NAME..." class="w-full bg-transparent border-b border-accent/20 py-4 text-sm font-bold text-primary uppercase tracking-[0.2em] outline-none focus:border-accent transition-colors">
                </div>
                <div class="md:col-span-3 space-y-4">
                    <label class="text-[9px] font-bold uppercase tracking-[0.5em] text-accent/60">Intensity_Flow</label>
                    <select name="difficulty" class="w-full bg-transparent border-b border-accent/20 py-4 text-sm font-bold text-primary uppercase tracking-[0.1em] outline-none focus:border-accent transition-colors cursor-pointer appearance-none">
                        <option value="">ALL_MODES</option>
                        <option value="Pemula" {{ request('difficulty') == 'Pemula' ? 'selected' : '' }}>BEGINNER_PATH</option>
                        <option value="Menengah" {{ request('difficulty') == 'Menengah' ? 'selected' : '' }}>INTERMEDIATE_LEVEL</option>
                        <option value="Tinggi" {{ request('difficulty') == 'Tinggi' ? 'selected' : '' }}>ELITE_DESCENCE</option>
                    </select>
                </div>
                <div class="md:col-span-3 space-y-4">
                    <label class="text-[9px] font-bold uppercase tracking-[0.5em] text-accent/60">Energy_Investment</label>
                    <select name="max_price" class="w-full bg-transparent border-b border-accent/20 py-4 text-sm font-bold text-primary uppercase tracking-[0.1em] outline-none focus:border-accent transition-colors cursor-pointer appearance-none">
                        <option value="">ALL_BOUNDARIES</option>
                        <option value="1000000" {{ request('max_price') == '1000000' ? 'selected' : '' }}>SUB_1M_INVEST</option>
                        <option value="2000000" {{ request('max_price') == '2000000' ? 'selected' : '' }}>SUB_2M_INVEST</option>
                        <option value="5000000" {{ request('max_price') == '5000000' ? 'selected' : '' }}>PREMIUM_JOURNAL</option>
                    </select>
                </div>
                <div class="md:col-span-2 flex items-end">
                    <button type="submit" class="w-full bg-[#1E2923] text-white h-16 text-[10px] font-bold uppercase tracking-[0.8em] hover:bg-accent transition-all interactive shadow-lg">
                        Execute_
                    </button>
                </div>
            </form>
        </div>

        <!-- JOURNAL_MATRIX -->
        <div id="archive-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-32 reveal">
            @forelse($trips as $trip)
                <div class="expedition-card group bg-white border border-accent/5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] hover:shadow-[0_30px_60px_rgba(30,41,35,0.06)] hover:-translate-y-2 transition-all duration-700 reveal overflow-hidden flex flex-col justify-between">
                    <div>
                        <!-- Image Container with height scale and custom specs tag overlay -->
                        <div class="aspect-[4/5] overflow-hidden relative">
                            <img src="{{ $trip->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-[3000ms]">
                            
                            <!-- Premium floating badges overlay -->
                            <div class="absolute top-6 left-6 z-10 flex flex-col gap-2">
                                <span class="bg-[#F3F2EE]/90 backdrop-blur-md border border-accent/10 px-3 py-1.5 text-[8px] font-black uppercase tracking-widest text-primary flex items-center gap-1.5">
                                    <span class="w-1 h-1 rounded-full bg-accent animate-ping"></span>
                                    <span>active_node</span>
                                </span>
                            </div>

                            <div class="absolute bottom-6 right-6 z-10">
                                <span class="bg-black/40 backdrop-blur-md border border-white/10 px-3 py-1.5 text-[9px] font-black uppercase tracking-widest text-white">
                                    {{ number_format($trip->ketinggian ?? 3142) }}M ASL
                                </span>
                            </div>
                        </div>
                        
                        <!-- Editorial Content -->
                        <div class="p-10 space-y-8 relative">
                            <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-[0.25em]">
                                <span class="text-accent/60">VECTOR_{{ strtoupper($trip->location) }}</span>
                                <span class="flex items-center gap-2 text-primary/75">
                                    <span class="w-1.5 h-1.5 rounded-full {{ strtolower($trip->level_kesulitan) == 'easy' ? 'bg-emerald-500' : (strtolower($trip->level_kesulitan) == 'medium' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                                    {{ $trip->level_kesulitan }}
                                </span>
                            </div>
                            
                            <h3 class="text-3xl font-serif italic text-primary leading-tight">
                                <a href="{{ route('trips.show', $trip->slug) }}" class="interactive group-hover:text-accent transition-colors relative inline-block">
                                    {{ $trip->nama_gunung }}
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-500 group-hover:w-full"></span>
                                </a>
                            </h3>
                            
                            <div class="pt-6 border-t border-accent/10 flex justify-between items-end">
                                <div class="space-y-1">
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">DEPARTURE</span>
                                    <span class="text-xs font-black text-primary">{{ $trip->tanggal_berangkat->format('M d, Y') }}</span>
                                </div>
                                <div class="text-right space-y-1">
                                    <span class="text-[8px] font-black text-gray-400 uppercase tracking-widest block">INVESTMENT</span>
                                    <span class="text-xl font-black text-primary italic">IDR {{ number_format($trip->harga/1000, 0, ',', '.') }}K</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Clean CTA Button -->
                    <div class="p-10 pt-0">
                        <a href="{{ route('trips.show', $trip->slug) }}" class="block w-full border border-accent/20 py-4.5 text-center text-[9px] font-black uppercase tracking-[0.4em] text-accent hover:bg-accent hover:text-white transition-all interactive">
                            Open Journal_
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-64 text-center border-2 border-dashed border-accent/10">
                    <span class="text-[12px] font-bold uppercase tracking-[1em] text-accent/20 italic animate-pulse">NO_JOURNALS_FOUND_IN_ARCHIVE</span>
                </div>
            @endforelse
        </div>

        <!-- JOURNAL_PAGINATION -->
        <div class="flex justify-center pb-32">
            {{ $trips->appends(request()->query())->links() }}
        </div>
    </section>
</div>
@endsection

@section('scripts')
<style>
    .page-link { @apply bg-white border border-accent/10 px-8 py-4 text-[10px] font-bold uppercase tracking-[0.4em] text-accent/60 hover:bg-accent hover:text-white transition-all !important; }
    .active .page-link { @apply bg-[#1E2923] text-white border-[#1E2923] !important; }
</style>
<script>
    function setLayout(type) {
        // Layout logic remains similar but with Nature Editorial styling
        const container = document.getElementById('archive-container');
        const cards = document.querySelectorAll('.expedition-card');
        const gridBtn = document.getElementById('btn-grid');
        const listBtn = document.getElementById('btn-list');

        if (type === 'list') {
            container.classList.replace('lg:grid-cols-3', 'grid-cols-1');
            container.classList.replace('md:grid-cols-2', 'grid-cols-1');
            cards.forEach(card => card.classList.add('lg:flex'));
        } else {
            container.classList.replace('grid-cols-1', 'lg:grid-cols-3');
            container.classList.replace('grid-cols-1', 'md:grid-cols-2');
            cards.forEach(card => card.classList.remove('lg:flex'));
        }
    }
</script>
@endsection
