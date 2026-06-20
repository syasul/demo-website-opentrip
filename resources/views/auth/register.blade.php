@extends('layouts.layout')

@section('title', 'Daftar Akun Pendaki | Puncak & Bara')

@section('content')
<section class="min-h-screen flex items-stretch">
    <!-- Image Side (Cinematic) -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-950">
        <img src="https://images.unsplash.com/photo-1574621100236-d25b64cfd6ba?auto=format&fit=crop&w=1200" 
             class="absolute inset-0 w-full h-full object-cover opacity-80 scale-105 animate-fade-in transition-transform duration-[10000ms]" 
             alt="Mountain Registration Background">
        <div class="absolute inset-0 bg-gradient-to-r from-slate-950 via-slate-950/20 to-transparent"></div>
        
        <div class="relative z-10 w-full flex flex-col justify-end p-20 space-y-6">
            <span class="text-xs font-black text-secondary uppercase tracking-[0.3em] reveal active">Next Generation Explorer</span>
            <h2 class="text-6xl font-black font-serif text-white leading-tight reveal active" style="transition-delay: 200ms;">
                Tulis Cerita <br>Baru Anda di <span class="text-secondary opacity-50 italic">Puncak.</span>
            </h2>
            <p class="text-white/40 max-w-md text-base leading-loose font-medium reveal active" style="transition-delay: 400ms;">
                Bergabunglah dengan komunitas pendaki eksklusif kami. Dapatkan akses prioritas ke jalur-jalur legendaris dan layanan pendampingan profesional.
            </p>
        </div>
    </div>

    <!-- Form Side -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 md:p-16 bg-bg-alt relative">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-[120px] pointer-events-none"></div>
        
        <div class="w-full max-w-md space-y-12 relative z-10 reveal active">
            <div class="space-y-4">
                <a href="/" class="inline-block mb-6">
                    <span class="text-2xl font-black font-serif text-primary lowercase tracking-tighter">puncak<span class="text-secondary">&</span>bara</span>
                </a>
                <h1 class="text-4xl font-black font-serif text-primary">Registrasi Pendaki</h1>
                <p class="text-xs text-text-dark/40 font-black uppercase tracking-[0.2em]">Inisiasi perjalanan Anda hari ini.</p>
            </div>

            @if($errors->any())
                <div class="bg-rose-50 border border-rose-100 p-6 rounded-[2rem] animate-shake">
                    <ul class="space-y-2">
                        @foreach($errors->all() as $error)
                            <li class="text-[10px] font-black text-rose-600 uppercase tracking-widest flex items-center gap-2">
                                <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-6" id="register-form" onsubmit="onSubmitRegister(event)">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label for="name" class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block group-focus-within:text-primary transition-colors">Nama Lengkap</label>
                        <div class="flex items-center gap-4 px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner focus-within:ring-2 focus-within:ring-primary/5 transition-all">
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="BUDI SANTOSO" class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                        </div>
                    </div>

                    <div class="group">
                        <label for="no_hp" class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block group-focus-within:text-primary transition-colors">WhatsApp</label>
                        <div class="flex items-center gap-4 px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner focus-within:ring-2 focus-within:ring-primary/5 transition-all">
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required placeholder="0812..." class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                        </div>
                    </div>
                </div>

                <div class="group">
                    <label for="email" class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block group-focus-within:text-primary transition-colors">Alamat Email</label>
                    <div class="flex items-center gap-4 px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner focus-within:ring-2 focus-within:ring-primary/5 transition-all">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="EXPLORER@PUNCAKBARA.COM" class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="group">
                        <label for="password" class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block group-focus-within:text-primary transition-colors">Password</label>
                        <div class="flex items-center gap-4 px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner focus-within:ring-2 focus-within:ring-primary/5 transition-all">
                            <input type="password" id="password" name="password" required placeholder="••••••••" oninput="checkPasswordStrength(this.value)" class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                        </div>
                    </div>

                    <div class="group">
                        <label for="password_confirmation" class="text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] ml-6 mb-3 block group-focus-within:text-primary transition-colors">Konfirmasi</label>
                        <div class="flex items-center gap-4 px-8 py-4 rounded-[2.5rem] border border-primary/5 bg-white shadow-inner focus-within:ring-2 focus-within:ring-primary/5 transition-all">
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="••••••••" class="bg-transparent border-0 outline-none text-[10px] font-black text-primary placeholder:text-primary/10 w-full uppercase tracking-[0.2em]">
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-start gap-4 px-4">
                        <input type="checkbox" id="terms" required class="w-5 h-5 rounded-full border-primary/10 text-primary focus:ring-primary/20 mt-1">
                        <label for="terms" class="text-[9px] font-black text-primary/40 leading-relaxed uppercase tracking-[0.2em] cursor-pointer">
                            Saya menerima <a href="#" class="text-secondary hover:underline">Syarat Layanan</a> dan menyetujui <a href="#" class="text-secondary hover:underline">Protokol Keselamatan</a> Puncak & Bara.
                        </label>
                    </div>
                </div>

                <button type="submit" id="btn-register" class="w-full bg-primary hover:bg-primary-light text-white font-black text-[10px] py-6 rounded-[2.5rem] shadow-2xl hover:scale-105 active:scale-95 transition-all uppercase tracking-[0.3em] flex items-center justify-center gap-4">
                    <span id="btn-register-text">Daftar Akun</span>
                    <i id="btn-register-spinner" data-lucide="loader-2" class="w-4 h-4 animate-spin hidden"></i>
                </button>
            </form>

            <div class="text-center text-[10px] font-black text-primary/30 uppercase tracking-[0.3em] pt-8 border-t border-primary/5">
                Sudah Bergabung? <a href="{{ route('login') }}" class="text-secondary hover:underline ml-2">Masuk Sekarang</a>
            </div>
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
                window.showToast('Syarat & Ketentuan wajib disetujui.', 'error');
            }
            return;
        }

        document.getElementById('btn-register-text').innerText = 'PROSES...';
        document.getElementById('btn-register-spinner').classList.remove('hidden');
        document.getElementById('btn-register').disabled = true;
    }
</script>
@endsection

