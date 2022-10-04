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
        return view('follows.followList',compact("follow_number","follower_number"));
    }

    public function followerList(){
        list($follow_number,$follower_number) = $this->getFollowNumber();
        return view('follows.followerList',compact("follow_number","follower_number"));
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
