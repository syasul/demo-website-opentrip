<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function showRegisterForm()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no_hp' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'no_hp' => $validated['no_hp'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::guard('web')->login($user);

        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    // --- LUPA PASSWORD OTP FLOW ---
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password', ['step' => 1]);
    }

    public function sendOtpCode(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Alamat email tidak terdaftar.']);
        }

        // Simulate OTP sending
        $otp = '123456';
        $request->session()->put('forgot_password_email', $request->email);
        $request->session()->put('forgot_password_otp', $otp);
        $request->session()->put('forgot_password_otp_expires', now()->addMinutes(10));

        return redirect()->route('password.otp.verify')->with('success', 'Kode OTP 123456 telah dikirim ke email Anda.');
    }

    public function showVerifyOtpForm(Request $request)
    {
        if (!$request->session()->has('forgot_password_email')) {
            return redirect()->route('password.request');
        }
        return view('auth.forgot-password', ['step' => 2]);
    }

    public function verifyOtpCode(Request $request)
    {
        $request->validate(['otp' => 'required|array']);
        
        // Combine OTP digits
        $otpCode = implode('', $request->otp);

        if ($otpCode !== $request->session()->get('forgot_password_otp')) {
            return back()->withErrors(['otp' => 'Kode OTP salah atau kedaluwarsa.']);
        }

        $request->session()->put('forgot_password_verified', true);
        return redirect()->route('password.reset')->with('success', 'OTP Terverifikasi. Silakan masukkan kata sandi baru.');
    }

    public function showResetPasswordForm(Request $request)
    {
        if (!$request->session()->get('forgot_password_verified')) {
            return redirect()->route('password.request');
        }
        return view('auth.forgot-password', ['step' => 3]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = $request->session()->get('forgot_password_email');
        $user = User::where('email', $email)->first();
        
        if ($user) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        // Clear session
        $request->session()->forget(['forgot_password_email', 'forgot_password_otp', 'forgot_password_otp_expires', 'forgot_password_verified']);

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diatur ulang. Silakan masuk.');
    }

    // --- EMAIL VERIFICATION FLOW ---
    public function showEmailVerificationNotice()
    {
        if (!Auth::guard('web')->check()) {
            return redirect()->route('login');
        }
        
        if (Auth::guard('web')->user()->email_verified_at) {
            return redirect()->route('user.dashboard');
        }

        return view('auth.verify-email');
    }

    public function verifyEmail($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'email_verified_at' => now(),
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Email Anda berhasil diverifikasi!');
    }

    public function resendEmailVerificationNotice()
    {
        return back()->with('success', 'Tautan verifikasi baru telah dikirim ke alamat email Anda.');
    }

    public function showAdminLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial admin tidak valid.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        } else if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
