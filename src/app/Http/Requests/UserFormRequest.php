<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
            'reservation_date' => 'required', // 選択が必須であることを指定
            'reservation_time' => 'required', // 選択が必須であることを指定
            'reservation_number' => 'required', // 選択が必須であることを指定
        ];
    }

    public function messages()
    {
        return [
            'reservation_date.required' => '予約日時を選択してください。', // 選択が必須であることを示すメッセージ
            'reservation_time.required' => '予約する時間帯を選択してください。', // 選択が必須であることを示すメッセージ
            'reservation_number.required' => '予約人数を選択してください。', // 選択が必須であることを示すメッセージ
        ];
    }
}
