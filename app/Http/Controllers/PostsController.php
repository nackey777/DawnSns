<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user_id = Auth::id();
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $user =  $this->getUser();
        $posts = $this->getUserAndFollowerPosts();
        return view('posts.index',compact("follow_number","follower_number","user","posts"));
    }

    public function post(Request $request){
        $this->postValidator($request->all(), 'posts')->validate();
        $data = $request->input();
        $this->create($data);
        return redirect('top');
    }

    public function updatePost(Request $request){
        $this->postValidator($request->all(), 'posts')->validate();
        $data = $request->input();
        $this->updatePostData($data);
        return redirect('top');
    }

    public function deletePost($id){
        $data = Post::where("id",$id)->delete();
        return redirect('top');
    }

    public function profile(){
        $user_id = Auth::id();
        list($follow_number,$follower_number) = $this->getFollowNumber();
        $user =  $this->getUser();
        return view("posts.profile",compact("follow_number","follower_number","user"));
    }

    public function updateProfile(Request $request){
        $this->validator($request->all(), 'users')->validate();
        $this->updateImage($request->file("image"));
        $data = $request->input();
        $this->update($data);
        return redirect('profile');
    }



    protected function getUser(){
        $user_id = Auth::id();
        return DB::table('users')
            ->where("id",$user_id)
            ->first();
    }

    protected function getUserAndFollowerPosts(){
        $user_id = Auth::id();
        return DB::table("posts")
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select(
                'posts.id',
                'posts.user_id',
                'posts.post',
                'posts.created_at',
                // 'users.id',
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

    protected function updateImage($image){
        if($image){
            //拡張子付きでファイル名を取得
            $filenameWithExt = $image->getClientOriginalName();
            //ファイル名のみを取得
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //拡張子を取得
            $extension = $image->getClientOriginalExtension();
            //保存のファイル名を構築
            $filenameToStore = $filename."_".time().".".$extension;

            $path = $image->storeAs("public/upload", $filenameToStore);

            $user_id = Auth::id();
            User::where("id",$user_id)->update([
                'image' => "/storage/upload/".$filenameToStore,
            ]);
        }
    }

    protected function updatePostData(array $data){
        return Post::where("id",$data['id'])->update([
            'post' => $data['post'],
        ]);
    }

    protected function postValidator(array $data){
        return Validator::make($data,
            [
                'post' => ['required','max:150'],
            ],
            [
                'post.max' => '※150文字以下で入力してください',
            ]
        );
    }

    protected function validator(array $data){
        return Validator::make($data,
            [
                'username' => ['required', 'min:4', 'max:12'],
                'mail' => ['required', 'min:4', 'max:12', Rule::unique('users')->ignore(Auth::id())],
                'new_password' => ['sometimes', 'nullable', 'regex:/^[a-zA-Z0-9]+$/', 'min:4', 'max:12'],
                'bio' => ['max:200'],
                'image' => ['mimes:jpg,png,bmp,gif,svg'],
            ],
            [
                'username.required' => '※必須項目です',
                'username.min' => '※4文字以上で入力してください',
                'username.max' => '※12文字以下で入力してください',

                'mail.required' => '※必須項目です',
                'mail.min' => '※4文字以上で入力してください',
                'mail.max' => '※12文字以下で入力してください',
                'mail.unique' => '※すでに登録されているメールアドレスです',

                'new_password.regex' => '※半角英数字で入力してください',
                'new_password.min' => '※4文字以上で入力してください',
                'new_password.max' => '※12文字以下で入力してください',

                'bio.max' => '※200文字以下で入力してください',

                'image.mimes' => '※登録できる画像の形式はjpg・png・bmp・gif・svgです',
            ]
        );
    }
}
