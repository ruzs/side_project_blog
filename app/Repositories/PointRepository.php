<?php

namespace App\Repositories;

use App\Repositories\EloquentRepository;
use App\Entities\Point;
use App\DataTables\CoreDataTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointRepository extends EloquentRepository
{
    protected $model;

    public function __construct(Point $model)
    {
        $this->model = $model;
    }
    public function getNowMonthPoint() {
        return $this->model->whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->get();
    }
}