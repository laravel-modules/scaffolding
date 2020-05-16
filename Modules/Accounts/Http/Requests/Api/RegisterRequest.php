<?php

namespace Modules\Accounts\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Accounts\Http\Requests\WithHashedPassword;

class RegisterRequest extends FormRequest
{
    use WithHashedPassword;

    /**
     * Determine if the supervisor is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'unique:users,phone'],
            'password' => ['required', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'base64_image'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return trans('accounts::customers.attributes');
    }
}
