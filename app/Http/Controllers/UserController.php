<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function index(Request $req){
        $roles = Role::pluck('name','name')->all();

        return view('users.index',compact('roles'));
        
    }

    public function listUsers(Request $req){

        if ($req->ajax()) { 
            $data = User::whereNotIn('username', ['super_admin'])->orderBy('name')->get();
            return datatables()->of($data)->addColumn('role', function($row){   
                        return implode(',', $row->getRoleNames()->toArray());                       
                    })->addColumn('action', function($row){                      
                        $btn = '<a href="javascript:void(0)" data-user_id='.$row->id.' title="Edit" class="edit_user"><i class="icon-note"></i></a>
                                <a href="javascript:void(0)"  data-user_id='.$row->id.' title="Delete" class="delete_user"><i class="icon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function getUser(Request $req){
        $user = User::findOrFail($req->user_id);
        unset($user['password']);
        echo $user->toJson();
        exit;
    }

    public function saveUser(Request $req){

        $this->validate($req, [
                'first_name' => 'required',
                'username' => 'required|unique:users',
                'email' => 'bail|required|email|unique:users',
                'password' => 'bail|required|min:3',         
            ]);

        
        $staff = new Staff();
        $staff->first_name = $req->first_name;
        $staff->mobile = $req->phone;
        $staff->email = $req->email;
        $staff->save();

        $password = bcrypt($req->password);

        $user = User::create([
            'staff_id' => $staff->id,
            'name' =>  $req->first_name,
            'email' => $req->email,
            'password' => $password,
            'username' => $req->username,     
        ]);

        $user->syncRoles([$req->input('role')]);

        echo json_encode(['success' => true]);
        exit;
    }
    
    public function createuser(Request $request){
        $request->password = '123';
        $password = bcrypt($request->password);
        $user = User::create([
            'name' => 'super-admin',
            'email' => 'superadmin@test.com',
            'password' => $password,
            'username' => 'super_admin'           
        ]);
        $user->assignRole('Super-admin');
    }
}
