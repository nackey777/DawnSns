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
        $user_id = Auth::id();
        $follow_number = $this->getFollowNumber($user_id);
        $follower_number = $this->getFollowerNumber($user_id);

        $posts = DB::table("posts")
            ->where("user_id",$user_id)
            ->leftjoin('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.id', 'users.username', 'users.image')
            ->latest()
            ->get();

        return view('posts.index',compact("follow_number","follower_number","posts"));
    }

    public function post(Request $request){
        $data = $request->input();
        $this->create($data);
        return redirect('top');
    }

    protected function getFollowNumber(int $user_id){
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        return $follow_number;
    }

    protected function getFollowerNumber(int $user_id){
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
