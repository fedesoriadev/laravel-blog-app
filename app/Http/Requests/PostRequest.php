<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
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
        // When creating/updating a post, check if the request user_id matches logged author
        if ($this->user()->hasRole(UserRole::AUTHOR)) {
            return $this->user()->id === (int) $this->get('user_id');
        }

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
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'title'   => ['required', 'string'],
            'slug'    => [
                'nullable',
                'string',
                'regex:/^[a-z0-9_-]+$/i',
                Rule::unique('posts', 'slug')->ignore($this->route('post')?->id)
            ],
            'date'    => ['nullable', 'date'],
            'image'   => ['image', 'max:2048'],
            'excerpt' => ['nullable', 'string'],
            'body'    => ['required']
        ];
    }
}
