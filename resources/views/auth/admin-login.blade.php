@extends('layouts.layout')

@section('title', 'Login Operator | Puncak & Bara')

@section('content')
<section class="max-w-md mx-auto px-6 py-12">
    <div class="glass-card rounded-[2rem] p-8 shadow-xl space-y-6 reveal active border border-white/60">
        <div class="text-center space-y-2">
            <h1 class="text-2xl md:text-3xl font-bold font-serif text-primary">Dashboard Operator</h1>
            <p class="text-xs text-text-dark/50">Masuk sebagai administrator untuk mengelola trip, booking, dan verifikasi.</p>
        </div>

        <!-- Session Warning Notice -->
        <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-2xl text-[10px] leading-relaxed flex items-start gap-2.5">
            <i data-lucide="shield-alert" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5 animate-pulse"></i>
            <div>
                <span class="font-bold">Security Notice:</span> Sesi administrator dipantau. Pastikan Anda masuk menggunakan perangkat pribadi dan koneksi aman (HTTPS). Sesi tidak aktif otomatis ditutup dalam 15 menit.
            </div>
        </div>

        @if($errors->any())
            <div class="bg-rose-50 text-rose-600 p-4 rounded-2xl text-xs font-semibold border border-rose-200">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-4">
            @csrf
            
            <div class="flex flex-col space-y-1">
                <label for="email" class="text-xs font-bold text-primary">Email Administrator</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light">
                    <i data-lucide="shield" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="admin@opentrip.com" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="password" class="text-xs font-bold text-primary">Kata Sandi</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light">
                    <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <!-- Simulated 2FA Toggle -->
            <div class="space-y-3 pt-2 border-t border-primary/5">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-primary">Verifikasi 2-Faktor (Simulasi)</span>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="two_factor_toggle" onchange="toggle2FA(this.checked)" class="sr-only peer">
                        <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                
                <!-- Hidden TOTP input field -->
                <div id="totp-field" class="hidden flex flex-col space-y-1 transition-all duration-300">
                    <label for="totp" class="text-[10px] font-bold text-primary">Kode Authenticator (TOTP)</label>
                    <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light">
                        <i data-lucide="key-round" class="w-4 h-4 text-text-dark/40"></i>
                        <input type="text" id="totp" placeholder="123 456" class="bg-transparent border-0 outline-none text-sm w-full font-mono tracking-widest text-center" maxlength="6">
                    </div>
                    <span class="text-[9px] text-text-dark/40">Masukkan kode simulasi bebas (contoh: 123456) jika diaktifkan.</span>
                </div>
            </div>

            <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-md shadow-primary/10 text-xs btn-press">
                Masuk Operator
            </button>
        </form>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function toggle2FA(isChecked) {
        const totpField = document.getElementById('totp-field');
        const totpInput = document.getElementById('totp');
        if (isChecked) {
            totpField.classList.remove('hidden');
            totpInput.required = true;
        } else {
            totpField.classList.add('hidden');
            totpInput.required = false;
            totpInput.value = '';
        }
    }
</script>
@endsection
