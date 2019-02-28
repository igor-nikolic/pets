<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
            'first_name'=>'required|between:3,30',
            'last_name'=>'required|between:3,50',
            'email'=>'required|email|unique:user',
            'password'=>'|required|string|min:8',
            'confirmpassword'=>'same:password'
        ];
    }
}
