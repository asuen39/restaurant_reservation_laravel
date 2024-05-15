<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
            ],
            'email' => [
                'required',
                'email',
                'string',
                'max:191',
                Rule::unique('users')->ignore($this->user), // 重複を許さない（新規登録用の場合）
            ],
            'password' => [
                'required',
                'string',
                'min:8', // 8文字以上
                'max:191', // 191文字以内
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前を入力してください',
            'name.string' => '名前を文字列で入力してください',
            'name.max' => '名前は191文字以下でなければなりません。',
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'email.max' => 'メールアドレスは191文字以下でなければなりません。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードを文字列で入力してください',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.max' => 'パスワードは191文字以下でなければなりません。',
        ];
    }
}
