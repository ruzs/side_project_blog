<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Post;
use App\Repositories\PostRepository;
use App\Entities\Category;
use App\Repositories\CategoryRepository;
use App\Entities\User;
use App\Repositories\UserRepository;
use App\Entities\Role;
use App\Repositories\RoleRepository;

class ShareholderController extends Controller
{
    private $data;
    private $post_repo;
    private $category_repo;
    private $user_repo;
    private $role_repo;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $post_repo,
                                CategoryRepository $category_repo,
                                UserRepository $user_repo,
                                RoleRepository $role_repo)
    {
        // $this->middleware('auth');
        $this->post_repo        = $post_repo;
        $this->category_repo   = $category_repo;
        $this->user_repo   = $user_repo;
        $this->role_repo   = $role_repo;
    }

    public function index()
    {
        
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> "",
            'points'=> "",
            'shareholders'=>$this->user_repo->getByUserRole()
        ];
        return view('shareholder', $this->data);
    }
    public function store(Request $request)
    {
        // $this->data=[
        //     'bg'=>'assets/img/post-bg.jpg',
        //     'row'=> "",
        //     'points'=> "",
        // ];
        // return view('shareholder',$this->data);
    }
}
