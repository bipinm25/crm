<?php
namespace App\Helper;

use Illuminate\Support\Facades\Auth;

class HelperPermission{

    public function checkPermissions(array $permissons = []){
        if(Auth::user()->hasRole('Super-admin')){
            return true;
        }

        if(is_array($permissons) && sizeof($permissons) > 0){
            if(sizeof($permissons) === 1){                
                Auth::user()->can($permissons[0]);
            }else{
                Auth::user()->hasAnyPermission($permissons);
            }
        }
    }

    public static function instance(){
        return new HelperPermission();
     }


}