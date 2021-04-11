<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyComment;
use App\Models\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index(){
        return view('company.index');
    }

    public function showCompany(Request $req){

        $company = new Company();

        if((int)$req->id > 0){
            $company = Company::findOrFail($req->id);           
        }

        return view('company.form')->with(compact('company'));
    }

    public function saveCompany(Request $req){

        $messages = [
            'company_name.required' => 'Company name is required',   
            //'title.max' => 'maximum length 255',             
        ];
        
        Validator::make($req->all(), [
            'company_name' => 'required',          
        ], $messages)->validate();

        
        $company = new Company();
        if((int)$req->company_id > 0){
            $company = Company::findOrFail($req->company_id);
        }else{
            $company->created_by = Auth::user()->id;
        }

        $company->name = $req->company_name;
        $company->mobile = $req->mobile;
        $company->email = $req->email;
        $company->status_id = $req->status_id;
        $company->sub_status_id = $req->sub_status_id;
        $company->full_address = $req->full_address;       
        $company->updated_by = Auth::user()->id;
        $company->save();

        if(strlen(trim($req->contact_person)) > 0 && (int)$req->company_id == 0){
            $staff = new Staff();
            $staff->company_id = $company->id;
            $staff->staff_type = 2;
            $staff->first_name = $req->contact_person;
            $staff->created_by = Auth::user()->id;
            $staff->updated_by = Auth::user()->id;
            $staff->save();
        }

        return redirect('/company');
        
    }

    public function listCompany(Request $req){

        if ($req->ajax()) {
            $general_settings = config('general_settings');
            
            $data = Company::latest()->get();            
            return datatables()->of($data) 
                    ->editColumn('status_id', function($row) use($general_settings){
                        return  (int)$row->status_id > 0?$general_settings['company_status'][$row->status_id]:'';
                    })->editColumn('sub_status_id', function($row) use($general_settings){
                        return  (int)$row->sub_status_id > 0?$general_settings['company_sub_status'][$row->sub_status_id]:'';
                    })->addColumn('action', function($row){                        
                        $btn = '<a href="'.route('showcompany', $row->id).'" title="Edit" class=""><i class="icon-note"></i></a>
                                <a href="javascript:void(0)" title="Delete" class=""><i class="icon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

    }

    public function saveComment(Request $req){

        if(strlen(trim($req->comment)) > 0 && (int)$req->company_id > 0 ){
            $comment = new CompanyComment();
            $comment->company_id = (int)$req->company_id;
            $comment->comment = $req->comment;
            $comment->parent_id = $req->parent_id;
            $comment->timezone = session('login_timezone');
            $comment->created_by = Auth::user()->id;
            $comment->updated_by = Auth::user()->id;
            $comment->save();            
        }

        echo json_encode(['success'=>true]);

    }

    public function showComments(Request $req){        
        echo $this->buildCommentHtml($req->company_id, 0);
        exit;
    }

    public function buildCommentHtml($company_id, $parent_id = 0){

        $comments = CompanyComment::with('user')->where('company_id', $company_id)->where('parent_id', $parent_id)->get();

        $html = '';
        foreach($comments as $comment){
            
            $commented_by = $comment->user->username == Auth::user()->username?'Me':$comment->user->username;

            $html .= '<div class="media">
                        <div class="media-left pr-1">
                            <a href="javascript:;">
                                <span class="avatar avatar-online"><img src="'.url('app-assets/images/icons/nouser.png').'" alt="avatar"></span>
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="text-bold-600 mb-0"><a href="javascript:;">'.$commented_by.'</a> - '.$comment->commented_at.'</p>
                            <p class="m-0">'.$comment->comment.'</p>
                            <ul class="list-inline mb-1">                                                               
                                <li class="pr-1"><a href="javascript:;" class="replay"><span class="fa fa-commenting-o"></span> Replay</a></li>
                            </ul>
                            <section class="chat-app-form hidden">
                                <form class="chat-app-input d-flex">
                                <fieldset class="form-group position-relative has-icon-left col-10 m-0">
                                    <div class="form-control-position">
                                    <i class="icon-emoticon-smile"></i>
                                    </div>
                                    <input type="text" data-parent_id='.$comment->id.'  class="form-control comments" id="iconLeft4-message" placeholder="Write comments...">
                                    <div class="form-control-position control-position-right">
                                    <i class="fa fa-paper-plane-o"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left col-2 m-0">
                                    <button type="button" class="btn btn-info send_comment"><span class="d-none d-lg-block">Send</span></button>
                                </fieldset>
                                </form><br>
                            </section>
                           '. $this->buildCommentHtml($company_id, $comment->id).'                                                                            
                        </div>                                                        
                    </div>';

        }        

       return $html;
    }

    public function listStaff(Request $req){
        if ($req->ajax()) {                       
            $data = Staff::where('company_id', $req->company_id)->where('staff_type', 2)->get();            
            return datatables()->of($data)
                    ->addColumn('action', function($row){                        
                        $btn = '<a href="javascript:void(0)" data-staff_id='.$row->id.' title="Edit" class=""><i class="icon-note"></i></a>
                                <a href="javascript:void(0)" data-staff_id='.$row->id.' title="Delete" class=""><i class="icon-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function saveStaff(Request $req){

        $staff = new Staff();
        $staff->company_id = $req->company_id;
        $staff->staff_type = 2;
        $staff->first_name = $req->first_name;
        $staff->last_name = $req->last_name;
        $staff->email = $req->email;
        $staff->mobile = $req->mobile;
        $staff->save();

    }
}
