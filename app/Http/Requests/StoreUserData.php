<?php

namespace SavyCon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserData extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'password' => 'sometimes|min:6',
            'city.id' => 'required|numeric'
        ];
    }
}
