<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteStoreRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'يرجى إدخال عنوان الملاحظة.',
            'title.string' => 'يجب أن يكون عنوان الملاحظة نصًا.',
            'title.max' => 'يجب أن لا يتجاوز عنوان الملاحظة 255 حرفًا.',
            'content.required' => 'يرجى إدخال محتوى الملاحظة.',
            'content.string' => 'يجب أن يكون محتوى الملاحظة نصًا.',
        ];
    }
}
