<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Entities\Category;
use App\Repositories\CategoryRepository;
// use App\Repositories\ErrorLogRepository;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{

    private $data;
    private $log_name;
    private $category_repo;
    // private $errorlog_repo;

    public function __construct(CategoryRepository $category_repo
                                // ErrorLogRepository $errorlog_repo
    )
    {
        $this->log_name         = 'Category';
        $this->category_repo        = $category_repo;
        // $this->errorlog_repo    = $errorlog_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view("categorys.category_index",$this->data);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function lists(Request $request)
    // {
    //     return $this->category_repo->getDatatable($request);
    // }

    /**
     * Get data for form blade.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFormData()
    // {
    //     $mode = config('constants.form_modes.' . getRouteNameMode() . '.label');
    //     $title = $mode . ' Category';
    //     $module_title = 'categorys';
    //     return [
    //         'header_title' => $title,
    //         'breadcrumbs'  => [
    //             'module'       => $module_title,
    //             'module_route' => 'category.index',
    //             'title'        => $title,
    //         ],
    //     ];
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $this->data = $this->getFormData();
    //     return view("categorys.category_form", $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        // 驗證
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->category_repo->save($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Error:'.$e);
            // $this->errorlog_repo->saveError($e);
            return redirect()->back()->with('error', true);
        }

        // if ($request->continue)
        //     return redirect()->back()->with('success', true);
        return redirect()->route('home.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Category $category)
    // {
    //     $this->data = $this->getFormData();
    //     $this->data['row'] = $category;
    //     $this->data['route_index'] = route('category.index');
    //     return view("categorys.category_form", $this->data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Category $category)
    // {
        
    //     $this->data['row'] = $category;
    //     // dd($this->data);
    //     return view("categorys.category_form", $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            if (isset($data['delete'])) {
                $category->delete();
            }else{
                $category->update($data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info('Error:'.$e);
            // $this->errorlog_repo->saveError($e);
            return redirect()->back()->with('error', true);
        }

        // if ($request->continue)
        //     return redirect()->back()->with('success', true);
        return redirect()->route('home.index')->with('success', true);
    }
    public function data(Request $request) {
        return $this->category_repo->getById($request->id);
    }
}
