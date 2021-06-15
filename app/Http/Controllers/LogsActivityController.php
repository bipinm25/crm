<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\LoginHistory;

class LogsActivityController extends Controller
{
    public function index(){
        return view('logs.index');
    }

    public function listLogs(Request $req){
        if ($req->ajax()) {                
            $activity = Activity::all();            

            return datatables()->of($activity)
                    ->addColumn('module', function($row){
                        return ucfirst($row->log_name);
                    })->addColumn('action', function($row){
                        return $row->description;
                    })->addColumn('action_by', function($row){
                        $user = User::findOrFail($row->causer_id);
                        return $user->staff->first_name.' '.$user->staff->last_name;
                    })->addColumn('date', function($row){
                        return (new Carbon($row->created_at))->timezone(session('login_timezone'))->format('d/M/Y H:i');
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    public function getLog(Request $req){
        if((int)$req->log_id > 0){                    
            $changes = [];

            $activity = Activity::where('id', $req->log_id)->first();

            $response['id'] = $activity->subject_id;
            if($activity->description !='deleted'){
                $subject = isset($activity->subject) ? $activity->subject->toArray() : [];            
                $chang = isset($activity->changes) ? $activity->changes->toArray() : [];
                     
                $colattributes = isset($chang['attributes'])?array_keys($chang['attributes']):[];
                if($activity->description == 'updated'){
                    foreach($subject as $col => $val){     
                        if(in_array($col, $colattributes) && $chang['attributes'][$col] != $chang['old'][$col]){
                            $changes[$col] = ['old'=> $chang['old'][$col]??'', 'new'=> $chang['attributes'][$col]??''];
                        }
                    }            
                }else{
                    $changes = $chang['attributes'];
                }
                
            $response['changes'] = $changes;
            //$response['id'] = $activity->subject->id;
            }

            $user = User::findOrFail($activity->causer_id);
            $action_by = $user->staff->first_name.' '.$user->staff->last_name;
            $model = explode("\\" , $activity->subject_type);

            $response['date'] = (new Carbon($activity->created_at))->timezone(session('login_timezone'))->format('d/M/Y H:i');
            $response['action'] = $activity->description;     
            $response['action_by'] = $action_by;           
            $response['model_class'] = end($model);
            $response['module'] = $activity->log_name;
            return response()->json($response);
        }
    }

    public function getLoginHistory(Request $req){
        if ($req->ajax()) {                
            $activity = LoginHistory::orderBy('id', 'desc')->get();            

            return datatables()->of($activity)
                    ->addColumn('user', function($row){
                        return ucfirst($row->username);
                    })->addColumn('logintime', function($row){
                        return (new Carbon($row->created_at))->timezone(session('login_timezone'))->format('d/M/Y H:i');
                    })->addColumn('region', function($row){
                      return $row->login_city;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }
}
