@extends('layouts.layout')

@section('title', $trip->nama_gunung . ' | Open Trip Puncak & Bara')

@section('content')
<!-- Cover Header Section -->
<section class="relative h-[45vh] bg-slate-900 text-white overflow-hidden">
    <img src="{{ $trip->image_url ?: 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80' }}" class="absolute inset-0 w-full h-full object-cover opacity-95" alt="{{ $trip->nama_gunung }}">
    <div class="absolute inset-x-0 top-0 h-36 bg-gradient-to-b from-slate-950/80 to-transparent"></div>
    <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-bg-light to-transparent"></div>
    <div class="absolute bottom-12 left-0 w-full z-10">
        <div class="max-w-8xl mx-auto px-4 md:px-8 flex flex-col space-y-3">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 backdrop-blur-md text-accent-blue text-xs font-semibold w-max">
                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> {{ $trip->location }}
            </div>
            <h1 class="text-3xl md:text-5xl font-bold font-serif leading-tight text-white drop-shadow-md">
                {{ $trip->nama_gunung }}
            </h1>
        </div>
    </div>
</section>

<!-- Content Block -->
<section class="max-w-8xl mx-auto px-4 md:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Sliding Underline Tabs -->
            <div class="relative border-b border-primary/10 flex gap-6 pb-2.5 mb-6 overflow-x-auto scrollbar-none">
                <button onclick="switchTab('deskripsi', this)" class="detail-tab font-serif font-bold text-base md:text-lg text-primary border-b-2 border-primary -mb-3 pb-3 relative z-10 transition-all focus:outline-none whitespace-nowrap">
                    Deskripsi & Fasilitas
                </button>
                <button onclick="switchTab('itinerary', this)" class="detail-tab font-serif font-bold text-base md:text-lg text-text-dark/50 hover:text-primary transition-all focus:outline-none whitespace-nowrap">
                    Rencana Perjalanan (Itinerary)
                </button>
                <button onclick="switchTab('ulasan', this)" class="detail-tab font-serif font-bold text-base md:text-lg text-text-dark/50 hover:text-primary transition-all focus:outline-none whitespace-nowrap">
                    Ulasan ({{ $approvedReviews->count() }})
                </button>
            </div>

            <!-- Tab Content Containers -->
            <div id="tab-deskripsi" class="tab-content space-y-6">
                <!-- Description -->
                <div class="glass-card rounded-3xl p-6 md:p-8 space-y-4 shadow-sm border border-white/40 reveal active">
                    <h3 class="text-xl font-bold font-serif text-primary">Deskripsi Perjalanan</h3>
                    <p class="text-text-dark/75 text-sm leading-relaxed whitespace-pre-line">
                        {{ $trip->deskripsi }}
                    </p>
                </div>

                <!-- Inclusions -->
                <div class="glass-card rounded-3xl p-6 md:p-8 space-y-4 shadow-sm border border-white/40 reveal active">
                    <h3 class="text-xl font-bold font-serif text-primary">Fasilitas Termasuk</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @if(is_array($trip->what_is_included))
                            @foreach($trip->what_is_included as $inc)
                                <div class="flex items-start gap-2.5 text-sm text-text-dark/75">
                                    <span class="w-5 h-5 rounded-full bg-primary/15 text-primary flex items-center justify-center shrink-0 mt-0.5">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </span>
                                    <span>{{ $inc }}</span>
                                </div>
                            @endforeach
                        @else
                            <p class="text-xs text-text-dark/50">Info fasilitas belum dimasukkan.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div id="tab-itinerary" class="tab-content space-y-6 hidden">
                <!-- Itinerary Accordions -->
                <div class="glass-card rounded-3xl p-6 md:p-8 space-y-4 shadow-sm border border-white/40 reveal active">
                    <h3 class="text-xl font-bold font-serif text-primary">Itinerary Pendakian</h3>
                    <div class="space-y-3">
                        @if(is_array($trip->itinerary))
                            @foreach($trip->itinerary as $index => $it)
                                <div class="border border-primary/10 rounded-2xl overflow-hidden bg-bg-light/30">
                                    <button class="w-full flex justify-between items-center p-4 text-left font-bold text-sm text-primary hover:bg-primary/5 transition-all outline-none" onclick="toggleItinerary({{ $index }})">
                                        <span>Hari {{ $index + 1 }}: Camp & Perjalanan</span>
                                        <i data-lucide="chevron-down" id="itinerary-icon-{{ $index }}" class="w-4 h-4 transition-transform duration-300"></i>
                                    </button>
                                    <div id="itinerary-content-{{ $index }}" class="hidden p-4 pt-0 text-xs text-text-dark/75 leading-relaxed border-t border-primary/5 bg-white/40">
                                        {{ $it }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-xs text-text-dark/50">Detail itinerary belum diinput.</p>
                        @endif
                    </div>
                </div>
            </div>

            <div id="tab-ulasan" class="tab-content space-y-6 hidden">
                <!-- Reviews -->
                <div class="glass-card rounded-3xl p-6 md:p-8 space-y-6 shadow-sm border border-white/40 reveal active">
                    <h3 class="text-xl font-bold font-serif text-primary">Ulasan Pendaki ({{ $approvedReviews->count() }})</h3>
                    <div class="space-y-6">
                        @forelse($approvedReviews as $rev)
                            <div class="pb-6 border-b border-primary/5 last:border-b-0 space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                        {{ substr($rev->user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-xs font-bold text-text-dark">{{ $rev->user->name }}</span>
                                        <span class="text-[9px] text-text-dark/50 font-sans">{{ $rev->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="ml-auto flex text-yellow-500">
                                        @for($i=0; $i<$rev->rating; $i++)
                                            <i data-lucide="star" class="w-3 h-3 fill-current"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-text-dark/70 italic text-sm pl-11">
                                    "{{ $rev->komentar }}"
                                </p>
                            </div>
                        @empty
                            <p class="text-xs text-text-dark/50">Belum ada ulasan untuk trip ini. Jadilah yang pertama memberikan review!</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Lightbox Photo Gallery -->
            <div class="glass-card rounded-3xl p-6 md:p-8 space-y-4 shadow-sm border border-white/40 reveal active">
                <h3 class="text-xl font-bold font-serif text-primary">Galeri Pendakian</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="relative rounded-2xl overflow-hidden h-24 cursor-pointer group hover:opacity-90 transition-opacity shadow-sm" onclick="openLightbox(0)">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Galeri 1">
                    </div>
                    <div class="relative rounded-2xl overflow-hidden h-24 cursor-pointer group hover:opacity-90 transition-opacity shadow-sm" onclick="openLightbox(1)">
                        <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Galeri 2">
                    </div>
                    <div class="relative rounded-2xl overflow-hidden h-24 cursor-pointer group hover:opacity-90 transition-opacity shadow-sm" onclick="openLightbox(2)">
                        <img src="https://images.unsplash.com/photo-1568230315894-1edd16d248b7?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Galeri 3">
                    </div>
                    <div class="relative rounded-2xl overflow-hidden h-24 cursor-pointer group hover:opacity-90 transition-opacity shadow-sm" onclick="openLightbox(3)">
                        <img src="https://images.unsplash.com/photo-1624467576579-be2fb9795ff0?auto=format&fit=crop&w=600&q=80" class="w-full h-full object-cover" alt="Galeri 4">
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Sidebar Info -->
        <div class="space-y-6">
            <div class="glass-card rounded-3xl p-6 shadow-md sticky top-28 space-y-6 border border-white/40">
                <div class="space-y-1">
                    <span class="text-xs font-semibold text-text-dark/50 uppercase">Harga Per Orang</span>
                    <div class="text-2xl md:text-3xl font-bold text-secondary font-serif">
                        Rp {{ number_format($trip->harga, 0, ',', '.') }}
                    </div>
                </div>

                <div class="border-t border-primary/5 pt-4 space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-text-dark/60 flex items-center gap-1.5"><i data-lucide="gauge" class="w-4 h-4 text-primary"></i> Level Kesulitan</span>
                        <span class="font-bold text-primary">{{ $trip->level_kesulitan }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-text-dark/60 flex items-center gap-1.5"><i data-lucide="users" class="w-4 h-4 text-primary"></i> Sisa Kuota</span>
                        <span class="font-bold text-primary">{{ $trip->sisa_kuota }} / {{ $trip->kuota }} Kursi</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-text-dark/60 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4 text-primary"></i> Tanggal Berangkat</span>
                        <span class="font-bold text-text-dark">{{ $trip->tanggal_berangkat->format('d M Y') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="text-text-dark/60 flex items-center gap-1.5"><i data-lucide="calendar" class="w-4 h-4 text-primary"></i> Tanggal Pulang</span>
                        <span class="font-bold text-text-dark">{{ $trip->tanggal_pulang->format('d M Y') }}</span>
                    </div>
                </div>

                <div class="border-t border-primary/5 pt-4">
                    @if($trip->sisa_kuota <= 0 || $trip->status !== 'Aktif')
                        <button class="w-full bg-slate-300 text-slate-600 font-bold py-3.5 px-6 rounded-2xl cursor-not-allowed text-center text-sm shadow-sm" disabled>
                            Pendaftaran Ditutup
                        </button>
                    @else
                        <a href="{{ route('user.booking.form', $trip->slug) }}" class="block w-full bg-primary hover:bg-primary-light text-white text-center font-bold py-3.5 px-6 rounded-2xl transition-all shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] text-sm">
                            Pesan Tiket Pendakian
                        </a>
                    @endif
                </div>

                <div class="text-center text-[10px] text-text-dark/50 leading-relaxed pt-2">
                    <p>Butuh koordinasi kustom rombongan? Hubungi admin melalui tombol WhatsApp di pojok kanan bawah.</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

<!-- Lightbox Overlay -->
<div id="lightbox" class="fixed inset-0 bg-slate-950/90 z-50 hidden flex flex-col justify-center items-center p-4">
    <button class="absolute top-6 right-6 text-white hover:text-secondary transition-colors focus:outline-none" onclick="closeLightbox()">
        <i data-lucide="x" class="w-8 h-8"></i>
    </button>
    <div class="relative max-w-4xl max-h-[80vh] flex items-center justify-center">
        <button class="absolute left-4 text-white hover:text-secondary transition-colors focus:outline-none bg-black/40 p-2.5 rounded-full" onclick="prevImage()">
            <i data-lucide="chevron-left" class="w-6 h-6"></i>
        </button>
        <img id="lightbox-img" src="" class="max-w-full max-h-[85vh] object-contain rounded-2xl border border-white/10 shadow-2xl" alt="Full Image">
        <button class="absolute right-4 text-white hover:text-secondary transition-colors focus:outline-none bg-black/40 p-2.5 rounded-full" onclick="nextImage()">
            <i data-lucide="chevron-right" class="w-6 h-6"></i>
        </button>
    </div>
</div>

@section('scripts')
<script>
    // 1. Sliding Tabs switching logic
    function switchTab(tabId, button) {
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.add('hidden');
        });
        document.getElementById(`tab-${tabId}`).classList.remove('hidden');

        document.querySelectorAll('.detail-tab').forEach(tab => {
            tab.className = "detail-tab font-serif font-bold text-base md:text-lg text-text-dark/50 hover:text-primary transition-all focus:outline-none whitespace-nowrap";
        });
        button.className = "detail-tab font-serif font-bold text-base md:text-lg text-primary border-b-2 border-primary -mb-3 pb-3 relative z-10 transition-all focus:outline-none whitespace-nowrap";
    }

    // 2. Accordion toggle logic
    function toggleItinerary(index) {
        const content = document.getElementById(`itinerary-content-${index}`);
        const icon = document.getElementById(`itinerary-icon-${index}`);
        
        if (content.classList.contains('hidden')) {
            content.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            content.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // 3. Lightbox gallery logic
    const galleryImages = [
        "https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=1200&q=80",
        "https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&w=1200&q=80",
        "https://images.unsplash.com/photo-1568230315894-1edd16d248b7?auto=format&fit=crop&w=1200&q=80",
        "https://images.unsplash.com/photo-1624467576579-be2fb9795ff0?auto=format&fit=crop&w=1200&q=80"
    ];
    let activeImageIndex = 0;

    function openLightbox(index) {
        activeImageIndex = index;
        document.getElementById('lightbox-img').src = galleryImages[activeImageIndex];
        document.getElementById('lightbox').classList.remove('hidden');
    }

    function closeLightbox() {
        document.getElementById('lightbox').classList.add('hidden');
    }

    function nextImage() {
        activeImageIndex = (activeImageIndex + 1) % galleryImages.length;
        document.getElementById('lightbox-img').src = galleryImages[activeImageIndex];
    }

    function prevImage() {
        activeImageIndex = (activeImageIndex - 1 + galleryImages.length) % galleryImages.length;
        document.getElementById('lightbox-img').src = galleryImages[activeImageIndex];
    }
</script>
@endsection
