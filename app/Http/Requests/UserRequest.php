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
            'name'     => ['required'],
            'username' => ['required', Rule::unique('users')->ignore($this->user?->id)],
            'email'    => ['required', 'email', Rule::unique('users')->ignore($this->user?->id)],
            'password' => [Rule::requiredIf(!$this->user), 'confirmed', 'min:8'],
            'avatar'   => ['nullable', 'image', 'max:1024'],
            'about_me' => ['nullable'],
            'twitter'  => ['nullable', 'url'],
            'youtube'  => ['nullable', 'url'],
            'twitch'   => ['nullable', 'url'],
            'github'   => ['nullable', 'url'],
        ];
    }
}
