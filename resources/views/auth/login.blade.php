@extends('layouts.layout')

@section('title', 'Login Pendaki | Puncak & Bara')

@section('content')
<section class="min-h-screen flex items-stretch bg-white">
    <!-- Image Side -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-black overflow-hidden">
        <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?auto=format" 
             class="absolute inset-0 w-full h-full object-cover grayscale contrast-125 opacity-60">
        <div class="relative z-10 w-full flex flex-col justify-end p-20">
            <h2 class="text-7xl font-black uppercase text-white leading-none tracking-tighter reveal active">
                Ascend.<br>Properly.
            </h2>
        </div>
    </div>

    <!-- Form Side -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-12">
        <div class="w-full max-w-sm space-y-12 reveal active">
            <div class="space-y-4">
                <h1 class="text-4xl font-black uppercase tracking-tighter">Member Access</h1>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Basecamp Digital Entry</p>
            </div>

            @if($errors->any())
                <div class="border-l-4 border-black bg-gray-50 p-6">
                    <ul class="space-y-2">
                        @foreach($errors->all() as $error)
                            <li class="text-[10px] font-bold text-black uppercase tracking-widest">! {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-8" id="login-form">
                @csrf
                
                <div class="space-y-6">
                    <div class="space-y-2">
                        <label class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="EXPLORER@PUNCAKBARA.COM" class="w-full border-b-2 border-gray-100 py-4 text-sm font-bold uppercase tracking-widest outline-none focus:border-black transition-colors">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] uppercase font-bold text-gray-400 tracking-widest">Password</label>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full border-b-2 border-gray-100 py-4 text-sm font-bold uppercase tracking-widest outline-none focus:border-black transition-colors">
                    </div>
                </div>

                <div class="flex items-center justify-between px-4">
                    <label class="flex items-center gap-3 text-[9px] font-black text-primary/40 uppercase tracking-[0.2em] cursor-pointer hover:text-primary transition-colors">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded-full border-primary/10 text-primary focus:ring-primary/20">
                        <span>Ingat Saya</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[9px] font-black text-secondary hover:underline uppercase tracking-[0.2em]">Lupa Password?</a>
                </div>

                <div class="space-y-4">
                    <button type="submit" class="w-full bg-black text-white py-6 text-xs font-black uppercase tracking-[0.2em] hover:bg-accent transition-colors">Access Panel</button>
                    <a href="{{ route('register') }}" class="block w-full text-center border border-black py-6 text-xs font-black uppercase tracking-[0.2em] hover:bg-black hover:text-white transition-all">Create Account</a>
                </div>
            </form>
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
            window.showToast('Autentikasi Hub berhasil!', 'success');
        }
        setTimeout(() => {
            document.getElementById('email').value = 'user@opentrip.com';
            document.getElementById('password').value = 'password';
            document.getElementById('login-form').submit();
        }, 800);
    }
</script>
@endsection

