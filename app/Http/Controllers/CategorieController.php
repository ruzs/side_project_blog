<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Entities\Categorie;
use App\Repositories\CategorieRepository;
// use App\Repositories\ErrorLogRepository;

use App\Http\Requests\CategorieFormRequest;

class CategorieController extends Controller
{

    private $data;
    private $log_name;
    private $categorie_repo;
    // private $errorlog_repo;

    public function __construct(CategorieRepository $categorie_repo
                                // ErrorLogRepository $errorlog_repo
    )
    {
        $this->log_name         = 'Categorie';
        $this->categorie_repo        = $categorie_repo;
        // $this->errorlog_repo    = $errorlog_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view("categories.categorie_index",$this->data);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function lists(Request $request)
    // {
    //     return $this->categorie_repo->getDatatable($request);
    // }

    /**
     * Get data for form blade.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFormData()
    // {
    //     $mode = config('constants.form_modes.' . getRouteNameMode() . '.label');
    //     $title = $mode . ' Categorie';
    //     $module_title = 'categories';
    //     return [
    //         'header_title' => $title,
    //         'breadcrumbs'  => [
    //             'module'       => $module_title,
    //             'module_route' => 'categorie.index',
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
    //     return view("categories.categorie_form", $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategorieFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategorieFormRequest $request)
    {
        // 驗證
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->categorie_repo->save($data);
            DB::commit();
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
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
    // public function show(Categorie $categorie)
    // {
    //     $this->data = $this->getFormData();
    //     $this->data['row'] = $categorie;
    //     $this->data['route_index'] = route('categorie.index');
    //     return view("categories.categorie_form", $this->data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Categorie $categorie)
    // {
        
    //     $this->data['row'] = $categorie;
    //     // dd($this->data);
    //     return view("categories.categorie_form", $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategorieFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategorieFormRequest $request, Categorie $categorie)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            if (isset($data['delete'])) {
                $categorie->delete();
            }else{
                $categorie->update($data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // $this->errorlog_repo->saveError($e);
            return redirect()->back()->with('error', true);
        }

        // if ($request->continue)
        //     return redirect()->back()->with('success', true);
        return redirect()->route('home.index')->with('success', true);
    }
    public function data(Request $request) {
        return $this->categorie_repo->getCategorie($request->id);
    }
}
