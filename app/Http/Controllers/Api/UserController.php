<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        if(!isset($_GET['id'])){
            return response()->json([
                'message' => 'Requisição não foi completada. ID não definido',
                'status' => 400
            ]);
        }

        $page = $_GET['id'];
        $skip = ($page-1) * 6;
        $totalPages = ceil(User::count()/6);

        $users = UserResource::collection(User::get()->skip($skip)->take(6));


        if(!isset($users) || $page > $totalPages || $page <= 0){
            return response()->json([
                'message' => 'Não foi possível recuperar os usuários comuns',
                'status' => 404
            ]);
        }


        return response()->json([
            'users' => $users,
            'totalPages' => $totalPages,
            'status' => 200
        ]);
    }
}
