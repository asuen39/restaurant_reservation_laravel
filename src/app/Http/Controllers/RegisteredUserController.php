<?php

namespace App\Http\Controllers;

use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
        $user = $createNewUserAction->create($request->all());

        // メールアドレス確認トークンを生成
        $user->generateEmailVerificationToken();

        // メールの送信
        // Mail::to($user->email)->send(new RegistrationMail($user->email));
        Mail::to($user->email)->send(new RegistrationMail($user));

        // サンクスページにリダイレクト
        return redirect()->route('thanks');
    }

    /* メール認証 */
    public function verify($token)
    {
        // トークンに対応するユーザーを取得
        $user = User::where('email_verification_token', $token)->first();

        // ユーザーが存在すれば、認証ステータスを更新し、データベースに保存
        if ($user) {
            $user->email_verified_at = now();
            $user->save();

            // ユーザーが認証された後のリダイレクト先を返す
            return view('verification.success');
        }

        // ユーザーが存在しない場合はエラーを返す
        abort(404);
    }
}
