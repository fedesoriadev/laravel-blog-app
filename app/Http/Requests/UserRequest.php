<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name'            => ['required'],
            'email'           => ['required', 'email', Rule::unique('users')->ignore($this->route('user')?->id)],
            'username'        => ['required', Rule::unique('users')->ignore($this->route('user')?->id)],
            'role_id'         => ['nullable', 'integer', Rule::exists('roles', 'id')],
            'password'        => [$this->route('user') ? 'nullable' : 'required', 'sometimes', 'confirmed', 'min:8'],
            'profile_picture' => ['nullable', 'image', 'max:1024'],
            'about_me'        => ['nullable'],
            'twitter'         => ['nullable', 'url'],
            'youtube'         => ['nullable', 'url'],
            'twitch'          => ['nullable', 'url'],
            'github'          => ['nullable', 'url'],
        ];
    }
}
