<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use App\Like;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = Auth::user()->id;
        // $data=Products::all();
        // $data = Post::all();
        $data = Post::
        leftjoin('users', 'posts.user_id', '=', 'users.id')
        ->leftJoin('likes', 'likes.post_id' , '=', 'posts.id')
        ->leftjoin('comments', 'posts.id', '=', 'comments.post_id')
        ->select(
            'posts.*',
            // 'posts.user_id',
            // 'posts.content',
            'users.name',
            DB::raw('count(distinct(likes.id)) as likes'),
            DB::raw('count(distinct(comments.id)) as comments'),
            DB::raw('sum(distinct(CASE WHEN likes.user_id = '.$userId.' THEN 1 ELSE 0 END)) AS is_liked'))
            // DB::raw('count(distinct(CASE WHEN likes.user_id = '.$userId.' THEN 1 ELSE 0 END AS is_liked)'))
        ->groupBy('posts.id')
        // ->orderBy('created_at', 'DESC')
        // ->skip(0)->take(10)
        ->get();
        // return $data;
        return view('posts',compact('data'));
    }

    public function detail($id)
    {
        $userId = Auth::user()->id;
        $userName = Auth::user()->name;
        // return $userName;
        // return $userid;

        $data=Post::where('posts.id',$id)
        ->join('users', 'posts.user_id','=','users.id')
        ->select('posts.*','users.name')
        ->get();
        
        $likes = Like::where('post_id', $id)
        ->count();
        // return $likes;

        $isLiked = Like::where('post_id', $id)
        ->where('user_id',$userId)
        ->count();

        $comments = Comment::where('post_id', $id)
        ->join('users', 'comments.user_id','=','users.id')
        ->select('comments.*','users.name')
        ->get();
        // return $comments;
        // return $data;
        // $detail = $data[0];
        return view('post/detail',compact('data', 'likes', 'isLiked', 'comments', 'userName'));

    }

    public function new()
    {
        return view('newpost');
    }

    public function like(Request $request){
        $userId = Auth::user()->id;
        // return $request->all();
        $data=new Like();
        $data->user_id = $userId;
        $data->post_id = $request->get('post_id');
        $data->save();  
        return null;
    }

    public function comment(Request $request){
        $userId = Auth::user()->id;
        // return $request->all();
        $data=new Comment();
        $data->user_id = $userId;
        $data->post_id = $request->get('post_id');
        $data->comment = $request->get('comment');
        $data->save();  
        return null;
    }

    
    public function insert(Request $request){
        $userId = Auth::user()->id;
        
        $file = $request->file('picture');
        $base64 = 'data:image/jpeg;base64,'.base64_encode(file_get_contents($file->getRealPath()));
        
        $data=new Post();
        $data->user_id = $userId;
        $data->content=$request->get('content');
        $data->image=$base64;
        $data->save();
        return redirect ('/posts');
      }
  
}
