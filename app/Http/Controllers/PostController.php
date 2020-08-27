<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data=Products::all();
        $data = Post::all();
        return $data;
        // return view('posts',compact('data'));
    }

    public function new()
    {
        return 'Sayang';
    }
}
