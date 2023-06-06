<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\User;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteRepository extends EloquentRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
    
    public function getAll()
    {
        return $this->model->orderBy('name')->get();
    }
}