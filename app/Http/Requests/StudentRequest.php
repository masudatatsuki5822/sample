<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //生徒登録のバリデーション
            //生徒名
            'studentname' => 'required|string|max:30',
            //mail空欄不可・形式
            'mail' => 'required|email:filter',
            //電話番号は11桁
            'tel' => 'required|numeric|digits_between:8,11',
            //パスワードは8文字以上・空欄不可
            'password' => 'required|string|min:8',
        ];
    }

    public function messages() 
    {
        return [
            //必須入力
            'studentname.required' => '生徒名は項目は必須入力です。',
            'mail.required' => 'メールアドレスは項目は必須入力です。',
            'tel.required' => '電話番号は項目は必須入力です。',
            'password.required' => 'パスワードは項目は必須入力です。',

            //それ以外
            'studentname.max' => '生徒名は30文字以内でご入力ください。',
            'mail.email' => 'メールアドレスは正しい形式でご入力ください。',
            'tel.digits_between' => '電話番号は8～11桁でご入力ください',
            'password.min' => 'パスワードは8文字以上で入力してください。',
        ];
    }
}
