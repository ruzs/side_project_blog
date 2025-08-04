<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // use Notifiable;
    use SoftDeletes;
    use Userstamps;
    use HasRoles;



    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account', 'name', 'role', 'email', 'password', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function hasPoints()
    {
        return $this->hasMany("App\Entities\Point");
    }

    public function hasRoles()
    {
        return $this->belongsToMany("App\Entities\User", "user_has_roles", "user_id", "role_id");
    }

    public function userRoles()
    {
        return $this->belongsToMany('App\Entities\Role', 'user_has_roles');
    }

    public function isAdminRole()
    {
        return $this->roles->contains('protect', 1);
    }

}
