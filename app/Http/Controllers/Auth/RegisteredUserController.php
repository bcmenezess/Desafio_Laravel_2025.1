<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'cpf' => 'required|string|size:11|unique:users,cpf',
            'address' => 'required|string|max:255',
            'date_birth' => 'required|date|before:today',
            'telephone' => 'required|string|min:6|max:15',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profiles', 'public');
        } else {
            $imagePath = null;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'address' => $request->address,
            'date_birth' => $request->date_birth,
            'telephone' => $request->telephone,
            'photo' => $imagePath,
            'password' => Hash::make($request->password),
            'balance' => 0
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('landing-page', absolute: false));
    }
}
