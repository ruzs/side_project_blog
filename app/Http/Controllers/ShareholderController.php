<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Post;
use App\Repositories\PostRepository;
use App\Entities\Category;
use App\Repositories\CategoryRepository;

class ShareholderController extends Controller
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

    public function index()
    {
        
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> "",
            'points'=> "",
        ];
        return view('shareholder', $this->data);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $this->data=[
            'bg'=>'assets/img/post-bg.jpg',
            'row'=> "",
            'points'=> "",
        ];
        return view('shareholder',$this->data);
    }
}
