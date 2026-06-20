@extends('layouts.layout')

@section('title', 'Verifikasi Email | Puncak & Bara')

@section('content')
<section class="max-w-md mx-auto px-6 py-12">
    <div class="glass-card rounded-3xl p-8 shadow-md space-y-6 reveal active border border-white/40 text-center">
        
        <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto animate-pulse">
            <i data-lucide="mail-warning" class="w-8 h-8"></i>
        </div>

        <div class="space-y-2">
            <h1 class="text-2xl font-bold font-serif text-primary">Verifikasi Email Anda</h1>
            <p class="text-xs text-text-dark/60 leading-relaxed">
                Tautan verifikasi telah dikirim ke alamat email:<br>
                <strong class="text-primary font-mono text-sm">{{ Auth::user()->email }}</strong>
            </p>
            <p class="text-[11px] text-text-dark/40">
                Silakan periksa kotak masuk (atau folder spam) untuk menyelesaikan proses pendaftaran.
            </p>
        </div>

        <div class="space-y-3 pt-2">
            <!-- Simulated verification trigger for MVP local testing -->
            <a href="{{ route('verification.verify', Auth::user()->id) }}" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md text-sm btn-press flex items-center justify-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                <span>Simulasikan Klik Link di Email</span>
            </a>

            <!-- Resend Form -->
            <form action="{{ route('verification.send') }}" method="POST" id="resend-form">
                @csrf
                <button type="submit" id="btn-resend" class="w-full bg-bg-alt hover:bg-primary/5 text-text-dark font-bold py-2.5 px-6 rounded-xl border border-primary/10 transition-all text-xs btn-press">
                    Kirim Ulang Email Verifikasi (<span id="cooldown-timer">60</span>s)
                </button>
            </form>
        </div>

        <div class="text-center text-xs text-text-dark/50 pt-2 border-t border-primary/5">
            Salah email? <a href="{{ route('logout') }}" class="font-bold text-secondary hover:underline">Keluar & Daftar Ulang</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const btnResend = document.getElementById('btn-resend');
        const timerSpan = document.getElementById('cooldown-timer');
        let seconds = 60;
        btnResend.disabled = true;

        const interval = setInterval(() => {
            seconds--;
            timerSpan.innerText = seconds;
            if (seconds <= 0) {
                clearInterval(interval);
                btnResend.innerHTML = '<i data-lucide="send" class="w-3.5 h-3.5 inline mr-1"></i> Kirim Ulang Sekarang';
                btnResend.disabled = false;
                lucide.createIcons();
            }
        }, 1000);
    });
</script>
@endsection
