<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected static $logName = 'company';    

    protected static $logAttributes = ['name', 'company_id'];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function members(){
        return $this->hasMany(GroupMember::class, 'group_id');
    }
}
