<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name_en'=>['required','alpha','between:3,32'],
            'email'=>['required','email','unique:admins'],
            'phone'=>['required','regex:/01[0-2,5]{1}[0-9]{8}$/','unique:admins'],
            'password'=>['required','confirmed','regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,20}$/'],
            'password_confirmation'=>['required'],
            'phone_type'=>['required']
        ];

    }
}
