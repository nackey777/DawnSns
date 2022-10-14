<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function followList(){
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $user_id = Auth::id();
        $datas = DB::table("follows")
            ->join('users', 'follows.follower_id', '=', 'users.id')
            ->select(
                'follows.follower_id',
                'follows.created_at',
                'users.image',
            )
            ->where("follow_id",$user_id)
            ->latest()
            ->get();

        $posts = DB::table("posts")
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.user_id',
                'posts.post',
                'posts.created_at',
                'users.username',
                'users.image',
            )
            ->whereIn("posts.user_id",function($query) use($user_id){
                $query
                    -> select('follower_id')
                    -> from('follows')
                    -> where('follow_id',$user_id);
            })
            ->latest()
            ->get();
        return view('follows.followList',compact("follow_number","follower_number","datas","posts"));
    }

    public function followerList(){
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $user_id = Auth::id();
        $datas = DB::table("follows")
            ->join('users', 'follows.follow_id', '=', 'users.id')
            ->select(
                'follows.follow_id',
                'follows.created_at',
                'users.image',
            )
            ->where("follower_id",$user_id)
            ->latest()
            ->get();

        $posts = DB::table("posts")
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.user_id',
                'posts.post',
                'posts.created_at',
                'users.username',
                'users.image',
            )
            ->whereIn("posts.user_id",function($query) use($user_id){
                $query
                    -> select('follow_id')
                    -> from('follows')
                    -> where('follower_id',$user_id);
            })
            ->latest()
            ->get();
        return view('follows.followerList',compact("follow_number","follower_number","datas","posts"));
    }

    protected function getFollowNumber(){
        $user_id = Auth::id();
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        $follower = DB::table('follows')->where("follower_id",$user_id);
        $follower_number = $follower->count();
        return array($follow_number,$follower_number);
    }

}
