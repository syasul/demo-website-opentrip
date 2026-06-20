@extends('layouts.layout')

@section('title', 'Login Pendaki | Puncak & Bara')

@section('content')
<section class="max-w-md mx-auto px-6 py-12">
    <div class="glass-card rounded-3xl p-8 shadow-md space-y-6 reveal active border border-white/40 @if($errors->any()) animate-shake @endif">
        <div class="text-center space-y-2">
            <h1 class="text-2xl md:text-3xl font-bold font-serif text-primary">Selamat Datang Kembali</h1>
            <p class="text-xs text-text-dark/50">Masuk untuk melihat riwayat pendakian dan kelola trip Anda.</p>
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

        <form action="{{ route('login') }}" method="POST" class="space-y-4" id="login-form">
            @csrf
            
            <div class="flex flex-col space-y-1">
                <label for="email" class="text-xs font-bold text-primary">Alamat Email</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="mail" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@email.com" class="bg-transparent border-0 outline-none text-sm w-full">
                </div>
            </div>

            <div class="flex flex-col space-y-1">
                <label for="password" class="text-xs font-bold text-primary">Kata Sandi</label>
                <div class="flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-primary/10 bg-bg-light focus-within:ring-1 focus-within:ring-primary/20">
                    <i data-lucide="lock" class="w-4 h-4 text-text-dark/40"></i>
                    <input type="password" id="password" name="password" required placeholder="••••••••" class="bg-transparent border-0 outline-none text-sm w-full">
                    <button type="button" onclick="togglePassword()" class="text-text-dark/40 hover:text-primary transition-colors focus:outline-none">
                        <i id="password-toggle-icon" data-lucide="eye" class="w-4.5 h-4.5"></i>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between pt-2">
                <label class="flex items-center gap-2 text-xs text-text-dark/60 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-primary/10 text-primary focus:ring-primary">
                    <span>Ingat Saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-xs font-bold text-secondary hover:underline">Lupa Password?</a>
            </div>

            <button type="submit" id="btn-login" class="w-full bg-primary hover:bg-primary-light text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md shadow-primary/10 text-sm btn-press flex items-center justify-center gap-2">
                <span>Masuk Sekarang</span>
            </button>
        </form>

        <div class="relative flex py-2 items-center">
            <div class="flex-grow border-t border-primary/5"></div>
            <span class="flex-shrink mx-4 text-[10px] text-text-dark/40 font-bold uppercase tracking-widest">atau masuk dengan</span>
            <div class="flex-grow border-t border-primary/5"></div>
        </div>
        
        <button type="button" onclick="simulateGoogleLogin()" class="w-full bg-white hover:bg-bg-alt text-text-dark font-bold py-2.5 px-6 rounded-xl border border-primary/10 flex items-center justify-center gap-2 transition-all text-xs btn-press">
            <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M23.745 12.27c0-.7-.06-1.4-.19-2.07H12v3.92h6.69c-.29 1.5-.1.14-.1.14a5.7 5.7 0 0 1-2.49 3.76v3.12h4.02c2.35-2.17 3.71-5.36 3.71-8.87z"/>
                <path fill="#34A853" d="M12 24c3.24 0 5.97-1.08 7.96-2.91l-4.02-3.12c-1.12.75-2.55 1.2-3.94 1.2-3.04 0-5.62-2.06-6.54-4.83H1.31v3.23A11.99 11.99 0 0 0 12 24z"/>
                <path fill="#FBBC05" d="M5.46 14.34a7.16 7.16 0 0 1 0-2.68V8.43H1.31a11.99 11.99 0 0 0 0 7.14l4.15-3.23z"/>
                <path fill="#EA4335" d="M12 4.75c1.77 0 3.35.61 4.6 1.8l3.42-3.42A11.92 11.92 0 0 0 12 0 11.99 11.99 0 0 0 1.31 8.43l4.15 3.23c.92-2.77 3.5-4.83 6.54-4.83z"/>
            </svg>
            <span>Google Account</span>
        </button>

        <div class="text-center text-xs text-text-dark/50 pt-2 border-t border-primary/5">
            Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-secondary hover:underline">Daftar Pendaki</a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('password-toggle-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.setAttribute('data-lucide', 'eye-off');
        } else {
            passwordInput.type = 'password';
            toggleIcon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }

    function simulateGoogleLogin() {
        if (window.showToast) {
            window.showToast('Login dengan Google berhasil disimulasikan!', 'success');
        }
        setTimeout(() => {
            // Fill credentials and submit
            document.getElementById('email').value = 'user@opentrip.com';
            document.getElementById('password').value = 'password';
            document.getElementById('login-form').submit();
        }, 1200);
    }
</script>
@endsection

