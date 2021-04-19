<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logName = 'company';

    protected $appends = ['date_added'];

    protected static $logAttributes = ['name', 'contact_person_id', 'mobile', 'email', 'status_id', 'sub_status_id', 'full_address', 'created_by', 'updated_by' ];

    public function comments(){
        return $this->hasMany(CompanyComment::class,'company_id','id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDateAddedAttribute(){
        return (new Carbon($this->created_at))->format('d-M-Y');
    }
    
}
