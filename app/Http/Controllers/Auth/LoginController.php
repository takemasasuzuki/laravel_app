<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;  // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

     protected $maxAttempts = 3;     // ログイン試行回数（回）

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/todo';//'/home' から変更ログインした後の遷移先を/todoに

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');//コントローラーのメソッドを除外,ログインユーザーはlogout以外の処理を行う場合/homeへ
    }
    // ここから追記　logout後の遷移先を指定
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
