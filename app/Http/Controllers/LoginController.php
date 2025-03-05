<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('user_name', $request->username)->with('detail')->first();

        if (!$user) {
            return redirect()->back()->with('msg', 'User tidak ditemukan');
        }

        if (!$user->detail || !$user->detail->role) {
            return redirect()->back()->with('msg', 'Role tidak ditemukan');
        }

        if (Hash::check($request->password, $user->user_pass)) {
            Auth::login($user);

            switch ($user->detail->role) {
                case 1: return redirect()->route('admin.dashboard');
                case 2: return redirect()->route('opd.dashboard');
                case 3: return redirect()->route('pemohon.dashboard');
                default: return redirect()->route('auth.login')->with('msg', 'Role tidak valid');
            }
        }

        return redirect()->back()->with('msg', 'Username atau password salah');
    }
    
    

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');
    }

    private function redirectUser($role)
    {
        return match ($role) {
            1 => 'admin.dashboard',
            2 => 'opd.dashboard',
            3 => 'pemohon.dashboard',
            default => 'login',
        };
    }
}
