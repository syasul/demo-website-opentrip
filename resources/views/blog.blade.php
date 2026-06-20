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
                <div class="group bg-white shadow-xl hover:shadow-2xl transition-all duration-700 reveal overflow-hidden">
                    <div class="aspect-[16/10] overflow-hidden grayscale contrast-125 group-hover:grayscale-0 transition-all duration-[2000ms]">
                        <img src="{{ $art->gambar_cover }}" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-[3000ms]">
                    </div>
                    
                    <div class="p-12 space-y-8 relative">
                        <div class="flex justify-between items-center text-[10px] font-bold uppercase tracking-[0.4em] text-accent/60">
                            <span>CATEGORY_DISPATCH</span>
                            <span>{{ $art->created_at->format('M d, Y') }}</span>
                        </div>
                        
                        <h3 class="text-3xl font-serif italic text-primary leading-tight">
                            <a href="{{ route('blog.show', $art->slug) }}" class="interactive group-hover:text-accent transition-colors">{{ $art->judul }}</a>
                        </h3>

                        <p class="text-primary/60 text-sm leading-relaxed font-medium line-clamp-3 italic">
                            {{ $art->konten }}
                        </p>
                        
                        <div class="pt-8 border-t border-accent/5">
                            <a href="{{ route('blog.show', $art->slug) }}" class="text-accent text-[11px] font-bold uppercase tracking-widest hover:underline interactive flex items-center gap-4">
                                Read Log_ <i data-lucide="arrow-right" class="w-4 h-4"></i>
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
