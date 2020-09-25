<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Auth;

class UpdatePasswordRequest extends FormRequest
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
            'currentPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if(!(\Hash::check($value, \Auth::user()->password))) {
                      return $fail('Enter the correct password');
                    }
                },
            ],
            'newPassword' => 'required|string|min:8|confirmed|different:currentPassword',
        ];
    }
}