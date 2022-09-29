<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function profile(){
        return view('users.profile');
    }

    public function search(){
        $user_id = Auth::id();
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        $follower = DB::table('follows')->where("follower_id",$user_id);
        $follower_number = $follower->count();

        return view('users.search',compact("follow_number","follower_number"));
    }
}
