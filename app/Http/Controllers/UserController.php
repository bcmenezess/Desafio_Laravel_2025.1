<?php

namespace App\Http\Controllers;

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
}
