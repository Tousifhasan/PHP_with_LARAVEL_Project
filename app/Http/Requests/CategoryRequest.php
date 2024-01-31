<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class CategoryRequest extends FormRequest
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
       $categoryId = $this->route('category')->id??'';
    //    dd($categoryId);
        return [
            'title'=> ['required', 'min:5', 'max:10', Rule::unique('categories', 'title')->ignore($categoryId)],
            'description'=> ['required', 'min:5', 'max:100'],
        ];
    }
}
