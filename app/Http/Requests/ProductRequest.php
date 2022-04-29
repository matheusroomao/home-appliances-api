<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
        $rules = [];
        if (empty(intval($this->route()->parameter("product")))) {
            $rules =  [
                'name' => ['required', 'string','min:3','max:40'],
                'description' => ['required', 'string'],
                'voltage' => ['required', 'string', 'in:220v,110v'],
                'brand_id' => ['required', 'exists:App\Models\Brand,id', 'integer'],
            ];
        } else {
            if ($this->request->has('name')) {
                $name = ['required','string','min:3','max:40'];
                $rules['name'] = $name;
            }
            if ($this->request->has('description')) {
                $description = ['required', 'string'];
                $rules['description'] = $description;
            }
            if ($this->request->has('voltage')) {
                $voltage = ['required', 'string', 'in:220v,110v'];
                $rules['voltage'] = $voltage;
            }
            if ($this->request->has('brand_id')) {
                $brand_id = ['required', 'exists:App\Models\Brand,id', 'integer'];
                $rules['brand_id'] = $brand_id;
            }
        }
        return $rules;
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['message'=>$validator->errors()->first()],422)); 
    }
}
