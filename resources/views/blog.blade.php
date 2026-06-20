@extends('layouts.layout')

@section('title', 'Artikel & Tips Pendakian | Puncak & Bara')

@section('content')
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12">
    <div class="space-y-4 mb-12 reveal">
        <span class="text-xs font-bold text-secondary uppercase tracking-widest">Artikel & Edukasi</span>
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary">Jurnal Petualang</h1>
        <p class="text-text-dark/60 max-w-xl text-sm leading-relaxed">
            Kumpulan tips keselamatan pendakian, panduan aklimatisasi, ulasan peralatan gunung, dan kisah perjalanan dari para pemandu kami.
        </p>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($articles as $art)
            <div class="glass-card rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-shadow flex flex-col reveal">
                <div class="relative h-48 bg-slate-100">
                    <img src="{{ $art->gambar_cover ?: 'https://images.unsplash.com/photo-1501555088652-021faa106b9b?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover" alt="{{ $art->judul }}">
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-[10px] font-bold text-secondary uppercase">
                            <span>Panduan Pendaki</span>
                            <span class="text-text-dark/40 font-medium font-sans lowercase">{{ $art->created_at->diffForHumans() }}</span>
                        </div>
                        <h3 class="text-lg font-bold font-serif text-primary hover:underline">
                            <a href="{{ route('blog.show', $art->slug) }}">{{ $art->judul }}</a>
                        </h3>
                        <p class="text-text-dark/70 text-xs line-clamp-3 leading-relaxed">
                            {{ $art->konten }}
                        </p>
                    </div>
                    <a href="{{ route('blog.show', $art->slug) }}" class="text-xs font-bold text-primary hover:text-primary-light inline-flex items-center gap-1">
                        Baca Selengkapnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-20 glass-card rounded-3xl border border-white/40">
                <h3 class="text-lg font-bold font-serif text-primary">Belum Ada Artikel</h3>
                <p class="text-xs text-text-dark/50 mt-1">Kami akan segera menerbitkan tips pendakian perdana.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination Links -->
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</section>
@endsection
