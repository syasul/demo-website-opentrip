@extends('layouts.user')

@section('user-content')
<div class="space-y-8">
    <!-- Header Banner -->
    <div class="bg-gradient-to-br from-primary to-primary-light text-white p-6 md:p-8 rounded-3xl space-y-4 shadow-sm reveal active">
        <h1 class="text-2xl md:text-4xl font-bold font-serif leading-tight">Halo, {{ Auth::user()->name }}!</h1>
        <p class="text-sm text-white/95 max-w-xl">
            Selamat datang di Panel Pendaki. Di sini Anda bisa mengelola registrasi trip gunung, mengunggah bukti transfer, dan menulis ulasan petualangan Anda.
        </p>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-start">
        
        <!-- Left Side: Bookings & Notifications -->
        <div class="xl:col-span-2 space-y-8">
            
            <!-- Bookings List with Filter Tabs -->
            <div class="space-y-4 reveal active">
                <h2 class="text-lg font-bold font-serif text-primary">Riwayat Registrasi Trip</h2>
                
                <!-- Filter Tabs -->
                <div class="flex gap-4 border-b border-primary/5 pb-2">
                    <button onclick="filterBookings('all', this)" class="booking-tab text-xs font-bold text-primary border-b-2 border-primary pb-2 focus:outline-none">
                        Semua
                    </button>
                    <button onclick="filterBookings('Pending', this)" class="booking-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none">
                        Belum Bayar
                    </button>
                    <button onclick="filterBookings('Terverifikasi', this)" class="booking-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none">
                        Diverifikasi
                    </button>
                    <button onclick="filterBookings('Lunas', this)" class="booking-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none">
                        Lunas
                    </button>
                </div>

                <div class="overflow-x-auto bg-white rounded-2xl border border-primary/5">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-primary/10 text-[10px] font-bold uppercase tracking-wider text-text-dark/50 bg-bg-alt">
                                <th class="p-4">Gunung / Destinasi</th>
                                <th class="p-4">Tanggal Keberangkatan</th>
                                <th class="p-4">Jumlah Peserta</th>
                                <th class="p-4">Total Biaya</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-primary/5 text-xs text-text-dark/75">
                            @forelse($bookings as $booking)
                                <tr class="booking-row transition-all hover:bg-slate-50" data-status="{{ $booking->status_pembayaran }}">
                                    <td class="p-4">
                                        <div class="font-bold text-primary text-sm">{{ $booking->trip->nama_gunung }}</div>
                                        <div class="text-[9px] text-text-dark/50">{{ $booking->trip->location }}</div>
                                    </td>
                                    <td class="p-4">{{ $booking->trip->tanggal_berangkat->format('d M Y') }}</td>
                                    <td class="p-4 font-bold">{{ $booking->jumlah_peserta }} Orang</td>
                                    <td class="p-4 font-semibold text-secondary">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        @if($booking->status_pembayaran === 'Pending')
                                            <span class="inline-block bg-amber-50 text-amber-600 border border-amber-200 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                                Belum Bayar
                                            </span>
                                        @elseif($booking->status_pembayaran === 'Terverifikasi')
                                            <span class="inline-block bg-blue-50 text-blue-600 border border-blue-200 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                                Diverifikasi
                                            </span>
                                        @elseif($booking->status_pembayaran === 'Lunas')
                                            <span class="inline-block bg-green-50 text-green-600 border border-green-200 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                                Lunas
                                            </span>
                                        @else
                                            <span class="inline-block bg-red-50 text-red-600 border border-red-200 px-2.5 py-0.5 rounded-full text-[10px] font-bold">
                                                Batal
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('user.invoice', $booking->id) }}" class="text-[10px] font-bold text-primary hover:underline bg-primary/5 hover:bg-primary/10 px-2.5 py-1.5 rounded-lg transition-colors">
                                                Invoice
                                            </a>

                                            @if($booking->status_pembayaran === 'Lunas')
                                                <!-- Review Button Trigger -->
                                                <button onclick="openReviewModal('{{ $booking->trip->id }}', '{{ $booking->trip->nama_gunung }}')" class="text-[10px] font-bold text-white bg-secondary hover:bg-secondary/90 px-2.5 py-1.5 rounded-lg shadow-sm btn-press">
                                                    Ulasan
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-8 text-center text-text-dark/50">
                                        Anda belum memiliki riwayat registrasi. <a href="{{ route('explore') }}" class="font-bold text-primary hover:underline">Cari trip pendakian sekarang!</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Side: Notifications & Wishlist -->
        <div class="space-y-6">
            
            <!-- Notifications List -->
            <div class="bg-white rounded-3xl border border-primary/10 p-6 space-y-4 shadow-sm reveal active">
                <h3 class="text-sm font-bold font-serif text-primary border-b border-primary/5 pb-2 flex items-center justify-between">
                    <span>Pemberitahuan Pendakian</span>
                    <span class="bg-rose-100 text-rose-600 text-[9px] font-bold px-2 py-0.5 rounded-full">2 Baru</span>
                </h3>
                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 bg-rose-50/50 rounded-2xl border border-rose-100/50 text-[10px] leading-relaxed">
                        <i data-lucide="bell" class="w-4 h-4 text-rose-500 shrink-0 mt-0.5"></i>
                        <div class="space-y-0.5">
                            <p class="font-bold text-text-dark">Selesaikan Pembayaran Trip Gunung</p>
                            <p class="text-text-dark/60">Batas waktu transfer invoice tersisa kurang dari 24 jam.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-primary/5 rounded-2xl border border-primary/5 text-[10px] leading-relaxed">
                        <i data-lucide="check-circle" class="w-4 h-4 text-primary shrink-0 mt-0.5"></i>
                        <div class="space-y-0.5">
                            <p class="font-bold text-text-dark">Akun Anda Telah Terverifikasi</p>
                            <p class="text-text-dark/60">Selamat datang! Profil Anda sekarang siap digunakan untuk registrasi SIMAKSI.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wishlist Section -->
            <div class="bg-white rounded-3xl border border-primary/10 p-6 space-y-4 shadow-sm reveal active">
                <h3 class="text-sm font-bold font-serif text-primary border-b border-primary/5 pb-2 flex items-center gap-1.5">
                    <i data-lucide="heart" class="w-4 h-4 text-rose-500 fill-rose-500"></i> Wishlist Gunung Impian
                </h3>
                <div class="space-y-3.5">
                    <!-- Favorite item 1 -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0">
                            <img src="https://images.unsplash.com/photo-1589308078059-be1415eab4c3?auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover" alt="Rinjani">
                        </div>
                        <div class="flex-grow space-y-0.5">
                            <h4 class="text-xs font-bold text-primary leading-tight">Gunung Rinjani</h4>
                            <span class="text-[9px] text-text-dark/50 block">Lombok, NTB</span>
                        </div>
                        <a href="{{ route('explore', ['search' => 'Rinjani']) }}" class="text-[9px] font-bold text-secondary hover:underline shrink-0">Cari Trip</a>
                    </div>
                    <!-- Favorite item 2 -->
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl overflow-hidden shrink-0">
                            <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=150&q=80" class="w-full h-full object-cover" alt="Semeru">
                        </div>
                        <div class="flex-grow space-y-0.5">
                            <h4 class="text-xs font-bold text-primary leading-tight">Gunung Semeru</h4>
                            <span class="text-[9px] text-text-dark/50 block">Lumajang, Jawa Timur</span>
                        </div>
                        <a href="{{ route('explore', ['search' => 'Semeru']) }}" class="text-[9px] font-bold text-secondary hover:underline shrink-0">Cari Trip</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<!-- Review Modal -->
<div id="review-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/40 backdrop-blur-sm hidden">
    <div class="bg-white rounded-3xl border border-primary/10 p-6 md:p-8 max-w-md w-full mx-6 space-y-6 shadow-xl relative">
        <button onclick="closeReviewModal()" class="absolute top-4 right-4 text-text-dark/50 hover:text-red-500">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>
 
        <div class="space-y-1">
            <h3 class="text-xl font-bold font-serif text-primary">Tulis Ulasan Perjalanan</h3>
            <p id="modal-trip-name" class="text-xs text-secondary font-bold"></p>
        </div>

        <form id="review-form" action="" method="POST" class="space-y-4">
            @csrf
            
            <div class="flex flex-col space-y-2">
                <label class="text-xs font-bold text-primary">Rating Anda</label>
                <div class="flex gap-2 text-yellow-500">
                    <input type="hidden" name="rating" id="rating-input" value="5">
                    @for($i=1; $i<=5; $i++)
                        <button type="button" onclick="setRating('{{ $i }}')" class="hover:scale-110 transition-transform">
                            <i data-rating-star="{{ $i }}" data-lucide="star" class="w-8 h-8 fill-current"></i>
                        </button>
                    @endfor
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="komentar" class="text-xs font-bold text-primary">Komentar / Pengalaman</label>
                <textarea id="komentar" name="komentar" rows="4" required placeholder="Tulis masukan tentang guide, porter, konsumsi, atau track..." class="px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-xs outline-none focus:ring-1 focus:ring-primary"></textarea>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md text-sm btn-press">
                Kirim Ulasan
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // 1. Booking table client filter logic
    function filterBookings(status, button) {
        document.querySelectorAll('.booking-row').forEach(row => {
            if (status === 'all' || row.getAttribute('data-status') === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        document.querySelectorAll('.booking-tab').forEach(tab => {
            tab.className = "booking-tab text-xs font-bold text-text-dark/50 hover:text-primary pb-2 focus:outline-none";
        });
        button.className = "booking-tab text-xs font-bold text-primary border-b-2 border-primary pb-2 focus:outline-none";
    }

    // 2. Review modal controls
    function openReviewModal(tripId, tripName) {
        document.getElementById('modal-trip-name').innerText = tripName;
        document.getElementById('review-form').action = `/reviews/${tripId}`;
        document.getElementById('review-modal').classList.remove('hidden');
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
                star.classList.add('text-yellow-500', 'fill-current');
                star.classList.remove('text-slate-300');
            } else {
                star.classList.remove('text-yellow-500', 'fill-current');
                star.classList.add('text-slate-300');
            }
        }
    }
</script>
@endsection
