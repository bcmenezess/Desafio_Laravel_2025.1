<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index(Request $request){
        if(isUser()){
            $users = usuarioLogado();
        }
        else {
            $users = User::paginate(6);
        }
        return view('admin.users-table',compact('users'));
    }

    public function create(){
        return view('admin.add-user');
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $logado = usuarioLogado();

        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('profiles', 'public');
        } else {
            $imagePath = null;
        }

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'address' => $validatedData['address'],
            'date_birth' => $validatedData['date_birth'],
            'telephone' => $validatedData['telephone'],
            'password' => Hash::make($validatedData['password']),
            'photo' => $imagePath,
            'admin_id' => $logado->id,
            'balance' => 0
        ]);

        if($user){
            return redirect()->route('users-table');
        }

        return redirect()->back();
    }

    public function editView($id){
        $user = User::findOrFail($id);
        return view('admin.edit-user',compact('user'));
    }

    public function edit(UpdateUserRequest $request, $id){
        $validatedData = $request->validated();
        $user = User::find($id);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $imagePath = $request->file('photo')->store('profiles', 'public');

            $user->photo = $imagePath;
        }

        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }

        $user = $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'cpf' => $validatedData['cpf'],
            'address' => $validatedData['address'],
            'date_birth' => $validatedData['date_birth'],
            'telephone' => $validatedData['telephone'],
        ]);

        if($user){
            return redirect()->route('users-table');
        }

        return redirect()->back();
    }

    public function view($id){
        $user = User::findOrFail($id);
        return view('admin.view-user',compact('user'));
    }

    public function deleteView($id){
        $user = User::find($id);
        return view('admin.delete-user',compact('user'));
    }

    public function delete($id){
        $user = User::find($id);

        if(usuarioLogado() == $user){
            Auth::logout();
        }

        $user->delete();

        return to_route('users-table');
    }
}
