<?php

namespace SavyCon\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorService extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'required',
            'price' => 'required|numeric|between:500.00,10000000.00',
            'service.id' => 'required|numeric',
            'city.id' => 'required|numeric',
            // 'image_1' => 'required',
            //'image_2' => 'required',
            //'image_3' => 'required',
            'address' => 'required|string'
        ];
    }
}
