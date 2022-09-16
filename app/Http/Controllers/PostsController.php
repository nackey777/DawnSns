<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user_id = Auth::id();

        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follower = DB::table('follows')->where("follower_id",$user_id);

        $follow_number = $follow->count();
        $follower_number = $follower->count();

        return view('posts.index',compact("follow_number","follower_number"));
    }
}
