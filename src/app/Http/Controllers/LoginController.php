<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /* ログイン画面表示 */
    public function login()
    {
        return view('auth.login');
    }

    /* ログイン処理 */
    public function postLogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // ログイン成功時のリダイレクト先を指定
            return redirect()->to('/');
        }

        // ログインに失敗した場合は、エラーメッセージを追加してログイン画面にリダイレクト
        return back()->withErrors([
            'email' => 'ログイン出来ませんでした。',
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
