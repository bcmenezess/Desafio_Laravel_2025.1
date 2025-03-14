<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index($id){
        $user = User::find($id);
        return view('admin.contact',compact('user'));
    }

    public function store(Request $request,$id){
        $logado = usuarioLogado();
        $user = User::find($id);

        $data = [
            'fromName' => $logado->name,
            'fromEmail' => $logado->email,
            'subject' => $request->input('subject'),
            'message' => $request->input('message')

        ];

        Mail::to($user->email,$user->name)->send(new Contact($data));
        return redirect()->route('users-table');
    }
}
