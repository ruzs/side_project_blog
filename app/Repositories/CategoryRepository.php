<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\Category;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at','asc')->get();
    }
    public function getByUserId($created_by)
    {
        return $this->model->where('created_by', $created_by)->get();
    }
    public function getById($id)
    {
        return $this->model->where('id', $id)->first();
    }
}