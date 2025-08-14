<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Entities\Post;
use App\Repositories\PostRepository;
use App\Entities\Category;
use App\Repositories\CategoryRepository;
use App\Entities\User;
use App\Repositories\UserRepository;
use App\Entities\Role;
use App\Repositories\RoleRepository;
use App\Entities\Point;
use App\Repositories\PointRepository;
use Illuminate\Support\Facades\Log;


class ShareholderController extends Controller
{
    private $data;
    private $post_repo;
    private $category_repo;
    private $user_repo;
    private $role_repo;
    private $point_repo;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $post_repo,
                                CategoryRepository $category_repo,
                                UserRepository $user_repo,
                                RoleRepository $role_repo,
                                PointRepository $point_repo)
    {
        // $this->middleware('auth');
        $this->post_repo        = $post_repo;
        $this->category_repo   = $category_repo;
        $this->user_repo   = $user_repo;
        $this->role_repo   = $role_repo;
        $this->point_repo   = $point_repo;
    }

    public function index()
    {
        $total_points = [];
        $shareholders = $this->user_repo->getByHasRole();
        $shareholders->map(function ($shareholder, $key) {
            $shareholder_points = $shareholder->hasPoints;
            $sum = 0;
            $mon_sum = 0;
            $last_mon_sum = 0;
            foreach ($shareholder_points as $key => $shareholder_point) {
                $sum += $shareholder_point->point;
                if (date('Y-m', strtotime($shareholder_point->created_at)) == date('Y-m')) {
                    $mon_sum += $shareholder_point->point;
                    
                }
                if (date('Y-m', strtotime($shareholder_point->created_at)) == date('Y-m', strtotime('-1 month'))) {
                    $last_mon_sum += $shareholder_point->point;
                }
            }
            $shareholder->total_point = $sum;
            $shareholder->month_point = $mon_sum;
            $shareholder->last_month_point = $last_mon_sum;
        });
        $this->data=[
            'bg'            => 'assets/img/post-bg.jpg',
            'row'           => '',
            'month_points'  => '',
            'total_points'  => '',
            'shareholders'  => $shareholders
        ];
        return view('shareholder', $this->data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        DB::beginTransaction();
        try {
            $sum = 0;
            $keys=[];
            foreach ($data as $key => $value) {
                if (preg_match('/^(point)(\d+)$/', $key,$id) && $value) {
                    $sum+= $value;
                }else{
                    if (preg_match('/^(point)(\d+)$/', $key)){
                        array_push($keys,$key);
                    }
                }
            }
            foreach ($keys as $key => $value) {
                unset($data[$value]);
            }
            if ($sum !=0 && count($data) > 3) {
                throw new \Exception('分數不完整，相差'.$sum.'分', config('errors.custom_error.code'));
            }
            
            $data_count = $this->point_repo->getNowMonthPoint()->sortByDesc('created_at')->first()->count;
            if (@$this->point_repo->getNowMonthPoint()->sortByDesc('created_at')->first()->count) {
                $data_count_add1 = substr($data_count,6)+1;
                if ($data_count_add1<10) {
                    $count = date('Ym').'0'.($data_count_add1);
                }else{
                    $count = date('Ym').($data_count_add1);
                }
            }else{
                $count = date('Ym').'01';
            }
            foreach ($data as $key => $value) {
                if (preg_match('/^(point)(\d+)$/', $key,$id) && $value) {
                    $save_data = [
                        "user_id"   => $id[2],
                        "point"     => $value,
                        "count"     => $count,
                    ];
                    $this->point_repo->save($save_data);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Error:'.$e);
            // return response()->json([
            //     "success" => false,
            //     "message" => @$e->getMessage(),
            // ]);

            return redirect()->back()->with('error', @$e->getMessage()?:"false");
        }
        // if ($request->continue)
        //     return redirect()->back()->with('success', true);
        return redirect()->route('shareholder.index')->with('success', true);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $count = $data['count'];
        $sum = 0;
        $save_datas = [];
        DB::beginTransaction();
        try {
            foreach ($data as $key => $value) {
                if (preg_match('/^(point)(\d+)$/', $key,$id) && $value) {
                    array_push($save_datas,['user_id'=>$id[2], 'point'=>$value]);
                    $sum = $sum + $value;
                }
            }
            if ($sum!=0) {
                throw new \Exception('分數不完整，相差'.$sum.'分', config('errors.custom_error.code'));
            }

            $old_points = $this->point_repo->getByCount($count);
            // dump('count',count($old_points) , count($save_datas));
            if (count($old_points) == count($save_datas)) {
                foreach($old_points as $key => $old_point){
                    $old_point->update($save_datas[$key]);
                    // dump($key, $old_point,$save_datas[$key]);
                }
            }else if(count($old_points)>count($save_datas)){
                foreach ($old_points as $key => $old_point) {
                    if (@$save_datas[$key]) {
                        $old_point->update($save_datas[$key]);
                        // dump($key, $old_point,$save_datas[$key]);
                    }else{
                        $old_point->update(['user_id'=>0, 'point'=>0, 'count'=>$count]);
                        // dump('old_point', $old_point);
                    }
                }
            }else{
                foreach ($save_datas as $key => $save_data) {
                    if(@$old_points[$key]){
                        $old_points[$key]->update($save_data);
                        // dump($key, $old_points[$key],$save_data);
                    }else{
                        $save_data['count'] = $count;
                        $this->point_repo->save($save_data);
                        // dump('$save_data', $save_data);
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Error:'.$e);
            return redirect()->back()->with('error', @$e->getMessage()?:"false");
        }

        dd('All',$data,$save_datas,$count);
    }
    
    public function data(Request $request) {
        return $this->point_repo->getByCount($request->count);
    }
}
