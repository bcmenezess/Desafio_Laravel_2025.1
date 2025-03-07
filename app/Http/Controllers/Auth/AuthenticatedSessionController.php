<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        if(Auth::guard('admin')->check()){
            return to_route('dashboard');
        }
        if(Auth::guard('web')->check()){
            return to_route('landing-page');
        }
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        if(Auth::guard('web')->attempt($request->only(['email','password']))){
            return redirect()->route('landing-page');
        }

        else if(Auth::guard('admin')->attempt($request->only(['email','password']))){
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
        //$request->authenticate();

        //$request->session()->regenerate();

        //return redirect()->intended(route('dashboard', absolute: false));
        //return redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if(Auth::guard('web')->check()){
            Auth::guard('web')->logout();
        }
        else if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
