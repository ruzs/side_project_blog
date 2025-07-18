<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\User;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function getAll()
    {
        return $this->model->orderBy('id','asc')->get();
    }
    public function getByUserId($created_by)
    {
        return $this->model->where('created_by', $created_by)->get();
    }
    public function getById($id)
    {
        return $this->model->with('userRoles')->where('id', $id)->first();
    }
    public function getByHasRole()
    {
        return $this->model
        ->join('user_has_roles','user_has_roles.user_id','=','users.id')
        ->join('roles','user_has_roles.role_id','=','roles.id')
        ->select('users.*','roles.name as role_name')
        ->get();
    }
}