<?php

namespace App\Http\Controllers;

use App\Helper\HelperPermission;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(Request $req){


    }

    public function listStaff(Request $req){
        if ($req->ajax()) {                   
            $data = Staff::where('company_id', $req->company_id)->where('staff_type', 2)->get();            
            return datatables()->of($data)
                    ->addColumn('action', function($row){
                        $com_canedit = HelperPermission::instance()->checkPermissions(['company-full_access', 'company-read_write']);
                        $com_fullaccess = HelperPermission::instance()->checkPermissions(['company-full_access']);

                        $delete = $com_fullaccess ? ' <a href="javascript:void(0)" data-staff_id='.$row->id.' title="Delete" class="delete_staff"><i class="icon-trash"></i></a>' : '';
                        $icon = '<i class="icon-eye"></i>';
                        if($com_canedit){         
                            $icon = '<i class="icon-note"></i>';
                        }                  
                        $btn = '<a href="javascript:void(0)" data-staff_id='.$row->id.' title="Edit" class="edit_staff">'.$icon.'</a> '.$delete;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function saveStaff(Request $req){

        $messages = [
            'first_name.required' => 'First name is required',
            'email.email' => 'Not a valid Email Id',       
        ];
        
        Validator::make($req->all(), [
            'first_name' => 'required',
            'email' => (!empty(trim($req->email)))? 'email': '',
        ], $messages)->validate();

        $staff = new Staff();
        if((int)$req->staff_id > 0){
            $staff = Staff::findOrFail((int)$req->staff_id);
        }
       
        $staff->company_id = (int)$req->company_id;
        $staff->staff_type = (int)$req->staff_type;
        $staff->first_name = $req->first_name;
        $staff->last_name = $req->last_name;
        $staff->email = $req->email;
        $staff->mobile = $req->mobile;
        $staff->save();
    }

    public function getStaff(Request $req){
        $staff = Staff::findOrfail($req->staff_id);
        echo $staff->toJson();
        exit;
    }

    public function deleteStaff(Request $req){
        if((int)$req->staff_id > 0){
           $staff = Staff::findOrFail($req->staff_id);
           $staff->deleted_by = Auth::user()->id;
           $staff->save();
           $staff->delete();
        }        
    }

}
