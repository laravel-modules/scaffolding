<?php

namespace App\Http\Requests\Api;

use App\Models\User;
use App\Rules\PasswordRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Concerns\WithHashedPassword;

class ProfileRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'unique:users,email,'.auth()->id()],
            'phone' => ['sometimes', 'required', 'unique:users,phone,'.auth()->id()],
            'old_password' => ['required_with:password', new PasswordRule(auth()->user()->password)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        switch (auth()->user()->type) {
            case User::ADMIN_TYPE:
                return trans('admins.attributes');
                break;
            case User::CUSTOMER_TYPE:
            default:
                return trans('customers.attributes');
                break;
        }
    }
}
