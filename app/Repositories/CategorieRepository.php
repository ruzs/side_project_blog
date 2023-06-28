<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\Categorie;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Categorie $model)
    {
        $this->model = $model;
    }

    public function getAllCategorie()
    {
        return $this->model->orderBy('created_at','asc')->get();
    }
    public function getCategorie($id)
    {
        return $this->model->where('id', $id)->first();
    }
}