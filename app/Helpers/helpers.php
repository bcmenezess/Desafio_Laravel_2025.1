<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('isAdmin')) {
    function isAdmin(){
        return Auth::guard('admin')->check();
    }
}

if (!function_exists('isUser')) {
    function isUser(){
        return Auth::guard('web')->check();
    }
}

if (!function_exists('usuarioLogado')) {
    function usuarioLogado(){
        if(isAdmin()){
            return Auth::guard('admin')->user();
        }
        if(isUser()){
            return Auth::guard('web')->user();
        }

        return null;
    }
}