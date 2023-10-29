<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()-> regenerateToken();
        return redirect()->route('login');

    }

    public function show()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        //validate
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
        ]);
        //authenticate if we need role base work we can do inside if block
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');


        }
        return redirect()
            ->back()
            ->withErrors([
                'email' => 'Your provided credentials do not match our record.',
            ])->onlyInput('email');

    }
}
