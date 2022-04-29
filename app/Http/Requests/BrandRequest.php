<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BrandRequest extends FormRequest
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
        if (empty(intval($this->route()->parameter("brand")))) {
            $rules =  [
                'name' => ['required', 'string', 'min:2', 'max:30','unique:brands'],
            ];
        } else {
            if ($this->request->has('name')) {
                $name = ['required','string', 'min:2', 'max:30','unique:brands'];
                $rules['name'] = $name;
            }
        }
        return $rules;
    }
    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(['message'=>$validator->errors()->first()],422)); 
    }
}
