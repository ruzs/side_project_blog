<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Post;
use App\Repositories\PostRepository;

class HomeController extends Controller
{
    private $data;
    private $post_repo;
    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $post_repo)
    {
        $this->middleware('auth');
        $this->post_repo        = $post_repo;
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
        // dd($this->data['rows'][0]->creator->name);
        return view('index',$this->data);
    }
    public function index()
    {
        $rows=$this->post_repo->getAllPost();
        $this->data=[
            'bg'=>'assets/img/about-bg.jpg',
            'rows'=> $rows,
        ];
        return view('home',$this->data);
    }
    public function show(Post $home)
    {
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> $home,
        ];
        return view('posts.post_index', $this->data);
    }
}
