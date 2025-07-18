<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Notifications\Notifiable;

class Role extends Model
{
    // use Notifiable;
    use SoftDeletes;
    use Userstamps;



    protected $table = 'roles';

    protected $fillable = [
        'name', 'protect', 'guard_name', 'remark', 'updated_by', 'updated_at', 'created_by', 'created_at'
    ];
    
}
