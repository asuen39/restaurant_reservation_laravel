<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'string',
                'max:191',
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
            'email.required' => 'メールアドレスを入力してください',
            'email.string' => 'メールアドレスを文字列で入力してください',
            'email.email' => '有効なメールアドレス形式を入力してください',
            'email.max' => 'メールアドレスは191文字以下でなければなりません。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードを文字列で入力してください',
            'password.min' => 'パスワードは8文字以上でなければなりません。',
            'password.max' => 'パスワードは191文字以下でなければなりません。',
        ];
    }
}
