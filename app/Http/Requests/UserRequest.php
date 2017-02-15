<?php

namespace shcart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

//Librerias
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
        if(Input::get('buttonlogin') === "login")
        {
            return [
                'email' => 'required|email',
                'password' => 'required'
            ];
        }
        else
        {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ];
        }
    }

}
