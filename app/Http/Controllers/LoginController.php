<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{
    

    public function login(): View {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse {
        
        $credentials = $request->validate([
            'email' => 'required|string|email|max:100',
            'password' => 'required|string',
        ]);


        if(Auth::attempt($credentials)) {

                $request->session()->regenerate();

                return redirect()->intended(route('home'))->with('success', 'Вы успешно зашли в кабинет!');
        }

        return back()->withErrors([
            'email' => 'Данные не совпадают'
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse {

            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/');
        }

}
