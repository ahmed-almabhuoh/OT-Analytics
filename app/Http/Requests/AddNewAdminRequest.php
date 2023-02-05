<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AddNewAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            //
            'fname' => 'required|string|min:3|max:15',
            'lname' => 'required|string|min:3|max:15',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|unique:admins,phone',
            'password' => ['required', 'string', Password::min(6)->letters()->numbers()],
            'image' => 'nullable|image|mimes:png,jpg',
            'status' => 'required|boolean',
        ];
    }
}
