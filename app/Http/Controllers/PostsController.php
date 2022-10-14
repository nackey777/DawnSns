<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
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
        list($follow_number,$follower_number) = $this->getFollowNumber();

        $user = DB::table('users')
            ->where("id",$user_id)
            ->first();

        $posts = DB::table("posts")
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.user_id',
                'posts.post',
                'posts.created_at',
                'users.id',
                'users.username',
                'users.image',
            )
            ->whereIn("posts.user_id",function($query) use($user_id){
                $query
                    -> select('follower_id')
                    -> from('follows')
                    -> where('follow_id',$user_id);
            })
            ->orwhere("user_id",$user_id)
            ->latest()
            ->get();

        return view('posts.index',compact("follow_number","follower_number","user","posts"));
    }

    public function post(Request $request){
        $data = $request->input();
        $this->create($data);
        return redirect('top');
    }

    public function profile(){
        $user_id = Auth::id();
        list($follow_number,$follower_number) = $this->getFollowNumber();

        $user = DB::table('users')
            ->where("id",$user_id)
            ->first();
        return view("posts.profile",compact("follow_number","follower_number","user"));
    }

    public function updateProfile(Request $request){
        if($request->file("image")){
            //拡張子付きでファイル名を取得
            $filenameWithExt = $request->file("image")->getClientOriginalName();
            //ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //拡張子を取得
            $extension = $request->file("image")->getClientOriginalExtension();
            //保存のファイル名を構築
            $filenameToStore = $filename."_".time().".".$extension;

            $path = $request
                ->file("image")
                ->storeAs("public/upload", $filenameToStore);

            $user_id = Auth::id();
            User::where("id",$user_id)->update([
                'image' => "/storage/upload/".$filenameToStore,
            ]);
        }

        //update
        $data = $request->input();
        $this->update($data);

        return redirect('profile');
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
        return Post::create([
            'user_id' => $data['user_id'],
            'post' => $data['post'],
        ]);
    }

    protected function update(array $data){
        $user_id = Auth::id();
        if($data['new_password'] == ""){
            $pass = $data['password'];
        } else {
            $pass = bcrypt($data['new_password']);
        }

        return User::where("id",$user_id)->update([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => $pass,
            'bio' => $data['bio'],
        ]);
    }
}
