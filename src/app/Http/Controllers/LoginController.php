<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /* ログイン画面表示 */
    public function login()
    {
        return view('auth.login');
    }

    /* ログイン処理 */
    public function postLogin(LoginRequest $request)
    {
        // バリデーションは RegisterRequest で自動的に実行される。
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // ログイン成功時のリダイレクト先を指定
            return redirect()->intended('/');
        }

        // ログインに失敗した場合は、エラーメッセージを追加してログイン画面にリダイレクト
        return back()->withInput()->withErrors([
            'login_error' => 'メールアドレスまたはパスワードが正しくありません。',
        ]);
    }

    //ログアウト処理
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();

        return redirect()->route('login');
    }
}
