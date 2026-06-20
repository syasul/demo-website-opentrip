@extends('layouts.layout')

@section('title', 'Daftar Akun Pendaki | Puncak & Bara')

@section('content')
<section class="max-w-md mx-auto px-6 py-12">
    <div class="glass-card rounded-3xl p-8 shadow-md space-y-6 reveal active border border-white/40 @if($errors->any()) animate-shake @endif">
        <div class="text-center space-y-2">
            <h1 class="text-2xl md:text-3xl font-bold font-serif text-primary">Daftar Akun Pendaki</h1>
            <p class="text-xs text-text-dark/50">Mulai petualangan mendaki gunung dengan pendaftaran mudah.</p>
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

        <form action="{{ route('register') }}" method="POST" class="space-y-4" id="register-form" onsubmit="onSubmitRegister(event)">
            @csrf
            
            <div class="flex flex-col space-y-1 reveal active stagger-1">
                <label for="name" class="text-xs font-bold text-primary">Nama Lengkap</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="user" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Budi Santoso" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1 reveal active stagger-2">
                <label for="email" class="text-xs font-bold text-primary">Alamat Email</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="mail" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="budi@email.com" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1 reveal active stagger-3">
                <label for="no_hp" class="text-xs font-bold text-primary">Nomor WhatsApp</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="phone" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required placeholder="0812xxxxxxxx" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1 reveal active stagger-4">
                <label for="password" class="text-xs font-bold text-primary">Kata Sandi</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" oninput="checkPasswordStrength(this.value)" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
                <!-- Strength bar -->
                <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden mt-1.5 hidden" id="strength-bar-container">
                    <div class="h-full w-0 transition-all duration-300" id="strength-bar"></div>
                </div>
                <span class="text-[10px] font-bold hidden" id="strength-text"></span>
            </div>

            <div class="flex flex-col space-y-1 reveal active stagger-5">
                <label for="password_confirmation" class="text-xs font-bold text-primary">Konfirmasi Kata Sandi</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ketik ulang kata sandi" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex items-start gap-2 pt-1 reveal active stagger-5">
                <input type="checkbox" id="terms" required class="rounded border-primary/10 text-primary focus:ring-primary mt-0.5">
                <label for="terms" class="text-xs text-text-dark/60 cursor-pointer select-none">
                    Saya menyetujui <a href="#" onclick="event.preventDefault(); window.showToast('Syarat & Ketentuan berhasil ditampilkan!', 'info')" class="font-bold text-secondary hover:underline">Syarat & Ketentuan</a> serta Kebijakan Privasi.
                </label>
            </div>

            <button type="submit" id="btn-register" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md shadow-primary/10 text-sm btn-press flex items-center justify-center gap-2">
                <span id="btn-register-text">Daftar Sekarang</span>
                <svg id="btn-register-spinner" class="animate-spin h-4 w-4 text-white hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>

        <div class="text-center text-xs text-text-dark/50 pt-2 border-t border-primary/5">
            Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-secondary hover:underline">Masuk</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function checkPasswordStrength(password) {
        const barContainer = document.getElementById('strength-bar-container');
        const bar = document.getElementById('strength-bar');
        const text = document.getElementById('strength-text');

        if (!password) {
            barContainer.classList.add('hidden');
            text.classList.add('hidden');
            return;
        }

        barContainer.classList.remove('hidden');
        text.classList.remove('hidden');

        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        if (score <= 1) {
            bar.className = "h-full bg-rose-500 w-1/3";
            text.className = "text-[10px] font-bold text-rose-500";
            text.innerText = "Lemah (Gunakan kombinasi huruf, angka, & simbol)";
        } else if (score === 2 || score === 3) {
            bar.className = "h-full bg-amber-500 w-2/3";
            text.className = "text-[10px] font-bold text-amber-500";
            text.innerText = "Sedang (Tambahkan karakter spesial)";
        } else {
            bar.className = "h-full bg-emerald-500 w-full";
            text.className = "text-[10px] font-bold text-emerald-500";
            text.innerText = "Sangat Kuat";
        }
    }

    function onSubmitRegister(e) {
        const checkbox = document.getElementById('terms');
        if (!checkbox.checked) {
            e.preventDefault();
            if (window.showToast) {
                window.showToast('Anda harus menyetujui Syarat & Ketentuan!', 'error');
            }
            return;
        }

        document.getElementById('btn-register-text').innerText = 'Mendaftar...';
        document.getElementById('btn-register-spinner').classList.remove('hidden');
        document.getElementById('btn-register').disabled = true;
    }
</script>
@endsection

