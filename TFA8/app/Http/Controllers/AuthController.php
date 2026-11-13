<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('user_id')) {
            return redirect()->route('customers.index');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if ($user && $user->password && password_verify($credentials['password'],$user->password)) {
            $request->session()->regenerate();

            $request->session()->put([
                'user_id' => $user->id,
                'username' => $user->username,
                'full_name' => $user->full_name
            ]);

            return redirect()
                ->intended(route('customers.index'))
                ->with('success', 'Welcome! You are now logged in.');
        }

        return back()
            ->withErrors(['username' => 'Invalid username or password.'])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have successfully logged out.');
    }
}
