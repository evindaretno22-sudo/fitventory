<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Aktivitas;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            return redirect()->intended('/katalog');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'customer'; // dynamically assigned based on form
        $user->saveOrFail();

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/katalog');
    }

    public function redirectToProvider($provider)
    {
        return \Laravel\Socialite\Facades\Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = \Laravel\Socialite\Facades\Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Gagal login menggunakan ' . ucfirst($provider)]);
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            if (!$user->provider) {
                $user->provider = $provider;
                $user->provider_id = $socialUser->getId();
                $user->save();
            }
            Auth::login($user);
        } else {
            $user = new User();
            $user->name = $socialUser->getName() ?? $socialUser->getNickname() ?? 'User';
            $user->email = $socialUser->getEmail();
            $user->provider = $provider;
            $user->provider_id = $socialUser->getId();
            $user->role = 'pelanggan';
            $user->save();

            Auth::login($user);
        }

        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/katalog');
    }
}
