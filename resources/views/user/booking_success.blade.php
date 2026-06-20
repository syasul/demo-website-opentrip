@extends('layouts.layout')

@section('title', 'Pemesanan Berhasil | Puncak & Bara')

@section('content')
<section class="max-w-xl mx-auto px-4 py-16 flex flex-col items-center justify-center min-h-[70vh]">
    <div class="glass-card rounded-[2.5rem] p-8 md:p-10 w-full shadow-2xl border border-white/60 text-center space-y-8 relative overflow-hidden reveal active">
        <!-- Confetti Canvas -->
        <canvas id="confetti-canvas" class="absolute inset-0 pointer-events-none w-full h-full z-0"></canvas>

        <div class="relative z-10 space-y-6">
            <!-- Animated Green Tick Icon -->
            <div class="w-20 h-20 bg-green-50 text-green-600 rounded-full flex items-center justify-center mx-auto shadow-md border border-green-100 scale-100 animate-bounce">
                <i data-lucide="check-circle" class="w-10 h-10"></i>
            </div>

            <div class="space-y-2">
                <h1 class="text-2xl md:text-3xl font-serif font-bold text-primary">Registrasi Berhasil!</h1>
                <p class="text-xs text-text-dark/60 leading-relaxed">
                    Pesanan Anda untuk Open Trip <span class="font-bold text-primary">{{ $booking->trip->nama_gunung }}</span> telah berhasil dibuat dan kursi Anda telah kami kunci.
                </p>
            </div>

            <!-- Booking details summary card -->
            <div class="bg-bg-alt/60 border border-primary/5 rounded-2xl p-5 text-left text-xs space-y-3.5">
                <div class="flex justify-between items-center pb-2 border-b border-primary/5">
                    <span class="text-text-dark/50">ID Booking</span>
                    <span class="font-bold text-primary font-mono">#{{ $booking->id }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-primary/5">
                    <span class="text-text-dark/50">Jadwal Keberangkatan</span>
                    <span class="font-bold text-text-dark">{{ $booking->trip->tanggal_berangkat->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between items-center pb-2 border-b border-primary/5">
                    <span class="text-text-dark/50">Jumlah Peserta</span>
                    <span class="font-bold text-text-dark">{{ $booking->jumlah_peserta }} Orang</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-text-dark/50">Total Tagihan</span>
                    <span class="text-sm font-bold text-secondary">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 pt-4">
                <a href="{{ route('user.invoice', $booking->id) }}" class="flex-1 bg-primary hover:bg-primary-light text-white font-bold py-3.5 px-6 rounded-2xl transition-all shadow-md shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] text-xs flex items-center justify-center gap-1.5 btn-press">
                    Lanjutkan ke Pembayaran <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="{{ route('user.dashboard') }}" class="flex-1 bg-white hover:bg-primary/5 text-primary border border-primary/10 font-bold py-3.5 px-6 rounded-2xl transition-all text-xs flex items-center justify-center gap-1.5 btn-press">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Ke Dashboard
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Trigger confetti explosion on load
        confetti({
            particleCount: 150,
            spread: 80,
            origin: { y: 0.6 },
            colors: ['#0C2340', '#1D4ED8', '#F59E0B', '#10B981']
        });
    });
</script>
@endsection
