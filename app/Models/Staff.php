<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Staff extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $appends = ['full_name'];

    protected static $logName = 'staff';

    protected static $logAttributes = ['company_id', 'first_name', 'last_name','mobile','email','full_address','status', 'created_by', 'updated_by', 'deleted_by','deleted_at'];

    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }   
   
}
