@extends('layouts.layout')

@section('title', 'Cari Open Trip Pendakian Gunung | Puncak & Bara')

@section('content')
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12">
    <div class="space-y-4 mb-10 reveal">
        <span class="text-xs font-bold text-secondary uppercase tracking-widest">Eksplorasi Gunung</span>
        <h1 class="text-3xl md:text-5xl font-bold font-serif text-primary">Daftar Open Trip Terjadwal</h1>
        <p class="text-text-dark/60 max-w-xl text-sm leading-relaxed">
            Temukan jadwal trip pendakian gunung terbaik di seluruh Nusantara dengan pilihan level kesulitan yang bervariasi.
        </p>
    </div>

    <!-- Filter Form Shell -->
    <div class="glass-card rounded-3xl p-6 mb-8 shadow-sm border border-white/40 reveal active">
        <form action="{{ route('explore') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary" for="search">Cari Nama Gunung</label>
                <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="search" class="w-4 h-4 text-text-dark/50"></i>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Contoh: Rinjani..." class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary" for="difficulty">Level Kesulitan</label>
                <select id="difficulty" name="difficulty" class="px-3 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm outline-none font-medium cursor-pointer focus:ring-1 focus:ring-primary/20">
                    <option value="">Semua Tingkatan</option>
                    <option value="Pemula" {{ request('difficulty') == 'Pemula' ? 'selected' : '' }}>Pemula (Mudah)</option>
                    <option value="Menengah" {{ request('difficulty') == 'Menengah' ? 'selected' : '' }}>Menengah</option>
                    <option value="Tinggi" {{ request('difficulty') == 'Tinggi' ? 'selected' : '' }}>Tinggi (Menantang)</option>
                </select>
            </div>

            <div class="flex flex-col space-y-1">
                <label class="text-xs font-bold text-primary" for="max_price">Maksimal Harga</label>
                <div class="flex items-center gap-2 px-3 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <span class="text-xs text-text-dark/50 font-bold">Rp</span>
                    <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" placeholder="Contoh: 1500000" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md shadow-primary/10 flex items-center justify-center gap-2 btn-press">
                    <i data-lucide="filter" class="w-4 h-4"></i> Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Layout and Active Filters Bar -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            @if(request('search') || request('difficulty') || request('max_price'))
                <div class="flex flex-wrap items-center gap-2">
                    <span class="text-[10px] font-bold text-text-dark/40 uppercase tracking-wider">Filter Aktif:</span>
                    @if(request('search'))
                        <span class="bg-primary/5 border border-primary/10 px-3 py-1 rounded-full text-xs font-bold text-primary flex items-center gap-1.5">
                            "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithQuery(['search' => null]) }}" class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></a>
                        </span>
                    @endif
                    @if(request('difficulty'))
                        <span class="bg-primary/5 border border-primary/10 px-3 py-1 rounded-full text-xs font-bold text-primary flex items-center gap-1.5">
                            Level: {{ request('difficulty') }}
                            <a href="{{ request()->fullUrlWithQuery(['difficulty' => null]) }}" class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></a>
                        </span>
                    @endif
                    @if(request('max_price'))
                        <span class="bg-primary/5 border border-primary/10 px-3 py-1 rounded-full text-xs font-bold text-primary flex items-center gap-1.5">
                            Max: Rp {{ number_format(request('max_price'), 0, ',', '.') }}
                            <a href="{{ request()->fullUrlWithQuery(['max_price' => null]) }}" class="hover:text-red-500"><i data-lucide="x" class="w-3 h-3"></i></a>
                        </span>
                    @endif
                    <a href="{{ route('explore') }}" class="text-xs font-bold text-rose-500 hover:underline hover:text-rose-600 transition-colors">Hapus Semua</a>
                </div>
            @endif
        </div>
        
        <div class="flex items-center gap-2 bg-slate-100 p-1 rounded-xl self-end md:self-auto shrink-0">
            <button id="btn-grid-layout" onclick="toggleLayout('grid')" class="p-2 rounded-lg bg-primary text-white transition-all shadow-sm focus:outline-none" title="Grid View">
                <i data-lucide="layout-grid" class="w-4 h-4"></i>
            </button>
            <button id="btn-list-layout" onclick="toggleLayout('list')" class="p-2 rounded-lg bg-white text-text-dark/50 hover:text-primary transition-all focus:outline-none" title="List View">
                <i data-lucide="layout-list" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- Trips Grid/List Container -->
    <div id="trips-container" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($trips as $trip)
            <div class="trip-card glass-card rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col reveal active">
                <div class="image-wrapper relative h-56 shrink-0 bg-slate-100">
                    <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=800&q=80' }}" class="w-full h-full object-cover" alt="{{ $trip->nama_gunung }}">
                    <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-md px-3 py-1.5 rounded-full text-[10px] font-extrabold text-primary border border-primary/5 shadow-md">
                        {{ $trip->location }}
                    </div>
                    <div class="absolute top-4 right-4 bg-primary text-white px-3 py-1.5 rounded-full text-[10px] font-extrabold shadow-md">
                        {{ $trip->level_kesulitan }}
                    </div>
                </div>
                
                <div class="content-wrapper p-6 flex-grow flex flex-col justify-between space-y-6">
                    <div class="space-y-3">
                        <h3 class="text-xl font-bold font-serif text-primary hover:text-primary-light">
                            <a href="{{ route('trips.show', $trip->slug) }}">{{ $trip->nama_gunung }}</a>
                        </h3>
                        <p class="text-text-dark/65 text-xs line-clamp-3 leading-relaxed">
                            {{ $trip->deskripsi }}
                        </p>
                    </div>
                    
                    <div class="pt-4 border-t border-primary/5 flex justify-between items-center text-xs text-text-dark/65 font-sans">
                        <div class="flex items-center gap-1">
                            <i data-lucide="calendar" class="w-4 h-4 text-secondary"></i>
                            <span>{{ $trip->tanggal_berangkat->format('d M') }} - {{ $trip->tanggal_pulang->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-1 font-bold text-primary">
                            <i data-lucide="users-2" class="w-4 h-4"></i>
                            <span>Sisa {{ $trip->sisa_kuota }} Slot</span>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <div class="flex flex-col">
                            <span class="text-[9px] uppercase tracking-wider text-text-dark/50 leading-none">Harga Paket</span>
                            <span class="text-lg font-bold text-secondary">Rp {{ number_format($trip->harga, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('trips.show', $trip->slug) }}" class="bg-primary hover:bg-primary-light text-white font-bold text-xs px-5 py-2.5 rounded-xl transition-all btn-press shadow-md shadow-primary/5">
                            Detail Trip
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-20 bg-white rounded-3xl border border-primary/5 shadow-sm">
                <div class="w-16 h-16 bg-bg-alt text-primary/45 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                    <i data-lucide="info" class="w-8 h-8"></i>
                </div>
                <h3 class="text-lg font-bold font-serif text-primary">Trip Tidak Ditemukan</h3>
                <p class="text-xs text-text-dark/50 mt-1 max-w-sm mx-auto">
                    Tidak ada jadwal pendakian yang cocok dengan kriteria filter Anda saat ini.
                </p>
                <div class="mt-6">
                    <a href="{{ route('explore') }}" class="inline-flex items-center gap-1.5 bg-primary hover:bg-primary-light text-white font-extrabold text-xs px-5 py-2.5 rounded-xl transition-all shadow-md">
                        <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i> Reset Pencarian
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</section>
@endsection

@section('scripts')
<script>
    function toggleLayout(type) {
        const container = document.getElementById('trips-container');
        const cards = document.querySelectorAll('.trip-card');
        
        const gridBtn = document.getElementById('btn-grid-layout');
        const listBtn = document.getElementById('btn-list-layout');

        if (type === 'list') {
            container.className = "flex flex-col gap-6";
            cards.forEach(card => {
                card.className = "trip-card glass-card rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col md:flex-row reveal active";
                card.querySelector('.image-wrapper').className = "image-wrapper relative w-full md:w-72 h-48 md:h-full shrink-0 bg-slate-100";
                card.querySelector('.content-wrapper').className = "content-wrapper p-6 flex-grow flex flex-col justify-between space-y-4 md:space-y-0";
            });
            listBtn.classList.add('bg-primary', 'text-white');
            listBtn.classList.remove('bg-white', 'text-text-dark/50');
            gridBtn.classList.remove('bg-primary', 'text-white');
            gridBtn.classList.add('bg-white', 'text-text-dark/50');
        } else {
            container.className = "grid grid-cols-1 md:grid-cols-3 gap-8";
            cards.forEach(card => {
                card.className = "trip-card glass-card rounded-3xl overflow-hidden shadow-sm hover:shadow-lg transition-all flex flex-col reveal active";
                card.querySelector('.image-wrapper').className = "image-wrapper relative h-56 shrink-0 bg-slate-100";
                card.querySelector('.content-wrapper').className = "content-wrapper p-6 flex-grow flex flex-col justify-between space-y-6";
            });
            gridBtn.classList.add('bg-primary', 'text-white');
            gridBtn.classList.remove('bg-white', 'text-text-dark/50');
            listBtn.classList.remove('bg-primary', 'text-white');
            listBtn.classList.add('bg-white', 'text-text-dark/50');
        }
    }
</script>
@endsection

