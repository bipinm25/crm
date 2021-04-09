<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index(){
       //\Auth::user()->getFullName()
        return view('dashboard.index');
    }

    public function sample(){
        return view('sample.form');
    }
}
