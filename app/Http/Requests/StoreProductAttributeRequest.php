<?php

namespace App\Http\Requests;

class StoreProductAttributeRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|integer',
            'key' => 'required|string|max:255',
            'value' => 'required|string'
        ];
    }

}
