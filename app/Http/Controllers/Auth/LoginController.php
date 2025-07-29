<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class LoginController extends Controller
{
    public function loginpage()
    {
        return view('auth.login');
    }
    public function registerpage()
    {
        return view('auth.register');
    }
    public function loginmethod(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->role == 'ADMIN'){
                return redirect()->route('admin.dashboard');
            }else{
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        } else {
            return redirect('/login')->withErrors(['error' => 'Akun atau Password salah']);
        }
    }

    public function registermethod(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|string|min:8',
        ]);

        if ($request->password != $request->confirm_password) {
            return back()->withErrors(['password' => 'Pastikan password dan confirm password sama']);
        }
        $user = User::create([
            'name' => $request->username,
            'telp' => "123023",
            'email' => $request->email,
            'role' => 'USR-P',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    public function logoutmethod(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    //lupa password
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Link reset password berhasil dikirim ke email Anda!');
        } else {
            return back()->withErrors(['email' => 'Gagal mengirim link reset password, silakan coba lagi.']);
        }
    }
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', 'Password berhasil direset!')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
