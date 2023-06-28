<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Notifications\Notifiable;

class Categorie extends Model
{
    // use Notifiable;
    use SoftDeletes;
    use Userstamps;



    protected $table = 'categories';

    protected $fillable = [
        'title', 'updated_by', 'updated_at'
    ];
}
