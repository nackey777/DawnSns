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

    public function search(Request $request){
        $user_id = Auth::id();
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        $follower = DB::table('follows')->where("follower_id",$user_id);
        $follower_number = $follower->count();

        if($request->isMethod('post')){
            $search_word = $request->input("search_username");
            $datas = DB::table("users")
                ->where("username","like","%$search_word%")
                ->latest()
                ->get();
        } else {
            $search_word = "";
            $datas = DB::table("users")
                ->latest()
                ->get();
        }

        return view('users.search',compact("follow_number","follower_number","datas","search_word"));
    }
}
