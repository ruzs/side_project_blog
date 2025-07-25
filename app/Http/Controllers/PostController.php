<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Entities\Post;
use App\Repositories\PostRepository;
use App\Repositories\CategoryRepository;
// use App\Repositories\ErrorLogRepository;

use App\Http\Requests\PostFormRequest;

class PostController extends Controller
{

    private $data;
    private $log_name;
    private $post_repo;
    private $category_repo;
    // private $errorlog_repo;

    public function __construct(PostRepository $post_repo,
                                CategoryRepository $category_repo
                                // ErrorLogRepository $errorlog_repo
    )
    {
        $this->log_name         = 'Post';
        $this->post_repo        = $post_repo;
        $this->category_repo   = $category_repo;
        // $this->errorlog_repo    = $errorlog_repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view("posts.post_index",$this->data);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    // public function lists(Request $request)
    // {
    //     return $this->post_repo->getDatatable($request);
    // }

    /**
     * Get data for form blade.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getFormData()
    // {
    //     $mode = config('constants.form_modes.' . getRouteNameMode() . '.label');
    //     $title = $mode . ' Post';
    //     $module_title = 'posts';
    //     return [
    //         'header_title' => $title,
    //         'breadcrumbs'  => [
    //             'module'       => $module_title,
    //             'module_route' => 'post.index',
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
    //     return view("posts.post_form", $this->data);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
        // 驗證
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $this->post_repo->save($data);
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
    // public function show(Post $post)
    // {
    //     $this->data = $this->getFormData();
    //     $this->data['row'] = $post;
    //     $this->data['route_index'] = route('post.index');
    //     return view("posts.post_form", $this->data);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Post $post)
    // {
        
    //     $this->data['row'] = $post;
    //     // dd($this->data);
    //     return view("posts.post_form", $this->data);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostFormRequest $request, Post $post)
    {
        $data = $request->validated();
        
        DB::beginTransaction();
        try {
            if (isset($data['delete'])) {
                if ($post->created_by == auth()->user()->id || auth()->user()->id == 1) {
                    $post->delete();
                }
            }else{
                $post->update($data);
            }
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
    public function data(Request $request) {
        $this->data=[
            'row'=>$this->post_repo->getById($request->id),
            'categories'=>$this->category_repo->getAll(),
        ];
        return $this->data;
    }
}
