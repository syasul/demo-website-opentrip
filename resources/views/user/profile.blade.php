@extends('layouts.user')

@section('user-content')
<div class="space-y-6">
    <div class="space-y-2 border-b border-primary/5 pb-4">
        <h1 class="text-2xl font-bold font-serif text-primary">Kelola Profil Anda</h1>
        <p class="text-xs text-text-dark/50">Perbarui informasi dasar profil, foto identitas wajah, dan kontak darurat Anda.</p>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-4 rounded-2xl text-xs font-semibold border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-4 rounded-2xl text-xs font-semibold border border-red-200">
            <ul class="list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex flex-col space-y-1">
                <label for="name" class="text-xs font-bold text-primary">Nama Lengkap</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm">
                    <i data-lucide="user" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required class="bg-transparent border-0 outline-none w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="email" class="text-xs font-bold text-primary">Alamat Email (Tidak Dapat Diganti)</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm opacity-60">
                    <i data-lucide="mail" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="email" id="email" value="{{ $user->email }}" disabled class="bg-transparent border-0 outline-none w-full cursor-not-allowed">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="no_hp" class="text-xs font-bold text-primary">Nomor WhatsApp</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm">
                    <i data-lucide="phone" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required class="bg-transparent border-0 outline-none w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="kontak_darurat" class="text-xs font-bold text-primary">Kontak Darurat Kerabat (Nama & No HP)</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm">
                    <i data-lucide="phone-call" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="text" id="kontak_darurat" name="kontak_darurat" value="{{ old('kontak_darurat', $user->kontak_darurat) }}" placeholder="Contoh: 081299998888 (Istri)" class="bg-transparent border-0 outline-none w-full">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-primary/5">
            <div class="flex flex-col space-y-2">
                <label for="foto_profil" class="text-xs font-bold text-primary">Unggah Foto Profil (Ukuran Max 1MB)</label>
                <div class="flex items-center gap-4">
                    <div class="relative group w-16 h-16 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-md overflow-hidden shrink-0 border border-primary/10">
                        @if($user->foto_profil)
                            <img id="avatar-preview-img" src="{{ $user->foto_profil }}" class="w-full h-full object-cover" alt="Profile">
                        @else
                            <div id="avatar-initial" class="w-full h-full flex items-center justify-center bg-primary text-white text-lg font-serif">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <img id="avatar-preview-img" src="" class="w-full h-full object-cover hidden" alt="Profile">
                        @endif
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white transition-opacity cursor-pointer" onclick="document.getElementById('foto_profil').click()">
                            <i data-lucide="camera" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <input type="file" id="foto_profil" name="foto_profil" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                    <button type="button" onclick="document.getElementById('foto_profil').click()" class="bg-bg-light hover:bg-primary/5 text-primary border border-primary/10 px-4 py-2.5 rounded-xl text-xs font-bold transition-all">
                        Pilih Foto
                    </button>
                </div>
            </div>
        </div>

        <div class="space-y-4 pt-6 border-t border-primary/5">
            <h3 class="text-sm font-bold text-primary">Ganti Kata Sandi (Kosongkan jika tidak diganti)</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col space-y-1">
                    <label for="password" class="text-xs font-bold text-primary">Kata Sandi Baru</label>
                    <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm">
                        <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" class="bg-transparent border-0 outline-none w-full" oninput="checkPasswordStrength(this.value)">
                    </div>
                    
                    <!-- Password Strength Meter -->
                    <div id="password-strength-wrapper" class="hidden space-y-1.5 pt-1.5">
                        <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden flex gap-0.5">
                            <div id="strength-bar-1" class="h-full w-1/3 transition-colors bg-slate-200"></div>
                            <div id="strength-bar-2" class="h-full w-1/3 transition-colors bg-slate-200"></div>
                            <div id="strength-bar-3" class="h-full w-1/3 transition-colors bg-slate-200"></div>
                        </div>
                        <span id="strength-text" class="text-[10px] font-bold text-text-dark/50"></span>
                    </div>
                </div>

                <div class="flex flex-col space-y-1">
                    <label for="password_confirmation" class="text-xs font-bold text-primary">Konfirmasi Kata Sandi Baru</label>
                    <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light text-sm">
                        <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang kata sandi baru" class="bg-transparent border-0 outline-none w-full">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="bg-primary hover:bg-primary-light text-white font-bold text-xs px-6 py-3 rounded-xl transition-all shadow-md btn-press">
            Simpan Perubahan
        </button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    // 1. Instant avatar preview logic
    function previewAvatar(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('avatar-preview-img');
                const initial = document.getElementById('avatar-initial');
                
                img.src = e.target.result;
                img.classList.remove('hidden');
                
                if (initial) {
                    initial.classList.add('hidden');
                }
            }
            reader.readAsDataURL(file);
        }
    }

    // 2. Dynamic password strength indicator logic
    function checkPasswordStrength(password) {
        const wrapper = document.getElementById('password-strength-wrapper');
        const bar1 = document.getElementById('strength-bar-1');
        const bar2 = document.getElementById('strength-bar-2');
        const bar3 = document.getElementById('strength-bar-3');
        const text = document.getElementById('strength-text');

        if (!password) {
            wrapper.classList.add('hidden');
            return;
        }

        wrapper.classList.remove('hidden');
        let score = 0;

        // Criteria 1: length
        if (password.length >= 8) score++;
        // Criteria 2: letters + numbers
        if (/[a-zA-Z]/.test(password) && /[0-9]/.test(password)) score++;
        // Criteria 3: special characters
        if (/[^a-zA-Z0-9]/.test(password)) score++;

        // Reset classes
        bar1.className = "h-full w-1/3 transition-colors bg-slate-200";
        bar2.className = "h-full w-1/3 transition-colors bg-slate-200";
        bar3.className = "h-full w-1/3 transition-colors bg-slate-200";

        if (score === 1) {
            bar1.className = "h-full w-1/3 transition-colors bg-rose-500";
            text.innerText = "Kekuatan: Lemah (Gunakan kombinasi angka & simbol)";
            text.className = "text-[10px] font-bold text-rose-500";
        } else if (score === 2) {
            bar1.className = "h-full w-1/3 transition-colors bg-amber-500";
            bar2.className = "h-full w-1/3 transition-colors bg-amber-500";
            text.innerText = "Kekuatan: Sedang (Tambahkan karakter spesial/simbol)";
            text.className = "text-[10px] font-bold text-amber-500";
        } else if (score === 3) {
            bar1.className = "h-full w-1/3 transition-colors bg-green-600";
            bar2.className = "h-full w-1/3 transition-colors bg-green-600";
            bar3.className = "h-full w-1/3 transition-colors bg-green-600";
            text.innerText = "Kekuatan: Sangat Kuat";
            text.className = "text-[10px] font-bold text-green-600";
        }
    }
</script>
@endsection
