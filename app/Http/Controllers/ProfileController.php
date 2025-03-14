<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => usuarioLogado()
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if(isAdmin()){
            $user = Admin::find(usuarioLogado()->id);
        }
        else{
            $user = User::find(usuarioLogado()->id);
        }

        $validatedData = $request->validated();
        $validatedData['photo'] = $user->photo;


        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profiles', 'public');

            $validatedData['photo'] = $imagePath;
        }


        if ($request->email != $user->email) {
            $user->email_verified_at = null;
        }

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'telephone' => $validatedData['telephone'],
            'address' => $validatedData['address'],
            'CPF' => $validatedData['cpf'],
            'date_birth' => $validatedData['date_birth'],
            'photo' => $validatedData['photo']
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if(isAdmin()){
            $user = Admin::find(usuarioLogado()->id);
        }
        else{
            $user = User::find(usuarioLogado()->id);
        }

        if(!Hash::check($request->password, $user->password)){
            $request->validateWithBag('userDeletion', [
                'password' => false,
            ]);
        }

        if(isset($user->photo)){
            Storage::disk('public')->delete($user->photo);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
