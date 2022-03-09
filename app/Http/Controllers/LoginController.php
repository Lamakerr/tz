<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){

        return "страница авторизации";
   
    }
    public function store(Request $request){
        $data = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
      
        if (Auth::attempt($data)) {
            $username=auth()->user()->name;
            $request->session()->regenerate();
         return "Добро пожаловать, $username!";
        }

        return back()->withErrors([
            'auth' => 'Email или пароль введен не верно!',
        ]);
    } 
}
