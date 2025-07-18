<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\Role;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Role $model)
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
        return $this->model->where('id', $id)->first();
    }
    public function getByNotProtect()
    {
        return $this->model->where('protect', 0)->get();
    }

}