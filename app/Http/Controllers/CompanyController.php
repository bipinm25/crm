<?php

namespace App\Http\Controllers;

use App\Helper\HelperPermission as HelperPermission;
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
            $staff = Staff::where('company_id', $req->id)->get();
        }

        return view('company.form')->with(compact('company','staff'));
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
        $edit = false;
        if((int)$req->company_id > 0){
            $edit = true;
            $company = Company::findOrFail($req->company_id);
            $company->contact_person_id = $req->contact_person_id;
            $company->updated_by = Auth::user()->id;
        }else{
            $company->created_by = Auth::user()->id;
        }

        $company->name = $req->company_name;
        $company->mobile = $req->mobile;
        $company->email = $req->email;
        $company->status_id = $req->status_id;
        $company->sub_status_id = $req->sub_status_id;
        $company->full_address = $req->full_address;      
        $company->save();

        if(strlen(trim($req->first_name)) > 0 && (int)$company->id > 0){
            $staff = new Staff();
            $staff->company_id = $company->id;
            $staff->staff_type = 2;
            $staff->first_name = $req->first_name;
            $staff->last_name = $req->last_name;
            $staff->email = $req->email;
            $staff->mobile = $req->mobile;
            $staff->created_by = Auth::user()->id;
            $staff->updated_by = Auth::user()->id;
            $staff->save();

            $company->contact_person_id = $staff->id;
            $company->save();
        }

        if($req->ajax()){
            echo json_encode(['company_id' => $company->id, 'redirecturl' => route('showcompany', $company->id)]);
            exit;
        }        

        return redirect('/company');
        
    }

    public function listCompany(Request $req){

        if ($req->ajax()) {
            $general_settings = config('general_settings');

            $whereCompany[] = ['id', '>', 0]; //set some default where else it will throw error

            if(strlen(trim($req->company_name)) > 0){
                $whereCompany[] = ['name', 'like', $req->company_name.'%'];
            }
            if((int)$req->status_id > 0){
                $whereCompany[] = ['status_id', '=', (int)$req->status_id];
            }
            if((int)$req->sub_status_id > 0){
                $whereCompany[] = ['sub_status_id', '=', (int)$req->sub_status_id];
            }

            
            $data = Company::with('user')->where($whereCompany)->get();            
            return datatables()->of($data)
                    ->editColumn('created_by', function($row){
                        return  $row->user->staff->first_name.''.$row->user->staff->last_name;
                    })->editColumn('status_id', function($row) use($general_settings){
                        return  (int)$row->status_id > 0 ? $general_settings['company_status'][$row->status_id] : '';
                    })->editColumn('sub_status_id', function($row) use($general_settings){
                        return  (int)$row->sub_status_id > 0?$general_settings['company_sub_status'][$row->sub_status_id]:'';
                    })->addColumn('action', function($row){

                        $canedit = HelperPermission::instance()->checkPermissions(['company-full_access', 'company-read_write']);
                        $fullaccess = HelperPermission::instance()->checkPermissions(['company-full_access']);

                        $delete = $fullaccess?'<a href="javascript:void(0)" data-company_id="'.$row->id.'" title="Delete" class="delete_company"><i class="icon-trash"></i></a>':'';                     
                        $icon = '<i class="icon-eye"></i>';
                        if($canedit){         
                            $icon = '<i class="icon-note"></i>';
                        }
                        $btn = '<a href="'.route('showcompany', $row->id).'" title="Edit" class="">'.$icon.'</a> '.$delete;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

    }

    public function deleteCompany(Request $req){
        if((int)$req->company_id > 0){
            $company = Company::findOrFail((int)$req->company_id);      
            $company->deleted_by = Auth::user()->id;
            $company->save();
            $company->delete();
        }
    }

    public function saveComment(Request $req){

        if(strlen(trim($req->comment)) > 0 && (int)$req->company_id > 0 ){
            $comment = new CompanyComment();
            $edit = false;
            if((int)$req->comment_id > 0){
                $edit = true;
                $comment = CompanyComment::findOrFail((int)$req->comment_id);
            }
            if(!$edit){
                $comment->created_by = Auth::user()->id;
                $comment->parent_id = $req->parent_id;
                $comment->company_id = (int)$req->company_id;
            }           
            $comment->comment = $req->comment;            
            $comment->timezone = session('login_timezone');            
            $comment->updated_by = Auth::user()->id;
            $comment->save();            
        }

        echo json_encode(['success'=>true]);

    }

    public function deleteComment(Request $req){
        if((int)$req->comment_id > 0){
            CompanyComment::findOrFail((int)$req->comment_id)->delete();
        }
    }

    public function showComments(Request $req){        
        echo $this->buildCommentHtml($req->company_id, 0);
        exit;
    }

    public function buildCommentHtml($company_id, $parent_id = 0){

        $comments = CompanyComment::with('user')->where('company_id', $company_id)->where('parent_id', $parent_id)->get();

        $html = '';
        $canedit = HelperPermission::instance()->checkPermissions(['company-full_access', 'company-read_write']);
        $fullaccess = HelperPermission::instance()->checkPermissions(['company-full_access']);

    
        foreach($comments as $comment){

            $me = $comment->user->username == Auth::user()->username ? true : false;

            $commented_by = $me?'Me':$comment->user->username;            

            $action = ($me && $canedit) ?
                            '<li class="pr-1"><a href="javascript:void(0)" data-comment_id="'.$comment->id.'" title="Edit" class="edit_comment"><i class="icon-note"></i></a></li>':'';

            $delete = ($me && $fullaccess)? '<li class="pr-1"><a href="javascript:void(0)" data-comment_id="'.$comment->id.'" title="Delete" class="delete_comment"><i class="icon-trash"></i></a></li>' : '';

            $action .= $delete;

            $replay = $canedit? '<li class="pr-1"><a href="javascript:;" class="replay"><span class="fa fa-commenting-o"></span> Replay</a></li>':'';


            $html .= '<div class="media">
                        <div class="media-left pr-1">
                            <a href="javascript:;">
                                <span class="avatar avatar-online"><img src="'.url('app-assets/images/icons/nouser.png').'" alt="avatar"></span>
                            </a>
                        </div>
                        <div class="media-body">
                            <p class="text-bold-600 mb-0"><a href="javascript:;">'.$commented_by.'</a> - '.$comment->commented_at.'</p>
                            <p class="m-0 p_comment">'.$comment->comment.'</p>
                            <ul class="list-inline mb-1">                                
                                '.$replay.$action.'              
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

    public function getCompany(Request $req){
       
        $company = Company::where('name', 'like', $req->term.'%')->limit(5)->get();

        $response = array();
        foreach($company as $com){
           $response[] = array(
                "id"=>$com->id,
                "text"=>$com->name
           );
        }
  
        return response()->json($response);
        exit;

    }

    
}
