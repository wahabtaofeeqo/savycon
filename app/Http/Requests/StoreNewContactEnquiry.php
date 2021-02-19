<?php

namespace SavyCon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewContactEnquiry extends FormRequest
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
            'email' => 'required|email|unique:contact_enquiries',
            'message' => 'required|string|min:30',
            'g-recaptcha-response' => 'recaptcha',
        ];
    }

    public function messages()
    {
        return [
            'g-recaptcha-response.recaptcha' => 'Please validate the reCAPTCHA box',
        ];
    }
}
