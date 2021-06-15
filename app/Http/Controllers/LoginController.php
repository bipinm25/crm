<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Http;

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
        
        $credentials = $this->credentials($request);       

        if (Auth::attempt($credentials)) {            
            $this->saveHistory($request);        
            return redirect('/dashboard');
        }      
        $this->saveHistory($request, 1);
        return view('login.index',['msg'=>'Wrong credentials']);

    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function username(){
        return 'username';
    }

    public function credentials($request){
        return [
            $this->username()  => $request->username,
            'password'  => $request->password,
            'status'    => '1'
        ];
    }   

    public function saveHistory($r, $status = 0){
        $ip = $r->ip();
        $ip = '49.207.201.18';
        if($ip != '127.0.0.1'){
            $response = Http::retry(3, 100)->get('http://ip-api.com/json/'.$ip, [
                'fields' => '66846719',   //all data
            ])->json();

            
            
            if($status === 0 && isset($response['timezone'])){
                session(['login_timezone' => $response['timezone']]);
            }

            $history = new LoginHistory();
            $history->login_ip = $ip;
            $history->username = $r->username;
            $history->user_id = Auth::user()->id;
            $history->login_details = json_encode($response);
            $history->login_attempt_status = $status; //0-success, 1 - failed
            $history->timezone = $response['timezone'];
            $history->login_city = $response['city'];
            $history->save();
        }
    }

    
}
