<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index(){
        return view('company.index');
    }

    public function showCompany(Request $req){
        return view('company.form');
    }

    public function saveCompany(Request $req){
        
        $company = new Company();
        $company->name = $req->company_name;
        $company->mobile = $req->mobile;
        $company->email = $req->email;
        $company->status_id = $req->status_id;
        $company->sub_status_id = $req->sub_status_id;
        $company->created_by = Auth::user()->username;
        $company->updated_by = Auth::user()->username;
        $company->save();

        return redirect('/company');
        
    }

    public function listCompany(Request $req){

        if ($req->ajax()) {
            $data = Company::latest()->get();            
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" title="Edit" class=""><i class="icon-note"></i></a>
                                <a href="javascript:void(0)" title="Delete" class=""><i class="icon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

    }
}
