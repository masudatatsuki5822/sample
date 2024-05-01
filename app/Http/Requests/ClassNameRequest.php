<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\NullableIfAnyFieldExists;

class ClassNameRequest extends FormRequest
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
            //クラス登録のバリデーション
            'classname' => 'required|string|max:30',
            'teacher' => 'required|string|max:30'
        ];
    }
    public function messages(): array
    {
        return [
            //エラー分
            'classname.required' => 'クラス名は必須入力です。',
            'classname.max' => 'クラス名は30文字以内でご入力ください。',
            'teacher.required' => 'クラス担任は必須入力です。',
            'teacher.max' => 'クラス担任はでご入力ください。',
        ];
    }
}
