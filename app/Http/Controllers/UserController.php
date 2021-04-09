<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
    public function createuser(Request $request){

        // $this->validate($request, [
        //     'fullName' => 'required',
        //     'email' => 'bail|required|email|unique:users',
        //     'password' => 'bail|required|min:6',
        //     'role_id' => 'required',
        // ]);
        $request->password = '123';
        $password = bcrypt($request->password);
        $user = User::create([
            'name' => 'bipin',
            'email' => 'bipinm25@gmail.com',
            'password' => $password,
            //'role_id' => $request->role_id,
        ]);
        //return $user;
    }
}
