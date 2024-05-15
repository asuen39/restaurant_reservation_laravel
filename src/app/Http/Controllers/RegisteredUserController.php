<?php

namespace App\Http\Controllers;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    /* 新規ユーザー登録画面表示 */
    public function register()
    {
        return view('auth.register');
    }

    /* ユーザーを登録 */
    public function create(RegisterRequest $request)
    {
        // 新規ユーザー作成アクション機能を取得
        $createNewUserAction = app(CreatesNewUsers::class);

        // ユーザーを作成するアクション機能を呼び出してユーザーを登録
        $createNewUserAction->create($request->all());

        // サンクスページにリダイレクト
        return redirect()->route('thanks');
    }
}
