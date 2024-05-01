<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            //ログインのバリデーション
            'mail' => 'required|email:filter',
            'password' => 'required',
        ];
    }

    public function messages() 
    {
        return [
            'mail.required' => 'メールアドレスは必須入力です。',
            'mail.email' => 'メールアドレスは正しい形式でご入力ください。',
            'password.required' => 'パスワードは必須入力です。'
        ];
    }
}
