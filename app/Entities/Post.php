<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    // use Notifiable;
    use SoftDeletes;
    use Userstamps;



    protected $table = 'posts';

    protected $fillable = [
        'title', 'subtitle', 'category_id', 'content', 'updated_by', 'updated_at'
    ];

    public function creator()
    {
        return $this->belongsTo("App\Entities\User", "created_by");
    }
    public function caregorie()
    {
        return $this->belongsTo("App\Entities\Caregorie", "category_id");
    }

    
}
