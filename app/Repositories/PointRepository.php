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

    public function getByCount($count) {
        return $this->model->where('count', $count)->get();
    }
    public function getByCountUserId($count,$id) {
        return $this->model->where('count', $count)->where("user_id",$id)->first();
    }

    public function getByGroupCount() {
        return $this->model
        ->select('count', 
                DB::raw('SUM(point) as total_point'), 
                DB::raw('FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(created_at))) as created_at'))
        ->groupBy(DB::raw('`count`'))
        ->orderBy('count','desc')
        ->get();
    }
}