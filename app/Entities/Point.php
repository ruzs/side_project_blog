<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Notifications\Notifiable;

class Point extends Model
{
    // use Notifiable;
    use SoftDeletes;
    use Userstamps;



    protected $table = 'points';

    protected $fillable = [
        'user_id', 'point', 'log_date'
    ];
}
