@extends('layouts.layout')

@section('title', $article->judul . ' | Altimeter Log | Sanford')

@section('content')
<div class="bg-[#F3F2EE] selection:bg-accent selection:text-white min-h-screen pt-48 pb-32">
    
    <article class="max-w-7xl mx-auto px-10">
        <!-- CHRONICLE_HEADER -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-end mb-20 reveal">
            <div class="lg:col-span-8 space-y-8">
                <div class="flex items-center gap-6">
                    <span class="text-accent text-[10px] font-bold uppercase tracking-[1.5em] block">DISPATCH_DETAIL_V1</span>
                    <div class="flex-grow h-px bg-accent/20"></div>
                </div>
                <h1 class="text-5xl lg:text-8xl font-serif italic text-primary leading-tight">
                    {{ $article->judul }}
                </h1>
                <div class="flex items-center gap-8 text-[10px] font-bold uppercase tracking-widest text-primary/60">
                    <span>{{ $article->created_at->format('d M Y') }}</span>
                    <span>•</span>
                    <span>By {{ $article->author->name }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-20">
            <!-- FEATURED_IMAGE -->
            <div class="lg:col-span-12 h-[60vh] overflow-hidden shadow-2xl reveal mb-20">
                <img src="{{ $article->gambar_cover }}" class="w-full h-full object-cover brightness-95 contrast-110 active-zoom">
            </div>

            <!-- NARRATIVE_CONTENT -->
            <div class="lg:col-span-8 space-y-12 reveal">
                <div class="prose prose-lg max-w-none">
                    <p class="text-primary/80 text-xl leading-relaxed italic font-serif whitespace-pre-line">
                        {{ $article->konten }}
                    </p>
                </div>

                <div class="pt-12 border-t border-accent/10 flex justify-between items-center">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-primary/40">SECURE_DISPATCH_PROTOCOL</span>
                    <a href="https://wa.me/?text={{ urlencode($article->judul . ' - ' . request()->url()) }}" target="_blank" rel="noopener" class="bg-accent text-white px-8 py-4 text-[10px] font-bold uppercase tracking-[0.4em] hover:bg-primary transition-all flex items-center gap-4">
                        Share Dispatch_ <i data-lucide="share-2" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <!-- SIDEBAR_CHRONICLES -->
            <div class="lg:col-span-4">
                <aside class="sticky top-40 space-y-12 reveal">
                    <div class="glass-organic p-10 space-y-10 shadow-xl border border-accent/5">
                        <h4 class="text-xs font-bold text-accent uppercase tracking-[0.4em] border-b border-accent/10 pb-4">Latest_Entries</h4>
                        <div class="space-y-8">
                            @forelse($otherArticles as $oArt)
                                <div class="group space-y-2">
                                    <h5 class="text-sm font-serif italic text-primary hover:text-accent transition-colors leading-snug">
                                        <a href="{{ route('blog.show', $oArt->slug) }}">{{ $oArt->judul }}</a>
                                    </h5>
                                    <span class="text-[9px] font-bold text-primary/30 uppercase tracking-widest">{{ $oArt->created_at->format('d M Y') }}</span>
                                </div>
                            @empty
                                <p class="text-[11px] font-bold text-primary/30 uppercase">NO_OTHER_LOGS</p>
                            @endforelse
                        </div>
                        
                        <div class="pt-8 border-t border-accent/10">
                            <a href="{{ route('blog') }}" class="text-[10px] font-bold text-accent uppercase tracking-widest hover:underline flex items-center justify-center gap-4">
                                <i data-lucide="arrow-left" class="w-4 h-4"></i> Return to Archives
                            </a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </article>
</div>
@endsection
