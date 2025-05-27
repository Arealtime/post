<?php

namespace Arealtime\Post\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'caption' => ['nullable', 'max:500'],
            'location' => ['nullable', 'string', 'max:100'],
            'posted_at' => ['nullable', 'date', 'after_or_equal:now'],
            'attachments' => ['required', 'array'],
            'attachments.*' => ['file', 'mimes:jpeg,jpg,png,gif,mp4,mov,avi,wmv', 'max:10240'],
        ];
    }
}
