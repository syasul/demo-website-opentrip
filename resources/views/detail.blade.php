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
                    <h1 class="text-6xl md:text-9xl lg:text-[14rem] font-serif italic text-primary leading-[0.75] tracking-tight">
                        {{ $trip->nama_gunung }}<span class="text-accent underline decoration-1">.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 glass-organic p-8 lg:p-12 space-y-8 lg:space-y-10 reveal shadow-2xl">
                    <div class="space-y-2">
                        <span class="text-[9px] font-bold uppercase tracking-widest text-accent block">CURRENT_VALUATION</span>
                        <span class="text-4xl lg:text-5xl font-bold text-primary italic tracking-tighter">IDR {{ number_format($trip->harga/1000, 0, ',', '.') }}K</span>
                    </div>
                    <div class="grid grid-cols-2 gap-8 lg:gap-10 pt-8 lg:pt-10 border-t border-accent/10">
                        <div class="space-y-1">
                            <span class="text-[8px] font-bold uppercase tracking-widest text-primary/40">STABILITY_LV</span>
                            <span class="text-sm font-bold text-primary uppercase tracking-widest">{{ $trip->level_kesulitan }}</span>
                        </div>
                        <div class="space-y-1 text-right">
                            <span class="text-[8px] font-bold uppercase tracking-widest text-primary/40">ELEVATION</span>
                            <span class="text-sm font-bold text-primary uppercase tracking-widest">{{ number_format($trip->ketinggian ?? 3676) }}M</span>
                        </div>
                    </div>
                    <a href="{{ route('user.booking.form', $trip->slug) }}" class="block w-full bg-accent text-white text-center py-5 lg:py-6 text-[11px] font-bold uppercase tracking-[0.5em] hover:bg-primary transition-all interactive shadow-lg">
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
                <nav class="flex items-center gap-12 border-b border-accent/10 reveal">
                    <button onclick="switchTab('deskripsi', this)" class="tab-btn relative pb-10 text-[11px] font-bold uppercase tracking-[0.4em] text-primary border-b-2 border-accent interactive">01_Briefing</button>
                    <button onclick="switchTab('itinerary', this)" class="tab-btn relative pb-10 text-[11px] font-bold uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-all interactive">02_Logbook</button>
                    <button onclick="switchTab('ulasan', this)" class="tab-btn relative pb-10 text-[11px] font-bold uppercase tracking-[0.4em] text-gray-400 hover:text-primary transition-all interactive">03_Final_Words</button>
                </nav>

                <!-- TAB: BRIEFING -->
                <div id="tab-deskripsi" class="tab-pane space-y-24 reveal">
                    <div class="prose max-w-none">
                        <p class="text-gray-600 text-xl leading-relaxed italic font-serif">
                            "{{ $trip->deskripsi }}"
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <div class="bg-white p-12 space-y-8 shadow-sm">
                            <div class="flex items-center gap-4">
                                <div class="w-2 h-12 bg-accent"></div>
                                <h4 class="text-xs font-bold text-primary uppercase tracking-[0.4em]">Integrated Logistics</h4>
                            </div>
                            <ul class="space-y-6">
                                @foreach($trip->what_is_included ?? ['Professional Guides', 'Entry Permits', 'Nature Gear Kit', 'High-Altitude Nutrition'] as $inc)
                                    <li class="text-[12px] font-bold uppercase tracking-widest text-gray-500 flex items-center gap-6">
                                        <i data-lucide="leaf" class="w-4 h-4 text-accent/40"></i> {{ $inc }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="bg-[#1E2923] p-12 space-y-8 shadow-xl">
                            <div class="flex items-center gap-4">
                                <div class="w-2 h-12 bg-accent-soft"></div>
                                <h4 class="text-xs font-bold text-white uppercase tracking-[0.4em]">Field Requirements</h4>
                            </div>
                            <ul class="space-y-6">
                                <li class="text-[12px] font-bold uppercase tracking-widest text-[#A8B5AA] flex items-center gap-6">
                                    <i data-lucide="shield" class="w-4 h-4"></i> CLIMATE-READY SHELL
                                </li>
                                <li class="text-[12px] font-bold uppercase tracking-widest text-[#A8B5AA] flex items-center gap-6">
                                    <i data-lucide="shield" class="w-4 h-4"></i> ARCH-SUPPORT FOOTWEAR
                                </li>
                                <li class="text-[12px] font-bold uppercase tracking-widest text-[#A8B5AA] flex items-center gap-6">
                                    <i data-lucide="shield" class="w-4 h-4"></i> HYDRATION_SYSTEM_3L
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- TAB: LOGBOOK (Itinerary) -->
                <div id="tab-itinerary" class="tab-pane hidden space-y-20 reveal">
                    <div class="space-y-16">
                        @forelse($trip->itinerary ?? [] as $index => $it)
                            <div class="flex gap-16 group">
                                <div class="shrink-0 space-y-4 text-center">
                                    <span class="text-5xl font-serif italic text-accent/20 group-hover:text-accent transition-colors">0{{ $index + 1 }}</span>
                                    <div class="w-px h-full bg-accent/10 mx-auto"></div>
                                </div>
                                <div class="pt-4 space-y-4">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">CHAPTER_PROTOCOL</span>
                                    <p class="text-gray-600 text-lg leading-relaxed font-medium italic">
                                        {{ $it }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="py-32 text-center border-2 border-dashed border-accent/10">
                                <span class="text-[11px] font-bold uppercase tracking-[1em] text-accent/20">LOGBOOK_NOT_YET_ARCHIVED</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- TAB: REVIEWS (Final Words) -->
                <div id="tab-ulasan" class="tab-pane hidden space-y-16 reveal">
                    @forelse($approvedReviews ?? [] as $rev)
                        <div class="bg-white p-16 shadow-lg space-y-8 relative overflow-hidden">
                            <div class="absolute -right-10 -top-10 opacity-[0.03]">
                                <i data-lucide="quote" class="w-48 h-48 text-accent"></i>
                            </div>
                            <div class="flex items-center gap-8 relative z-10">
                                <div class="w-14 h-14 bg-accent/10 border border-accent/20 flex items-center justify-center text-accent text-sm font-bold">
                                    {{ substr($rev->user->name, 0, 2) }}
                                </div>
                                <div class="space-y-1">
                                    <span class="text-sm font-bold text-primary uppercase tracking-widest">{{ $rev->user->name }}</span>
                                    <div class="flex text-accent gap-0.5">
                                        @for($i=0; $i<$rev->rating; $i++)
                                            <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-600 text-2xl font-serif italic leading-relaxed relative z-10">
                                "{{ $rev->komentar }}"
                            </p>
                        </div>
                    @empty
                        <div class="py-32 text-center border-2 border-dashed border-accent/10">
                            <span class="text-[11px] font-bold uppercase tracking-[1em] text-accent/20">NO_FINAL_WORDS_LOGGED</span>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- SIDEBAR_RESOURCES -->
            <div class="lg:col-span-4">
                <aside class="sticky top-40 space-y-16 reveal">
                    <div class="bg-white p-12 shadow-2xl border border-accent/5 space-y-12">
                        <div class="space-y-8">
                            <div class="flex justify-between items-center text-[9px] font-bold uppercase tracking-widest text-accent/60">
                                <span>REMAINING_SEATS</span>
                                <span>{{ $trip->sisa_kuota }} LEFT</span>
                            </div>
                            <div class="w-full h-1 bg-accent/10">
                                <div class="h-full bg-accent" style="width: {{ ($trip->kuota - $trip->sisa_kuota) / $trip->kuota * 100 }}%"></div>
                            </div>
                        </div>
                        
                        <div class="space-y-6 pt-10 border-t border-accent/5 text-[10px] font-bold uppercase tracking-[0.3em]">
                            <div class="flex justify-between">
                                <span class="text-gray-400 italic">Departure_Node</span>
                                <span class="text-primary">{{ $trip->tanggal_berangkat->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400 italic">Duration_Calc</span>
                                <span class="text-primary">{{ $trip->tanggal_berangkat->diffInDays($trip->tanggal_pulang) }} Days</span>
                            </div>
                        </div>

                        <a href="{{ route('user.booking.form', $trip->slug) }}" class="block w-full bg-accent text-white text-center py-6 text-[11px] font-bold uppercase tracking-[0.5em] hover:bg-primary transition-all shadow-lg interactive">
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
