<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/added';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,
            [
                'username' => ['required', 'min:4', 'max:12'],
                'mail' => ['required', 'min:4', 'max:12', 'unique:users,mail'],
                'password' => ['required','regex:/^[a-zA-Z0-9]+$/', 'min:4', 'max:12'],
                'password-confirm' => ['required', 'regex:/^[a-zA-Z0-9]+$/', 'min:4', 'max:12', 'same:password'],
            ],
            [
                'username.required' => '※必須項目です',
                'username.min' => '※4文字以上で入力してください',
                'username.max' => '※12文字以下で入力してください',

                'mail.required' => '※必須項目です',
                'mail.min' => '※4文字以上で入力してください',
                'mail.max' => '※12文字以下で入力してください',
                'mail.unique' => '※すでに登録されているメールアドレスです',

                'password.required' => '※必須項目です',
                'password.regex' => '※半角英数字で入力してください',
                'password.min' => '※4文字以上で入力してください',
                'password.max' => '※12文字以下で入力してください',

                'password-confirm.required' => '※必須項目です',
                'password-confirm.regex' => '※半角英数字で入力してください',
                'password-confirm.min' => '※4文字以上で入力してください',
                'password-confirm.max' => '※12文字以下で入力してください',
                'password-confirm.same' => '※パスワードと確認用パスワードが一致していません',

                //MEMO
                //ハッシュ化されているのでパスワードはDBの値と比較しても一致しない
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'mail' => $data['mail'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function register(Request $request){
        if($request->isMethod('post')){
            $this->validator($request->all(), 'users')->validate();
            $data = $request->input();
            $this->create($data);
            return redirect()->action('Auth\RegisterController@added', ['username' => $request->input("username")]);
        }
        return view('auth.register');
    }

    public function added(Request $request){
        $username = $request->get("username");
        return view("auth.added",compact("username"));
    }
}
