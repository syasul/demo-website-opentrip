@extends('layouts.layout')

@section('title', 'Altimeter Logs | Sanford Nature Collective')

@section('content')
<div class="bg-[#F3F2EE] selection:bg-accent selection:text-white min-h-screen pt-48 pb-32">
    
    <!-- JOURNAL_HEADER -->
    <div class="max-w-7xl mx-auto px-10 mb-24 border-b border-accent/10 pb-20 relative overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-end relative z-10">
            <div class="lg:col-span-8 space-y-8">
                <div class="flex items-center gap-6">
                    <span class="text-accent text-[10px] font-bold uppercase tracking-[1.5em] block reveal">DISPATCH_LOGS</span>
                    <div class="flex-grow h-px bg-accent/20"></div>
                </div>
                <h1 class="text-7xl lg:text-[10rem] font-serif italic text-primary leading-[0.8] reveal">
                    Altimeter <br/><span class="text-accent underline decoration-1">Logs.</span>
                </h1>
            </div>
            <div class="lg:col-span-4 pb-4 reveal">
                <p class="text-primary/60 text-xl font-medium leading-relaxed border-l-4 border-accent pl-10">
                    A curated chronicle of field observations, technical briefings, and ancestral mountain wisdom.
                </p>
            </div>
        </div>
    </div>

    <section class="max-w-7xl mx-auto px-10">
        <!-- CHRONICLE_GRID -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-24">
            @forelse($articles as $art)
                <div class="group bg-white border border-accent/5 shadow-[0_8px_30px_rgb(0,0,0,0.03)] hover:shadow-[0_30px_60px_rgba(30,41,35,0.07)] hover:-translate-y-2 transition-all duration-700 reveal overflow-hidden flex flex-col justify-between">
                    <div>
                        <!-- Cover Image Wrapper with hover zoom & dark overlay fade -->
                        <div class="aspect-[16/10] overflow-hidden relative grayscale contrast-125 group-hover:grayscale-0 transition-all duration-[2000ms]">
                            <div class="absolute inset-0 bg-[#1E2923]/30 group-hover:bg-transparent transition-colors duration-1000 z-10"></div>
                            <img src="{{ $art->gambar_cover }}" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-[3000ms]">
                            <span class="absolute top-6 left-6 z-20 bg-accent text-white text-[8px] font-black uppercase tracking-[0.3em] px-4 py-2">
                                dispatch_
                            </span>
                        </div>
                        
                        <div class="p-10 space-y-6 relative">
                            <!-- Category & Date line with subtle dot separator -->
                            <div class="flex items-center gap-4 text-[9px] font-black uppercase tracking-[0.25em] text-accent/70">
                                <span>{{ $art->created_at->format('M d, Y') }}</span>
                                <span class="w-1.5 h-1.5 rounded-full bg-accent/35"></span>
                                <span>Field Log</span>
                            </div>
                            
                            <!-- Title with animated underline effect -->
                            <h3 class="text-2xl font-serif italic text-primary leading-snug">
                                <a href="{{ route('blog.show', $art->slug) }}" class="interactive group-hover:text-accent transition-colors relative inline-block">
                                    {{ $art->judul }}
                                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-accent transition-all duration-500 group-hover:w-full"></span>
                                </a>
                            </h3>

                            <p class="text-primary/70 text-[13px] leading-relaxed font-medium line-clamp-3">
                                {{ $art->konten }}
                            </p>
                        </div>
                    </div>
                    
                    <!-- Premium footer signature -->
                    <div class="p-10 pt-0">
                        <div class="pt-6 border-t border-accent/5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-6 h-6 rounded-full bg-primary/5 flex items-center justify-center border border-accent/10">
                                    <span class="text-[8px] font-black text-accent">PB</span>
                                </div>
                                <span class="text-[9px] font-black uppercase tracking-widest text-primary/55">Editorial Staff</span>
                            </div>
                            <a href="{{ route('blog.show', $art->slug) }}" class="text-accent text-[9px] font-black uppercase tracking-[0.25em] hover:text-primary transition-all interactive flex items-center gap-2">
                                Read Log_ <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-48 text-center border-2 border-dashed border-accent/10">
                    <span class="text-[12px] font-bold uppercase tracking-[1em] text-accent/20 italic animate-pulse">NO_LOGS_FOUND_IN_ARCHIVE</span>
                </div>
            @endforelse
        </div>

        <!-- LOG_PAGINATION -->
        <div class="flex justify-center">
            {{ $articles->links() }}
        </div>
    </section>
</div>
@endsection
