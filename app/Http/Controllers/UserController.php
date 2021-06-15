<?php

namespace App\Http\Controllers;

use App\Helper\HelperPermission;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{    

    
    public function index(Request $req){
        $roles = Role::whereNotIn('name', ['super-adminasd'])->pluck('name','name')->all();

        return view('users.index',compact('roles'));
        
    }

    public function listUsers(Request $req){

        if ($req->ajax()) { 
            $data = User::with('staff')->whereNotIn('username', ['super_admin'])->orderBy('name')->get();
            return datatables()->of($data)->editColumn('name', function($row){
                        return $row->staff->full_name;
                    })->addColumn('role', function($row){   
                        return implode(',', $row->getRoleNames()->toArray());                       
                    })->addColumn('action', function($row){   
                        $canedit = HelperPermission::instance()->checkPermissions(['user-full_access', 'user-read_write']);
                        $fullaccess = HelperPermission::instance()->checkPermissions(['user-full_access']);

                        $delete = $fullaccess ? '<a href="javascript:void(0)"  data-user_id='.$row->id.' title="Delete" class="delete_user"><i class="icon-trash"></i></a>' : '';
                        $icon = '<i class="icon-eye"></i>';
                        if($canedit){         
                            $icon = '<i class="icon-note"></i>';
                        }                       
                        $btn = '<a href="javascript:void(0)" data-user_id='.$row->id.' title="Edit" class="edit_user">'.$icon.'</a>'.$delete;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function getUser(Request $req){
        $user = User::with('staff')->findOrFail($req->user_id);
        $user['password'] = '';
        $user['role'] = $user->getRoleNames()->first();
        $user['first_name'] =  $user->staff->first_name;
        $user['last_name'] = $user->staff->last_name;
        $user['email'] = $user->staff->email;
        $user['phone'] = $user->staff->mobile;
        echo $user->toJson();
        exit;
    }

    public function saveUser(Request $req){
    
        $messages = [
            'first_name.required' => 'First name is required',
            'email.email' => 'Not a valid Email Id',
            'username.required' => 'Username is required',
            'username.unique' => 'Username should be unique',                      
        ];
        
        Validator::make($req->all(), [
            'first_name' => 'required',
            'username' => 'required|unique:users,username,'.(int)$req->user_id,
            'password' => (!empty(trim($req->password)))? 'min:8': '',            
            'email' => (!empty(trim($req->email)))? 'email': '',
        ], $messages)->validate();

        $user = new User();
        $staff = new Staff();
        if((int)$req->user_id > 0){ //update user
            $user = User::findOrFail((int)$req->user_id);
            $user->updated_by = Auth::user()->id;
            if($user->staff_id > 0){
                $staff = Staff::findOrFail($user->staff_id);
                $staff->updated_by = Auth::user()->id;
            }
        }else{
            $user->created_by = $staff->created_by = Auth::user()->id;
            $user->updated_by = $staff->updated_by = Auth::user()->id;
        }
        
        $staff->first_name  = $req->first_name;
        $staff->last_name   = $req->last_name;
        $staff->mobile      = $req->phone;
        $staff->email       = $req->email;
        $staff->save();


       
        
        if(!empty(trim($req->password))){
            $password = bcrypt($req->password);          
            $user->password = $password;
        }
        
        $user->staff_id = $staff->id;
        $user->name     = $req->first_name;
        $user->email    = $req->email;        
        $user->username = $req->username;
        $user->save();

        
        if(strlen($req->input('role')) > 0){
            $user->syncRoles([$req->input('role')]);
        }       

        echo json_encode(['success' => true]);
        exit;
    }

    public function deleteUser(Request $req){
        if((int)$req->user_id > 0){
            $user = User::findOrFail((int)$req->user_id);
            $user->deleted_by = Auth::user()->id;
            $user->save();
            $user->delete();
        }
    }

    public function getProfile(Request $req){
        $user = User::with('staff')->findOrFail(Auth::user()->id);
        $user['password'] = '';
        $user['first_name'] =  $user->staff->first_name;
        $user['last_name'] = $user->staff->last_name;
        $user['email'] = $user->staff->email;
        $user['mobile'] = $user->staff->mobile;
        echo $user->toJson();
        exit;
    }

    public function saveProfile(Request $req){

        $messages = [
            'first_name.required' => 'First name is required',
            'email.email' => 'Not a valid Email Id',                    
        ];
        
        Validator::make($req->all(), [
            'first_name' => 'required',           
            'new_password' => (!empty(trim($req->new_password)))? 'min:8': '',
            're_enter_password' => 'same:new_password',            
            'email' => (!empty(trim($req->email)))? 'email': '',
        ], $messages)->validate();

       

       
        $user = User::findOrFail(Auth::user()->id);
        $user->updated_by = Auth::user()->id;
        if($user->staff_id > 0){
            $staff = Staff::findOrFail($user->staff_id);
            $staff->updated_by = Auth::user()->id;
            $staff->first_name  = $req->first_name;
            $staff->last_name   = $req->last_name;
            $staff->mobile      = $req->mobile;
            $staff->email       = $req->email;
            $staff->save();            
        }
        if(!empty(trim($req->current_password))){

            if(!Hash::check($req->current_password, $user->password)){
                return response()->json([
                    'errors' => ['current_password' => "Wrong current password "],
                ], 422);
            }

        }
        if(!empty(trim($req->new_password)) ){
            $password = bcrypt($req->new_password);          
            $user->password = $password;
        }  
        $user->name     = $req->first_name;
        $user->email    = $req->email;    
        $user->save();

        
        

    }





    
    
    public function createuser(Request $request){ //for testing
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
