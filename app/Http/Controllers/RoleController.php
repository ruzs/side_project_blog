<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Entities\Role;
use App\Repositories\RoleRepository;
// use App\Repositories\ErrorLogRepository;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\RoleFormRequest;

class RoleController extends Controller
{

    private $data;
    private $log_name;
    private $role_repo;
    // private $errorlog_repo;

    public function __construct(RoleRepository $role_repo
                                // ErrorLogRepository $errorlog_repo
    )
    {
        $this->log_name         = 'Role';
        $this->role_repo        = $role_repo;
        // $this->errorlog_repo    = $errorlog_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view("roles.role_index",$this->data);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function lists(Request $request)
    // {
    //     return $this->role_repo->getDatatable($request);
    // }

    /**
     * Get data for form blade.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFormData()
    // {
    //     $mode = config('constants.form_modes.' . getRouteNameMode() . '.label');
    //     $title = $mode . ' Role';
    //     $module_title = 'roles';
    //     return [
    //         'header_title' => $title,
    //         'breadcrumbs'  => [
    //             'module'       => $module_title,
    //             'module_route' => 'role.index',
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
    //     return view("roles.role_form", $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleFormRequest $request)
    {
        // 驗證
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $role = $this->role_repo->save($data);
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
    // public function show(Role $role)
    // {
    //     $this->data = $this->getFormData();
    //     $this->data['row'] = $role;
    //     $this->data['route_index'] = route('role.index');
    //     return view("roles.role_form", $this->data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Role $role)
    // {
        
    //     $this->data['row'] = $role;
    //     // dd($this->data);
    //     return view("roles.role_form", $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleFormRequest $request, Role $role)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            if ($role->created_by == auth()->user()->id || auth()->user()->id == 1) {
                if (isset($data['delete'])) {
                    $role->delete();
                }else{
                    $role->update($data);
                }
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
        return $this->role_repo->getById($request->id);
    }
}
