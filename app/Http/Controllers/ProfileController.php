<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Post;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $userId = Auth::user()->id;
        $profile = User::where('id', $userId)->get();
        $profile = $profile[0];
        // return $profile;
        $posts = Post::where('user_id', $userId)->get();
        return view('profile/index', compact('profile','posts'));
    }
    
    public function profile($id){
        $profile = User::where('id', $id)->get();
        $profile = $profile[0];
        // return $profile;
        $posts = Post::where('user_id', $id)->get();
        return view('profile/profile', compact('profile','posts'));
    }
}
