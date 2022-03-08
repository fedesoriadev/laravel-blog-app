<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'user_id'      => 'required|int|exists:users,id',
            'title'        => 'required|string',
            'slug'         => [
                'required',
                'string',
                'regex:/^[a-z0-9_-]+$/i',
                Rule::unique('posts', 'slug')->ignore($this->post?->id)
            ],
            'published_at' => 'date',
            'image'        => 'image|max:2048',
            'excerpt'      => 'string',
            'body'         => 'required'
        ];
    }
}
