<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {



         $productValidationRole = 'mimes:jpg,png,jpeg|max:1000';
        if ($this->isMethod('post')) {
                $productValidationRole = 'required|'.$productValidationRole;
            }
           
        return [
            'name'=> ['required'],
            'description'=> ['required'],
            'category'=> ['required'],
            'price'=> ['required'],
            'image'=> $productValidationRole,
        ];
    }
}
