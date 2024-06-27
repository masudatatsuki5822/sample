<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            //新規登録のバリデーション
            //保育園名
            'name' => 'required|string|max:30',
            //代表者名
            'boss' => 'required|string|max:30',
            //mailのみ被りは不可・空欄不可
            'mail' => 'required|email:filter|unique:nurseries,mail',
            //電話番号は11桁
            'tel' => 'required|numeric|digits_between:8,11',
            //パスワードは8文字以上・空欄不可
            'password' => 'required|string|min:8|confirmed',
            //パスワードは確認用と一致しないと不可・空欄不可
            'password_confirmation' => 'required',
        ];
    }
    public function messages() 
    {
        return [
            //エラー分
            //必須入力
            'name.required' => '保育園名は項目は必須入力です。',
            'boss.required' => '代表者名は項目は必須入力です。',
            'mail.required' => 'メールアドレスは項目は必須入力です。',
            'tel.required' => '電話番号は項目は必須入力です。',
            'password.required' => 'パスワードは項目は必須入力です。',
            'password_confirmation.required' => 'パスワード確認用は項目は必須入力です。',

            //それ以外
            'name.max' => '保育園名は30文字以内でご入力ください。',
            'boss.max' => '代表者名は30文字以内でご入力ください。',
            'mail.email' => 'メールアドレスは正しい形式でご入力ください。',
            'mail.unique' => '入力されたメールアドレスは既に登録されています。',
            'tel.digits_between' => '電話番号は8～11桁でご入力ください',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.confirmed' => 'パスワードが確認用と一致していません。',

        ];
    }
}
