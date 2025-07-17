<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\Post;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->orderBy('updated_at','desc')->get();
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