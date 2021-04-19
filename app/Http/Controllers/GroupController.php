<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index(){
        return view('chat.index');
    }

    public function listGroup(Request $req){
        

    }

    public function groupChat(Request $req){

        return view('chat.form');

    }
}
