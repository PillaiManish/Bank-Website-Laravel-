<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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


    public function messages()
    {
        return [
            'confirmpassword.same' => 'Password & Confirm Password field must be same, please try again',
        ];
    }   

    public function attributes(){
        return [
            'password' => 'Password',
            'confirmpassword'=>'Confirm Password'
        ];
    }

    public function rules()
    {
        return [
            'name'=>'bail|required|alpha',
            'password'=>'bail|required|min:8',
            'confirmpassword'=>'bail|required|min:8|same:password',
            'email'=>'bail|required|email|unique:users',
        ];
    }
}
