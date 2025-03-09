<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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
        'password' => bcrypt($validatedData['password']),
        'photo' => $imagePath,
        'admin_id' => $logado->id,
        'balance' => 0
    ]);

    if($user){
        return redirect()->route('users-table')->with('success', 'Usuário cadastrado com sucesso!');
    }

    return redirect()->back()->with('error', 'Erro ao cadastrar usuário.');
}
}
