<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            //連絡帳投稿のバリデーション
            'back_time' => 'required',
            'person' => 'required',
            'temp' => 'required',
            'breakfast' => 'required',
            'comment' => 'nullable',
        ];
    }
    public function messages(): array
    {
        return[
            'back_time.required' => 'お迎え時刻は必須入力です。',
            'person.required' => 'お迎えする方は必須入力です。',
            'temp.required' => '体温は必須入力です。',
            'breakfast.required' => '朝食は必須入力です。',
        ];
    }
}
