@extends('layouts.user')

@section('user-content')
<div class="space-y-12 selection:bg-accent selection:text-black">
    <!-- Header: Operational Overview -->
    <div class="flex flex-col md:flex-row justify-between items-end gap-8 reveal">
        <div class="space-y-4">
            <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent">Strategic Overview</span>
            <h1 class="text-6xl font-black uppercase tracking-tighter leading-none">Dashboard<span class="text-accent underline decoration-1">.</span></h1>
        </div>
        <div class="flex border border-black divide-x divide-black">
            <div class="p-8 space-y-1">
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-400 block">Active Trips</span>
                <span class="text-3xl font-black italic tracking-tighter">{{ $bookings->where('status_pembayaran', 'Lunas')->count() }}</span>
            </div>
            <div class="p-8 space-y-1 bg-black text-white">
                <span class="text-[9px] font-black uppercase tracking-widest text-gray-500 block">Account Tier</span>
                <span class="text-3xl font-black italic tracking-tighter text-accent">ELITE_</span>
            </div>
        </div>
    </div>

    <!-- Layout Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-12 items-start">
        
        <!-- Left: Mission Log -->
        <div class="xl:col-span-8 space-y-12">
            <div class="space-y-8 reveal">
                <div class="flex items-center justify-between border-b border-gray-100 pb-8">
                    <h2 class="text-[10px] font-black uppercase tracking-[0.4em]">Expedition Archive</h2>
                    <div class="flex border border-black overflow-hidden">
                        <button onclick="filterBookings('all', this)" class="booking-tab px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em] bg-black text-white transition-all interactive">All_</button>
                        <button onclick="filterBookings('Pending', this)" class="booking-tab px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em] bg-white text-black hover:bg-gray-50 transition-all interactive">Pending_</button>
                    </div>
                </div>

                <div class="space-y-px bg-gray-100 border border-gray-100">
                    @forelse($bookings as $booking)
                        <div class="booking-row p-8 bg-white group hover:bg-gray-50 transition-all duration-500" data-status="{{ $booking->status_pembayaran }}">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-12">
                                <div class="flex items-center gap-8">
                                    <div class="w-20 h-20 bg-gray-100 overflow-hidden border border-gray-100">
                                        <img src="{{ $booking->trip->image_url }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                                    </div>
                                    <div class="space-y-2">
                                        <h3 class="text-xl font-black uppercase tracking-tighter">{{ $booking->trip->nama_gunung }}</h3>
                                        <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">
                                            {{ $booking->trip->tanggal_berangkat->format('M d, Y') }} // {{ $booking->jumlah_peserta }} PAX
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-12">
                                    <div class="text-right space-y-1">
                                         <span class="text-lg font-black italic tracking-tighter block">IDR {{ number_format($booking->total_harga/1000, 0, ',', '.') }}K</span>
                                         <span class="text-[8px] font-black uppercase tracking-widest {{ $booking->status_pembayaran == 'Lunas' ? 'text-accent' : 'text-amber-500' }}">
                                            Status: {{ strtoupper($booking->status_pembayaran) }}
                                         </span>
                                    </div>
                                    <a href="{{ route('user.invoice', $booking->id) }}" class="w-12 h-12 border border-black flex items-center justify-center hover:bg-black hover:text-white transition-all interactive">
                                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-32 text-center bg-white">
                            <span class="text-[10px] font-black uppercase tracking-[0.5em] text-gray-300">No Mission Data Available</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Tactical Intel -->
        <div class="xl:col-span-4 space-y-12">
            
            <!-- Protocol Alerts -->
            <div class="p-10 bg-black text-white space-y-8 reveal">
                <div class="flex justify-between items-center border-b border-white/10 pb-6">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.4em]">Tactical Alerts</h3>
                    <span class="w-2 h-2 bg-accent animate-pulse"></span>
                </div>
                <div class="space-y-6">
                    <div class="flex gap-6 items-start p-6 bg-white/5 border border-white/10">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-accent shrink-0"></i>
                        <div class="space-y-2">
                            <p class="text-[9px] font-black text-accent uppercase tracking-widest">Pending Fulfillment</p>
                            <p class="text-gray-400 text-xs font-medium leading-relaxed">Invoice #{{ $bookings->first()?->id ?: '0000' }} requires immediate verification Sequence.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Archival Wishlist -->
            <div class="p-10 border border-black space-y-8 reveal">
                <h3 class="text-[10px] font-black uppercase tracking-[0.4em] border-b border-gray-100 pb-6">Interested Archives</h3>
                <div class="space-y-8">
                    @php
                        $wishlist = [
                            ['name' => 'Gunung Rinjani', 'loc' => 'Lombok, NTB', 'img' => 'https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format'],
                            ['name' => 'Gunung Semeru', 'loc' => 'Jawa Timur', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format']
                        ];
                    @endphp
                    @foreach($wishlist as $item)
                        <div class="flex items-center gap-6 group interactive">
                            <div class="w-14 h-14 bg-gray-100 overflow-hidden border border-gray-100">
                                <img src="{{ $item['img'] }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700">
                            </div>
                            <div class="space-y-1">
                                <h4 class="text-[10px] font-black uppercase tracking-[0.2em]">{{ $item['name'] }}</h4>
                                <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest">{{ $item['loc'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Tactical Post-Expedition Report Modal -->
<div id="review-modal" class="fixed inset-0 z-[200] flex items-center justify-center bg-black/90 hidden p-6">
    <div class="bg-white p-12 max-w-xl w-full space-y-10 relative reveal">
        <button onclick="closeReviewModal()" class="absolute top-8 right-8 text-gray-300 hover:text-black transition-colors interactive">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
 
        <div class="space-y-4">
            <span class="text-[10px] font-black uppercase tracking-[0.5em] text-accent">Debrief Protocol</span>
            <h3 class="text-4xl font-black uppercase tracking-tighter">Mission Report<span class="text-accent underline">.</span></h3>
            <p id="modal-trip-name" class="text-[10px] font-bold text-gray-400 uppercase tracking-widest"></p>
        </div>

        <form id="review-form" action="" method="POST" class="space-y-10">
            @csrf
            
            <div class="space-y-4">
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Success Rating</label>
                <div class="flex gap-4">
                    <input type="hidden" name="rating" id="rating-input" value="5">
                    @for($i=1; $i<=5; $i++)
                        <button type="button" onclick="setRating('{{ $i }}')" class="interactive group">
                            <i data-rating-star="{{ $i }}" data-lucide="star" class="w-8 h-8 text-accent fill-current group-hover:scale-110 transition-transform"></i>
                        </button>
                    @endfor
                </div>
            </div>

            <div class="space-y-4">
                <label for="komentar" class="text-[10px] font-black uppercase tracking-widest text-gray-400">Expedition Summary</label>
                <textarea id="komentar" name="komentar" rows="5" required placeholder="DOCUMENT YOUR EXPERIENCE..." class="w-full bg-gray-50 border-b-2 border-gray-100 p-4 text-xs font-bold uppercase tracking-widest outline-none focus:border-black transition-colors"></textarea>
            </div>

            <button type="submit" class="w-full bg-black text-white py-8 text-[11px] font-black uppercase tracking-[0.5em] hover:bg-accent hover:text-black transition-all interactive">
                SUBMIT DEBRIEF_
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterBookings(status, button) {
        document.querySelectorAll('.booking-row').forEach(row => {
            if (status === 'all' || row.getAttribute('data-status') === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        document.querySelectorAll('.booking-tab').forEach(tab => {
            tab.className = "booking-tab px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em] bg-white text-black hover:bg-gray-50 transition-all interactive";
        });
        button.className = "booking-tab px-6 py-3 text-[9px] font-black uppercase tracking-[0.2em] bg-black text-white transition-all interactive";
    }

    function openReviewModal(tripId, tripName) {
        document.getElementById('modal-trip-name').innerText = tripName;
        document.getElementById('review-form').action = `/reviews/${tripId}`;
        document.getElementById('review-modal').classList.remove('hidden');
        document.getElementById('review-modal').querySelector('.reveal').classList.add('active');
        if (window.lucide) window.lucide.createIcons();
    }

    function closeReviewModal() {
        document.getElementById('review-modal').classList.add('hidden');
    }

    function setRating(val) {
        document.getElementById('rating-input').value = val;
        for (let i = 1; i <= 5; i++) {
            const star = document.querySelector(`[data-rating-star="${i}"]`);
            if (i <= val) {
                star.classList.add('text-accent', 'fill-current');
                star.classList.remove('text-gray-100');
            } else {
                star.classList.remove('text-accent', 'fill-current');
                star.classList.add('text-gray-100');
            }
        }
    }
</script>
@endsection
