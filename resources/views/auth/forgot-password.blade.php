@extends('layouts.layout')

@section('title', 'Lupa Kata Sandi | Puncak & Bara')

@section('content')
<section class="max-w-md mx-auto px-6 py-12">
    <div class="glass-card rounded-3xl p-8 shadow-md space-y-6 reveal active border border-white/40 @if($errors->any()) animate-shake @endif">
        
        <!-- Progress Indicator -->
        <div class="space-y-4">
            <div class="flex items-center justify-between text-xs font-bold text-text-dark/40 uppercase tracking-widest">
                <span class="{{ $step >= 1 ? 'text-primary' : '' }}">Email</span>
                <span class="{{ $step >= 2 ? 'text-primary' : '' }}">Verifikasi</span>
                <span class="{{ $step >= 3 ? 'text-primary' : '' }}">Sandi Baru</span>
            </div>
            <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden flex">
                <div class="h-full bg-primary transition-all duration-500 {{ $step == 1 ? 'w-1/3' : ($step == 2 ? 'w-2/3' : 'w-full') }}"></div>
            </div>
        </div>

        @if($errors->any())
            <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-semibold border border-red-200">
                <ul class="list-disc pl-4 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($step == 1)
            <!-- Step 1: Input Email -->
            <div class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl md:text-2xl font-bold font-serif text-primary">Lupa Kata Sandi?</h2>
                    <p class="text-xs text-text-dark/50">Masukkan alamat email Anda untuk menerima kode OTP verifikasi.</p>
                </div>

                <form action="{{ route('password.email') }}" method="POST" class="space-y-4" onsubmit="onSubmitStep1(event)">
                    @csrf
                    <div class="flex flex-col space-y-1">
                        <label for="email" class="text-xs font-bold text-primary">Alamat Email</label>
                        <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                            <i data-lucide="mail" class="w-4 h-4 text-text-dark/40"></i>
                            <input type="email" id="email" name="email" required placeholder="budi@email.com" value="{{ session('forgot_password_email') }}" class="bg-transparent border-0 outline-none text-sm w-full">
                        </div>
                    </div>

                    <button type="submit" id="btn-submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md text-sm btn-press flex items-center justify-center gap-2">
                        <span id="btn-text">Kirim OTP</span>
                        <svg id="btn-spinner" class="animate-spin h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </form>
            </div>

        @elseif($step == 2)
            <!-- Step 2: Verification OTP -->
            <div class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl md:text-2xl font-bold font-serif text-primary">Verifikasi OTP</h2>
                    <p class="text-xs text-text-dark/50">Masukkan 6 digit kode keamanan yang telah dikirim ke email Anda.</p>
                </div>

                <form action="{{ route('password.otp.post') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="flex justify-between gap-2" id="otp-container">
                        @for($i = 0; $i < 6; $i++)
                            <input type="text" name="otp[]" maxlength="1" required class="w-12 h-12 text-center text-lg font-bold rounded-xl border border-primary/20 bg-bg-light focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all" oninput="moveToNext(this, {{ $i }})" onkeydown="handleBackspace(event, {{ $i }})">
                        @endfor
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md text-sm btn-press">
                        Verifikasi Kode
                    </button>
                </form>

                <div class="text-center text-xs text-text-dark/50 pt-2">
                    <span id="cooldown-text">Kirim ulang OTP dalam <strong id="timer">60</strong> detik</span>
                    <form action="{{ route('password.email') }}" method="POST" id="resend-form" class="hidden">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('forgot_password_email') }}">
                        Belum menerima kode? <button type="submit" class="font-bold text-secondary hover:underline">Kirim Ulang</button>
                    </form>
                </div>
            </div>

        @elseif($step == 3)
            <!-- Step 3: New Password -->
            <div class="space-y-4">
                <div class="space-y-1">
                    <h2 class="text-xl md:text-2xl font-bold font-serif text-primary">Sandi Baru</h2>
                    <p class="text-xs text-text-dark/50">Masukkan kata sandi baru Anda yang aman dan kuat.</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="flex flex-col space-y-1">
                        <label for="password" class="text-xs font-bold text-primary">Kata Sandi Baru</label>
                        <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                            <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                            <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" oninput="checkStrength(this.value)" class="bg-transparent border-0 outline-none text-sm w-full">
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-1.5 hidden" id="strength-container">
                            <div class="h-full w-0 transition-all duration-300" id="strength-bar"></div>
                        </div>
                        <span class="text-[10px] font-bold hidden" id="strength-text"></span>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <label for="password_confirmation" class="text-xs font-bold text-primary">Konfirmasi Kata Sandi Baru</label>
                        <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                            <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ketik ulang kata sandi" class="bg-transparent border-0 outline-none text-sm w-full">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md text-sm btn-press">
                        Simpan Kata Sandi
                    </button>
                </form>
            </div>
        @endif

        <div class="text-center text-xs text-text-dark/50 pt-2 border-t border-primary/5">
            Kembali ke <a href="{{ route('login') }}" class="font-bold text-secondary hover:underline">Halaman Masuk</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Step 1 helper
    function onSubmitStep1(e) {
        document.getElementById('btn-text').innerText = 'Mengirim...';
        document.getElementById('btn-spinner').classList.remove('hidden');
        document.getElementById('btn-submit').disabled = true;
    }

    // Step 2 helper (OTP movement)
    function moveToNext(input, index) {
        if (input.value.length === 1 && index < 5) {
            const inputs = document.getElementsByName('otp[]');
            inputs[index + 1].focus();
        }
    }

    function handleBackspace(e, index) {
        if (e.key === "Backspace" && e.target.value.length === 0 && index > 0) {
            const inputs = document.getElementsByName('otp[]');
            inputs[index - 1].focus();
        }
    }

    // Timer countdown for resending OTP
    if (document.getElementById('timer')) {
        let seconds = 60;
        const interval = setInterval(() => {
            seconds--;
            document.getElementById('timer').innerText = seconds;
            if (seconds <= 0) {
                clearInterval(interval);
                document.getElementById('cooldown-text').classList.add('hidden');
                document.getElementById('resend-form').classList.remove('hidden');
            }
        }, 1000);
    }

    // Step 3 helper (strength check)
    function checkStrength(password) {
        const container = document.getElementById('strength-container');
        const bar = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');

        if (!password) {
            container.classList.add('hidden');
            text.classList.add('hidden');
            return;
        }

        container.classList.remove('hidden');
        text.classList.remove('hidden');

        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        if (score <= 1) {
            bar.className = "h-full bg-rose-500 w-1/3";
            text.className = "text-[10px] font-bold text-rose-500";
            text.innerText = "Lemah";
        } else if (score === 2 || score === 3) {
            bar.className = "h-full bg-amber-500 w-2/3";
            text.className = "text-[10px] font-bold text-amber-500";
            text.innerText = "Sedang";
        } else {
            bar.className = "h-full bg-emerald-500 w-full";
            text.className = "text-[10px] font-bold text-emerald-500";
            text.innerText = "Sangat Kuat";
        }
    }

    // Focus first OTP field on load
    window.addEventListener('DOMContentLoaded', () => {
        const inputs = document.getElementsByName('otp[]');
        if (inputs.length > 0) {
            inputs[0].focus();
        }
    });
</script>
@endsection
