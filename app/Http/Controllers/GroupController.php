<?php

namespace App\Http\Controllers;

use App\Helper\HelperPermission;
use App\Models\Group;
use App\Models\GroupMember;
use App\Models\User;
use App\Models\GroupChat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    public function index(){
        return view('chat.index');
    }

    public function listGroup(Request $req){
        if ($req->ajax()) {
            $data = Group::with(['company','user'])->get();     
            return datatables()->of($data)
                    ->editColumn('created_by', function($row){
                        return  $row->user->staff->first_name.''.$row->user->staff->last_name;
                    })->editColumn('company', function($row){
                        return $row->company->name;
                    })->addColumn('action', function($row){
                        $canedit = HelperPermission::instance()->checkPermissions(['chat-full_access', 'chat-read_write']);
                        $fullaccess = HelperPermission::instance()->checkPermissions(['chat-full_access']);

                        $delete = $fullaccess?'<a href="javascript:void(0)" data-group_id="'.$row->id.'" title="Delete" class="delete_group"><i class="icon-trash"></i></a>':'';                     
                        $icon = '<i class="icon-eye"></i>';
                        if($canedit){
                            $icon = '<i class="icon-speech"></i>';
                        }
                        $btn = '<a href="'.route('groupchat', $row->id).'" title="Open" class="">'.$icon.'</a> '.$delete;
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function saveGroup(Request $req){

        $group = new Group();
        $group->company_id = $req->company_id;
        $group->name = $req->group_name;
        $group->admin_user_id = Auth::user()->id;
        $group->created_by = Auth::user()->id;
        $group->updated_by = Auth::user()->id;
        $group->save();

        if($req->ajax()){
            echo json_encode(['company_id' => $group->id, 'redirecturl' => route('groupchat', $group->id)]);
            exit;
        }   

    }

    public function searchUsers(Request $req){   

        $group = Group::with('members')->findOrFail($req->group_id);
        $memIds = $group->members->pluck('user_id')->toArray();
       
       // \DB::enableQueryLog();
        $users = User::whereHas('staff', function($q) use($group,$req){
            $q->where(function($q1) use($req){
                return $q1->where('last_name', 'like', $req->search.'%')->orWhere('first_name', 'like', $req->search.'%');
            })->where(function($q2) use($group, $req){
                return $q2->where('company_id', $group->company_id)->orWhere('staff_type', '1');
            });
        })->whereNotIn('id', $memIds)->get();
       // dd(\DB::getQueryLog());


        $response = array();
        foreach($users as $com){
           $isInternal = $com->staff->staff_type == 2?' (Company)' : ' (Internal)';            
           $response[] = array(
                "id"=> $com->id,
                "text"=> $com->staff->full_name.$isInternal,
           );
        }
  
        return response()->json($response);
        exit;       
    }

    public function addMembers(Request $req){
       GroupMember::create(['group_id' => $req->group_id , 'user_id' => $req->user_id]);
       return response()->json(['success' => true]);
    }

    public function listGroupMembers(){
        $members = GroupMember::with(['group','user'])->get();
        $list = "";
        foreach($members as $m){
            $list .= '<div class="users-list-padding media-list">
                        <a href="#" class="media border-0">
                        <div class="media-left pr-1">
                            <span class="avatar avatar-md avatar-offline"><img class="media-object rounded-circle" src="'.asset("app-assets/images/icons/nouser.png").'" alt="user">
                            <i></i>
                            </span>
                        </div>
                        <div class="media-body w-100">
                            <h6 class="list-group-item-heading">'.$m->user->staff->full_name.'<span class="font-small-3 float-right info"></span></h6>
                            <p class="list-group-item-text text-muted mb-0"><i class="ft-check primary font-small-2"></i> Okay <span data-user_id="'.$m->user_id.'" class="float-right primary delete_member"><i class="font-medium-1 icon-trash blue-grey lighten-3"></i></span></p>
                        </div>
                        </a>
                    </div>';
        }

        echo $list;
        exit;        
    }

    public function sendMessage(Request $req){
       
       
        $chat = new GroupChat();
        $chat->group_id = $req->group_id;
        $chat->user_id = Auth::user()->id;        
        $chat->created_by = Auth::user()->id;
        $chat->updated_by = Auth::user()->id;

        if(strlen(trim($req->message)) > 0){
            $chat->message = $req->message;
        }
        if($req->hasFile('chat_files')){
            $response = Storage::makeDirectory('chat/11');

            $filenameWithExt = $req->file('chat_files')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $req->file('chat_files')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $req->file('chat_files')->storeAs('chat/11',$fileNameToStore);       
            $chat->filename = $path;            
        }
       
        $chat->save();

        return response()->json(['success' => true]);

    }

    public function groupChat(Request $req){
        $group = Group::findOrFail($req->id);     
        return view('chat.form')->with(compact('group'));
    }

    public function getChat(Request $req){

        $chats = GroupChat::with('user')->where('group_id', $req->group_id)->orderBy('created_at')->get();
        $html = '';       
        foreach($chats as $chat){
            $user = $chat->user->staff->first_name.' '.$chat->user->staff->last_name;
            $class = (Auth::user()->id == $chat->user_id) ? 'chat-message-right' : 'chat-message-left';
            $time = (new Carbon($chat->created_at))->timezone(session('login_timezone'))->format('d-M-Y g:i A');
            $actiontime = (Auth::user()->id == $chat->user_id) ? 'You - '. $time : $user.' - '. $time;
            
            if(!empty($chat->message)){
                $html .=  $this->buildChat($class, $actiontime, $chat->message);
            }
            if(!empty($chat->filename)){
                $filename = basename($chat->filename);
                $atag = '<a href="'.route('downloadfile',['file_path' => $chat->filename ]).'">'.$filename.'</a>';
                $html .=  $this->buildChat($class, $actiontime, $atag);
            }          
        }

       
        return response()->json(['html' => $html]);
    }

    private function buildChat($class, $actiontime, $message){
        $html = '<div class="'.$class.' pb-4">
                        <div>
                            <img src="'.asset('app-assets/images/icons/nouser.png').'" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                            <div class="text-muted small text-nowrap mt-2"></div>
                        </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                            <div class="font-weight-bold mb-1">'.$actiontime.'</div>
                            '.$message.'
                        </div>
                    </div>';

        return $html;

    }

    public function downloadFile(Request $req){
        if(!empty($req->file_path)){           
            return Storage::download($req->file_path);
        }

        die('empty file path');
        exit;
        
       
    }
}
