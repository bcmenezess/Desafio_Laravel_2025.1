<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        if(!isset($_GET['page'])){
            return response()->json([
                'message' => 'Requisição não foi completada. Param. page não definido',
                'status' => 400
            ]);
        }

        $page = $_GET['page'];
        $skip = ($page-1) * 6;
        $totalPages = ceil(Admin::count()/6);

        $admins = UserResource::collection(Admin::get()->skip($skip)->take(6));


        if(!isset($admins) || $page > $totalPages || $page <= 0){
            return response()->json([
                'message' => 'Não foi possível recuperar os usuários admins',
                'status' => 404
            ]);
        }


        return response()->json([
            'admins' => $admins,
            'totalPages' => $totalPages,
            'status' => 200
        ]);
    }
}
