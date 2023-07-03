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

    public function getAllPost()
    {
        return $this->model->orderBy('title')->get();
    }
    public function getUserPost($created_by)
    {
        return $this->model->where('created_by', $created_by)->get();
    }
    public function getPost($id)
    {
        return $this->model->where('id', $id)->first();
    }
}