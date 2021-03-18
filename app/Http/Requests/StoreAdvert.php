<?php

namespace SavyCon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdvert extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            //'URL' => 'required|active_url',
            'image' => 'required',
            'layer' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'URL.active_url' => 'The link you provided does not exist'
        ];
    }
}
