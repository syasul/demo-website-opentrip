@extends('layouts.layout')

@section('title', $article->judul . ' | Blog Puncak & Bara')

@section('content')
<article class="max-w-4xl mx-auto px-6 py-12 space-y-8">
    <!-- Header info -->
    <div class="space-y-4 reveal">
        <div class="flex items-center gap-3 text-xs text-text-dark/50">
            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full font-bold uppercase text-[9px]">Tips & Panduan</span>
            <span>Dipublikasikan {{ $article->published_at->format('d M Y') }}</span>
            <span>•</span>
            <span>Oleh {{ $article->author->name }}</span>
        </div>
        
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary leading-tight">
            {{ $article->judul }}
        </h1>
    </div>

    <!-- Cover Image -->
    <div class="relative h-[45vh] rounded-3xl overflow-hidden shadow-sm reveal">
        <img src="{{ $article->gambar_cover ?: 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=1200&q=80' }}" class="w-full h-full object-cover" alt="{{ $article->judul }}">
    </div>

    <!-- Content body -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6 text-sm text-text-dark/75 leading-relaxed reveal">
            <p class="whitespace-pre-line">
                {{ $article->konten }}
            </p>

            <div class="pt-8 border-t border-primary/5 mt-10 flex justify-between items-center">
                <span class="text-xs text-text-dark/50">Bagikan artikel ini:</span>
                <div class="flex gap-2">
                    <a href="https://wa.me/?text={{ urlencode($article->judul . ' - ' . request()->url()) }}" target="_blank" rel="noopener" class="bg-emerald-500 text-white p-2 rounded-xl text-xs font-bold flex items-center gap-1.5 hover:bg-emerald-600 transition-colors">
                        <i data-lucide="share" class="w-4 h-4"></i> WhatsApp
                    </a>
                </div>
            </div>
        </div>

        <!-- Sidebar other articles -->
        <div class="space-y-6">
            <div class="glass-card rounded-3xl p-6 space-y-6 shadow-sm sticky top-28 border border-white/40">
                <h3 class="text-lg font-bold font-serif text-primary border-b border-primary/5 pb-3">Artikel Terbaru</h3>
                <div class="space-y-4">
                    @forelse($otherArticles as $oArt)
                        <div class="space-y-1">
                            <h4 class="text-xs font-bold text-primary hover:underline leading-snug">
                                <a href="{{ route('blog.show', $oArt->slug) }}">{{ $oArt->judul }}</a>
                            </h4>
                            <span class="text-[9px] text-text-dark/40 font-sans block">{{ $oArt->created_at->format('d M Y') }}</span>
                        </div>
                    @empty
                        <p class="text-[11px] text-text-dark/40">Tidak ada artikel lain.</p>
                    @endforelse
                </div>
                
                <div class="pt-4 border-t border-primary/5 text-center">
                    <a href="{{ route('blog') }}" class="text-xs font-bold text-secondary hover:underline flex items-center justify-center gap-1">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Lihat Semua Artikel
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>
@endsection
