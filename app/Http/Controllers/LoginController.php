<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    public function index(){
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login.index');
    }
    
    public function login(Request $request){

        $messages = [
            'username.required' => 'UserName is required', 
            'password.required' => 'Password is required',       
        ];
        
        Validator::make($request->all(), [
            'username' => 'required|max:255',
            'password' => 'required',
        ], $messages)->validate();
        
        $credentials = $request->only($this->username(), 'password');

        if (Auth::attempt($credentials)) {            
            return redirect('/dashboard');
        }

       

        return view('login.index',['msg'=>'Wrong Email/Password']);

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function username()
    {
        return 'username';
    }

    
}
