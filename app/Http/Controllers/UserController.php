<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Entities\User;
use App\Repositories\UserRepository;
// use App\Repositories\ErrorLogRepository;

use App\Http\Requests\UserFormRequest;

class UserController extends Controller
{

    private $data;
    private $log_name;
    private $user_repo;
    // private $errorlog_repo;

    public function __construct(UserRepository $user_repo
                                // ErrorLogRepository $errorlog_repo
    )
    {
        $this->log_name         = 'User';
        $this->user_repo        = $user_repo;
        // $this->errorlog_repo    = $errorlog_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view("users.user_index",$this->data);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function lists(Request $request)
    // {
    //     return $this->user_repo->getDatatable($request);
    // }

    /**
     * Get data for form blade.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFormData()
    // {
    //     $mode = config('constants.form_modes.' . getRouteNameMode() . '.label');
    //     $title = $mode . ' User';
    //     $module_title = 'users';
    //     return [
    //         'header_title' => $title,
    //         'breadcrumbs'  => [
    //             'module'       => $module_title,
    //             'module_route' => 'user.index',
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
    //     return view("users.user_form", $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UserFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        // 驗證
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if (!@$data['email']) {
                $data['email'] = $data['account']."@".$data['password'];
            }
            $data['password'] = Hash::make($data['password']);
            $user = $this->user_repo->save($data);
            $user->syncRoles(@$data['role']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
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
    // public function show(User $user)
    // {
    //     $this->data = $this->getFormData();
    //     $this->data['row'] = $user;
    //     $this->data['route_index'] = route('user.index');
    //     return view("users.user_form", $this->data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
        
    //     $this->data['row'] = $user;
    //     // dd($this->data);
    //     return view("users.user_form", $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $user)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            if ($user->created_by == auth()->user()->id || auth()->user()->id == 1) {
                if (isset($data['delete'])) {
                    $user->delete();
                }else{
                    if (!@$data['password']) {
                        unset($data['password']);
                    }
                    $role=@$data['role'];
                    unset($data['role']);
                    $user->update($data);
                    // $user->syncRoles(@$role);
                    if ($role) {
                        $userRole=[
                            "role_id"   => $role,
                            'model_type'=> 'App\\Entities\\User',
                            'user_id'   => $user->id,
                        ];
    
                        $exists = DB::table('user_has_roles')
                        // ->where('role_id', $userRole['role_id'])
                        // ->where('model_type',  $userRole['model_type'])
                        ->where('user_id', $userRole['user_id'])
                        ->exists();
                        if ($exists) {
                            DB::table('user_has_roles')
                            ->where('user_id', $userRole['user_id'])
                            ->update($userRole);
                        }else{
                            DB::table('user_has_roles')->insert($userRole);
                        }
                    }
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            // $this->errorlog_repo->saveError($e);
            if (@$data['is_ajax_form']) {
                return response()->json([
                    "success" => false,
                    "message" => @$e->getMessage(),
                ]);
            }
            return redirect()->back()->with('error', true);
        }

        // if ($request->continue)
        //     return redirect()->back()->with('success', true);
        return redirect()->route('home.index')->with('success', true);
    }
    
    public function data(Request $request) {
        return $this->user_repo->getById($request->id);
    }
}
