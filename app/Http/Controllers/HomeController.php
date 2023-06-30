<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Post;
use App\Repositories\PostRepository;
use App\Entities\Category;
use App\Repositories\CategoryRepository;

class HomeController extends Controller
{
    private $data;
    private $post_repo;
    private $category_repo;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $post_repo,CategoryRepository $category_repo)
    {
        // $this->middleware('auth');
        $this->post_repo        = $post_repo;
        $this->category_repo   = $category_repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() 
    {
        $rows=$this->post_repo->getAllPost();
        $this->data=[
            'bg'=>'assets/img/home-bg.jpg',
            'rows'=> $rows,
        ];
        return view('index',$this->data);
    }
    public function index()
    {
        $rows=$this->post_repo->getAllPost();
        $categories=$this->category_repo->getAllCategory();
        $this->data=[
            'bg'=>'assets/img/about-bg.jpg',
            'rows'=> $rows,
            'categories'=>$categories,
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
}
