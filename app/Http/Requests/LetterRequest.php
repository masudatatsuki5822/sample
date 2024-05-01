<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LetterRequest extends FormRequest
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
            //お便り投稿のバリデーション
            'class_id' => 'required',
            'title' => 'required',
            'body' =>'required',
            'image' =>'image|max:1024'
        ];
    }

    public function messages(): array
    {
        return[
            //エラー分
            'class_id.required' => '送信先のクラス選択は必須です。',
            'title.required' => 'タイトルは必須です。',
            'body.required' => '本文は必須です。',
        ];
    }

}
