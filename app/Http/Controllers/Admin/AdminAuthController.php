<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $adminEmail = config('admin.email');
        $adminPassword = config('admin.password'); // plain for simplicity

        if ($data['email'] === $adminEmail && $data['password'] === $adminPassword) {
            $request->session()->put('admin_logged_in', true);
            $request->session()->regenerate();

            return redirect()->route('admin.products.index')->with('ok', 'Welcome Admin!');
        }

        return back()->withErrors(['email' => 'Invalid admin credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('ok', 'Logged out');
    }
}
