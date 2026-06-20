@extends('layouts.admin')

@section('admin-content')
<div class="space-y-8">
    <div class="flex justify-between items-center border-b border-primary/5 pb-4">
        <div>
            <h1 class="text-2xl font-bold font-serif text-primary">Kelola Jurnal & Artikel</h1>
            <p class="text-xs text-text-dark/50">Tulis tips keamanan mendaki, panduan jalur gunung, serta berita komunitas pendaki.</p>
        </div>
        <button onclick="openArticleModal()" class="bg-secondary hover:bg-secondary/90 text-white font-bold text-xs px-4 py-2.5 rounded-xl shadow-md">
            Tulis Artikel Baru
        </button>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    <!-- Articles Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead>
                <tr class="border-b border-primary/10 text-xs font-bold uppercase tracking-wider text-text-dark/50 bg-bg-alt">
                    <th class="p-4">Judul Jurnal</th>
                    <th class="p-4">Penulis</th>
                    <th class="p-4">Tanggal Rilis</th>
                    <th class="p-4">Isi Konten Ringkas</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-primary/5 text-text-dark/75">
                @forelse($articles as $art)
                    <tr>
                        <td class="p-4">
                            <div class="font-bold text-primary">{{ $art->judul }}</div>
                            <div class="text-[10px] text-text-dark/50">{{ $art->slug }}</div>
                        </td>
                        <td class="p-4 text-xs font-semibold text-primary-light">{{ $art->author->name }}</td>
                        <td class="p-4 text-xs">{{ $art->published_at ? $art->published_at->format('d M Y') : 'Draf' }}</td>
                        <td class="p-4 max-w-xs text-xs truncate">{{ $art->konten }}</td>
                        <td class="p-4">
                            <form action="{{ route('admin.articles.delete', $art->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-red-600 hover:underline bg-red-50 px-2.5 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-text-dark/50">Belum ada artikel dipublikasikan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Article -->
<div id="article-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 max-w-lg w-full mx-6 space-y-6 shadow-xl relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeArticleModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <h3 class="text-xl font-bold font-serif text-primary">Tulis Artikel Baru</h3>
        
        <form action="{{ route('admin.articles.store') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary">Judul Artikel</label>
                <input type="text" name="judul" required placeholder="Contoh: 5 Tips Mendaki saat Musim Hujan..." class="px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
            </div>

            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary">Cover Image URL (Unsplash)</label>
                <input type="url" name="gambar_cover" placeholder="https://images.unsplash.com/..." class="px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none">
            </div>

            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary">Konten Lengkap</label>
                <textarea name="konten" required rows="8" placeholder="Tulis konten edukasi Anda di sini..." class="px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none"></textarea>
            </div>

            <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white font-bold py-3.5 rounded-xl transition-all shadow-md text-xs">
                Publikasikan Artikel
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openArticleModal() {
        document.getElementById('article-modal').classList.remove('hidden');
        lucide.createIcons();
    }
    function closeArticleModal() {
        document.getElementById('article-modal').classList.add('hidden');
    }
</script>
@endsection
