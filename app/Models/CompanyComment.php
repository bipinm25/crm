<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyComment extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = ['commented_at'];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getCommentedAtAttribute(){
        return (new Carbon($this->updated_at))->timezone(session('login_timezone'))->format('d/M/Y H:i');
    }
}
