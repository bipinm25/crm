<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
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
                        $btn = '<a href="javascript:void(0)" data-staff_id='.$row->id.' title="Edit" class="edit_staff"><i class="icon-note"></i></a>
                                <a href="javascript:void(0)" data-staff_id='.$row->id.' title="Delete" class="delete_staff"><i class="icon-trash"></i></a>';
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
            Staff::findOrFail($req->staff_id)->delete();
        }        
    }

}
