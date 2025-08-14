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
use App\Entities\Point;
use App\Repositories\PointRepository;

class HomeController extends Controller
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
                                PointRepository $point_repo,
                                RoleRepository $role_repo)
    {
        // $this->middleware('auth');
        $this->post_repo        = $post_repo;
        $this->category_repo   = $category_repo;
        $this->user_repo   = $user_repo;
        $this->role_repo   = $role_repo;
        $this->point_repo   = $point_repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() 
    {
        $rows=$this->post_repo->getAll();
        $this->data=[
            'bg'=>'assets/img/home-bg.jpg',
            'rows'=> $rows,
        ];
        return view('index',$this->data);
    }
    
    public function index()
    {
        if (auth()->user()->id ==1) {
            $rows=$this->post_repo->getAll();
            $categories=$this->category_repo->getAll();
            $user_roles = $this->role_repo->getAll();
        }else{
            $rows=$this->post_repo->getByUserId(auth()->user()->id);
            $categories=$this->category_repo->getByUserId(auth()->user()->id);
            $user_roles = $this->role_repo->getByNotProtect();
        }
        
        $shareholders = $this->user_repo->getByHasRole();

        $this->data = [
            'bg'            => 'assets/img/about-bg.jpg',
            'rows'          => $rows,
            'categories'    => $categories,
            'posts'         => $this->post_repo->getAll(),
            'users'         => $this->user_repo->getAll(),
            'user'          => $this->user_repo->getById(auth()->user()->id),
            'roles'         => $this->role_repo->getAll(),
            'user_roles'    => $user_roles,
            'points'        => $this->point_repo->getByGroupCount(),
            'shareholders'  => $shareholders
        ];
        return view('home',$this->data);
    }
    public function show(Post $home)
    {
        $home->content=nl2br($home->content,true);
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> $home,
        ];
        return view('posts.post_index', $this->data);
    }
    
    public function shareholder()
    {
        
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> "",
        ];
        return view('shareholder', $this->data);
    }
}
