@extends('layouts.layout')

@section('title', $trip->nama_gunung . ' | Nature Journal | Sanford')

@section('content')
<div class="bg-[#F3F2EE] selection:bg-accent selection:text-white pb-32">
    
    <!-- JOURNAL_ENTRY_HEADER -->
    <header class="relative min-h-screen flex flex-col justify-end pt-32">
        <div class="absolute inset-0 z-0">
            <img src="{{ $trip->image_url }}" class="w-full h-full object-cover active-zoom brightness-90">
            <div class="absolute inset-0 bg-gradient-to-t from-[#F3F2EE] via-transparent to-black/20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-10 relative z-10 w-full pb-20 lg:pb-32">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-end">
                <div class="lg:col-span-8 space-y-8 lg:space-y-12 reveal">
                    <div class="flex items-center gap-6">
                        <span class="text-white text-[10px] font-bold uppercase tracking-[1.5em] block">MOUNT_SPEC_ARCHIVE</span>
                        <div class="flex-grow h-px bg-white/20"></div>
                    </div>
                    <h1 class="text-3xl sm:text-5xl md:text-6xl lg:text-[5.5rem] xl:text-[6.5rem] font-serif italic text-primary leading-[0.95] tracking-tight break-words">
                        {{ $trip->nama_gunung }}<span class="text-accent underline decoration-1">.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 glass-organic p-8 lg:p-12 space-y-8 lg:space-y-10 reveal shadow-[0_30px_60px_rgba(30,41,35,0.12)] border border-accent/10 relative">
                    <!-- Live indicator dot -->
                    <div class="absolute top-6 right-6 flex items-center gap-2 bg-emerald-500/10 px-3 py-1 rounded-full border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-ping"></span>
                        <span class="text-[7.5px] font-black uppercase tracking-widest text-emerald-600">active_node</span>
                    </div>

                    <div class="space-y-3">
                        <span class="text-[9px] font-black uppercase tracking-[0.25em] text-accent block">CURRENT_VALUATION</span>
                        <span class="text-4xl lg:text-5xl font-black text-primary italic tracking-tighter">IDR {{ number_format($trip->harga/1000, 0, ',', '.') }}K</span>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-8 lg:gap-10 pt-8 lg:pt-10 border-t border-accent/10">
                        <div class="space-y-1">
                            <span class="text-[8px] font-black uppercase tracking-widest text-primary/40">STABILITY_LV</span>
                            <span class="text-sm font-black text-primary uppercase tracking-widest flex items-center gap-2">
                                <span class="w-1.5 h-1.5 rounded-full {{ strtolower($trip->level_kesulitan) == 'easy' ? 'bg-emerald-500' : (strtolower($trip->level_kesulitan) == 'medium' ? 'bg-amber-500' : 'bg-red-500') }}"></span>
                                {{ $trip->level_kesulitan }}
                            </span>
                        </div>
                        <div class="space-y-1 text-right">
                            <span class="text-[8px] font-black uppercase tracking-widest text-primary/40">ELEVATION</span>
                            <span class="text-sm font-black text-primary uppercase tracking-widest">{{ number_format($trip->ketinggian ?? 3676) }}M ASL</span>
                        </div>
                    </div>
                    <a href="{{ route('user.booking.form', $trip->slug) }}" class="block w-full bg-accent text-white text-center py-5 lg:py-6 text-[10px] font-black uppercase tracking-[0.4em] hover:bg-primary transition-all interactive shadow-lg">
                        Initiate Journey_
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-10 py-48">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-32">
            
            <!-- NARRATIVE_ENGINE -->
            <div class="lg:col-span-8 space-y-32">
                
                <!-- NAVIGATION_INDEX -->
                <nav class="flex items-center gap-6 sm:gap-12 border-b border-accent/10 reveal overflow-x-auto scrollbar-none pb-px">
                    <button onclick="switchTab('deskripsi', this)" class="tab-btn relative pb-10 text-[10px] font-black uppercase tracking-[0.3em] text-primary border-b-2 border-accent interactive whitespace-nowrap">[ 01 ] Briefing_</button>
                    <button onclick="switchTab('itinerary', this)" class="tab-btn relative pb-10 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 hover:text-primary transition-all interactive whitespace-nowrap">[ 02 ] Logbook_</button>
                    <button onclick="switchTab('ulasan', this)" class="tab-btn relative pb-10 text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 hover:text-primary transition-all interactive whitespace-nowrap">[ 03 ] Final_Words_</button>
                </nav>

                <!-- TAB: BRIEFING -->
                <div id="tab-deskripsi" class="tab-pane space-y-20 reveal">
                    <div class="prose max-w-none">
                        <p class="text-primary/80 text-lg sm:text-xl leading-relaxed italic font-serif border-l-4 border-accent pl-6 py-2 bg-accent/5">
                            "{{ $trip->deskripsi }}"
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 sm:gap-12">
                        <div class="bg-white p-10 space-y-6 border border-accent/5 shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="w-1.5 h-10 bg-accent"></div>
                                <h4 class="text-[10px] font-black text-primary uppercase tracking-[0.3em]">Integrated Logistics</h4>
                            </div>
                            <ul class="space-y-4">
                                @foreach($trip->what_is_included ?? ['Professional Guides', 'Entry Permits', 'Nature Gear Kit', 'High-Altitude Nutrition'] as $inc)
                                    <li class="text-[10.5px] font-black uppercase tracking-[0.15em] text-gray-500 flex items-center gap-4">
                                        <i data-lucide="check" class="w-4 h-4 text-emerald-500"></i> {{ $inc }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-[#1E2923] p-10 space-y-6 shadow-xl relative overflow-hidden">
                            <div class="absolute -right-6 -bottom-6 opacity-5 pointer-events-none">
                                <i data-lucide="shield" class="w-24 h-24 text-accent"></i>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-1.5 h-10 bg-accent"></div>
                                <h4 class="text-[10px] font-black text-white uppercase tracking-[0.3em]">Field Requirements</h4>
                            </div>
                            <ul class="space-y-4">
                                <li class="text-[10.5px] font-black uppercase tracking-[0.15em] text-[#A8B5AA] flex items-center gap-4">
                                    <i data-lucide="shield" class="w-4 h-4 text-accent"></i> CLIMATE-READY SHELL
                                </li>
                                <li class="text-[10.5px] font-black uppercase tracking-[0.15em] text-[#A8B5AA] flex items-center gap-4">
                                    <i data-lucide="shield" class="w-4 h-4 text-accent"></i> ARCH-SUPPORT FOOTWEAR
                                </li>
                                <li class="text-[10.5px] font-black uppercase tracking-[0.15em] text-[#A8B5AA] flex items-center gap-4">
                                    <i data-lucide="shield" class="w-4 h-4 text-accent"></i> HYDRATION_SYSTEM_3L
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- TAB: LOGBOOK (Itinerary Timeline) -->
                <div id="tab-itinerary" class="tab-pane hidden reveal">
                    <div class="space-y-0">
                        @forelse($trip->itinerary ?? [] as $index => $it)
                            <div class="flex gap-6 group">
                                <!-- Timeline Track & Node -->
                                <div class="flex flex-col items-center shrink-0">
                                    <div class="w-8 h-8 rounded-full border border-accent bg-[#F3F2EE] flex items-center justify-center group-hover:bg-accent group-hover:text-white transition-all duration-300 shadow-sm z-10">
                                        <span class="text-[9px] font-black">0{{ $index + 1 }}</span>
                                    </div>
                                    @if(!$loop->last)
                                        <div class="w-px flex-grow border-l-2 border-dashed border-accent/20 my-2"></div>
                                    @endif
                                </div>
                                <!-- Timeline Content -->
                                <div class="pb-10 space-y-2 pt-1">
                                    <span class="text-[8px] font-black text-accent uppercase tracking-[0.25em] block">PROTOCOL_STAGE_0{{ $index + 1 }}</span>
                                    <p class="text-primary/70 text-[13px] leading-relaxed font-medium">
                                        {{ $it }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="py-32 text-center border-2 border-dashed border-accent/10">
                                <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent/20">LOGBOOK_NOT_YET_ARCHIVED</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- TAB: REVIEWS (Final Words) -->
                <div id="tab-ulasan" class="tab-pane hidden space-y-12 reveal">
                    @forelse($approvedReviews ?? [] as $rev)
                        <div class="bg-white border border-accent/5 p-10 sm:p-12 shadow-[0_8px_30px_rgb(0,0,0,0.03)] space-y-6 relative overflow-hidden group hover:shadow-[0_20px_40px_rgba(30,41,35,0.05)] transition-all duration-500">
                            <div class="absolute right-6 top-6 opacity-5 group-hover:opacity-10 transition-opacity">
                                <i data-lucide="quote" class="w-16 h-16 text-accent"></i>
                            </div>
                            <div class="flex items-center gap-6 relative z-10">
                                <div class="w-12 h-12 bg-accent text-white flex items-center justify-center text-xs font-black rounded-full uppercase tracking-wider">
                                    {{ substr($rev->user->name, 0, 2) }}
                                </div>
                                <div class="space-y-1">
                                    <span class="text-xs font-black text-primary uppercase tracking-[0.15em] block">{{ $rev->user->name }}</span>
                                    <div class="flex text-amber-500 gap-0.5">
                                        @for($i=0; $i<$rev->rating; $i++)
                                            <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-primary/80 text-xl font-serif italic leading-relaxed relative z-10 pl-2 border-l-2 border-accent/20">
                                "{{ $rev->komentar }}"
                            </p>
                        </div>
                    @empty
                        <div class="py-32 text-center border-2 border-dashed border-accent/10">
                            <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent/20">NO_FINAL_WORDS_LOGGED</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SIDEBAR_RESOURCES -->
            <div class="lg:col-span-4">
                <aside class="sticky top-40 space-y-16 reveal">
                    <div class="glass-organic p-10 shadow-[0_30px_60px_rgba(30,41,35,0.08)] border border-accent/10 space-y-10">
                        <div class="space-y-6">
                            <div class="flex justify-between items-center text-[9px] font-black uppercase tracking-widest text-accent">
                                <span>REMAINING_SEATS</span>
                                <span class="bg-accent/10 px-2 py-0.5 border border-accent/20">{{ $trip->sisa_kuota }} LEFT</span>
                            </div>
                            <div class="w-full h-1.5 bg-accent/10 rounded-full overflow-hidden">
                                <div class="h-full bg-accent rounded-full" style="width: {{ ($trip->kuota - $trip->sisa_kuota) / $trip->kuota * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div class="space-y-4 pt-8 border-t border-accent/10 text-[10px] font-black uppercase tracking-[0.25em]">
                            <div class="flex justify-between items-center">
                                <span class="text-primary/45 italic">Departure_Node</span>
                                <span class="text-primary">{{ $trip->tanggal_berangkat->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-primary/45 italic">Duration_Calc</span>
                                <span class="text-primary">{{ $trip->tanggal_berangkat->diffInDays($trip->tanggal_pulang) }} Days</span>
                            </div>
                        </div>

                        <a href="{{ route('user.booking.form', $trip->slug) }}" class="block w-full bg-accent text-white text-center py-5 text-[10px] font-black uppercase tracking-[0.4em] hover:bg-primary transition-all shadow-lg interactive">
                            Confirm Registration_
                        </a>
                    </div>
                </aside>
            </div>

        </div>
    </main>
</div>
@endsection

@section('scripts')
<script>
    function switchTab(tabId, button) {
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
        document.getElementById(`tab-${tabId}`).classList.remove('hidden');

        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = "tab-btn relative pb-10 text-[11px] font-bold uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-all interactive";
        });
        button.className = "tab-btn relative pb-10 text-[11px] font-bold uppercase tracking-[0.4em] text-primary border-b-2 border-accent interactive";
    }
</script>
@endsection
