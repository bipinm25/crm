<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    public function index(){
        $roles = Role::whereNotIn('name', ['Super-admin'])->orderBy('name')->get();
        return view('role.index',compact('roles'));
    }



    
    public function showRole(Request $req){
        $role = new Role();
        $rolePermissions = new Permission();
        $all_permission = array();
        if((int)$req->id > 0){
            $role = Role::find($req->id);
            $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                ->where("role_has_permissions.role_id",$req->id)
                ->get();

            $all_permission = collect($rolePermissions)->map(function ($p) {            
                return $p['name'];        
            })->toArray();    
        }
        
        

        return view('role.form', compact('role','rolePermissions','all_permission'));
    }



    public function saveRole(Request $req){        

        $this->validate($req, [
            'role_name' => 'required|unique:roles,name,'.(int)$req->role_id.',id'
        ]);

        if((int)$req->role_id > 0){
            $role = Role::find($req->role_id);
            $role->name =  $req->input('role_name');
            $role->save();
        }else{
            $role = Role::create(['name' => $req->input('role_name')]);
        }

        if(is_array($req->permission) && sizeof($req->permission) > 0){
            foreach($req->permission as $key => $permi){
                foreach($permi as $permi => $val){
                    $permission = $key.'-'.$permi;
                    if(!Permission::where('name', '=', $permission)->exists()){
                        Permission::create(['name' => $permission]);
                    }
                    $p[] = $permission;
                }
                $role->syncPermissions($p);
            }       
        }        
    
        return redirect()->route('role')
                        ->with('success','Role created successfully');
    }
}
