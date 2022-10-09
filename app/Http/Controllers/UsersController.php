<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function profile($id){
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $user_id = Auth::id();

        $user = DB::table('users')
            ->where("id",$id)
            ->first();

        $is_follow = DB::table('follows')
            ->where("follow_id",$user_id)
            ->where("follower_id",$id)
            ->exists();

        $posts = DB::table("posts")
            ->where("user_id",$id)
            ->latest()
            ->get();
        return view('users.profile',compact("follow_number","follower_number","user","posts","is_follow"));
    }

    public function search(Request $request){
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $follow_ids = DB::table('follows')
            ->where("follow_id",Auth::id())
            ->pluck('follower_id')
            ->toArray();

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

        return view('users.search',compact("follow_number","follower_number","follow_ids","search_word","datas"));
    }

    public function follow(Request $request){
        $data = $request->input();
        $this->create($data);
        return redirect()->back();
    }

    public function unfollow(Request $request){
        $data = Follow::where("follow_id",$request->input("follow_id"))
            ->where("follower_id",$request->input("follower_id"))
            ->delete();
        return redirect()->back();

    }

    protected function getFollowNumber(){
        $user_id = Auth::id();
        $follow = DB::table('follows')->where("follow_id",$user_id);
        $follow_number = $follow->count();
        $follower = DB::table('follows')->where("follower_id",$user_id);
        $follower_number = $follower->count();
        return array($follow_number,$follower_number);
    }

    protected function create(array $data){
        return Follow::create([
            'follow_id' => $data['follow_id'],
            'follower_id' => $data['follower_id'],
        ]);
    }
}
