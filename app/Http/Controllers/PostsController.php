<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $follow_number = $this->getFollowNumber();
        $follower_number = $this->getFollowerNumber();

        return view('posts.index',compact("follow_number","follower_number"));
    }

    public function post(Request $request){
        $data = $request->input();
        $this->create($data);
        $follow_number = $this->getFollowNumber();
        $follower_number = $this->getFollowerNumber();
        return redirect('top');
    }

    protected function getFollowNumber(){
        $user_id = Auth::id();
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        return $follow_number;
    }

    protected function getFollowerNumber(){
        $user_id = Auth::id();
        $follower = DB::table('follows')->where("follower_id",$user_id);
        $follower_number = $follower->count();
        return $follower_number;
    }

    protected function create(array $data){
        return Post::create([
            'user_id' => $data['user_id'],
            'post' => $data['post'],
        ]);
    }
}
