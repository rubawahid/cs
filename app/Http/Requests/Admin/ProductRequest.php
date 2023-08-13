<?php

namespace App\Http\Requests\Admin;

use App\Models\category;
use Illuminate\Foundation\Http\FormRequest;

class categoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
       $category = $this->route('category', 0);
       $id = $category? $category->id : 0;
       return [
        'name' => 'required|max:255|min:3',
         'slug' => 'required|unique:categories,slug,{$id}',
         'category_id' => 'nullable|int|exists:categories,id',
         'description' => 'nullable|string',
         'short_description' => 'nullable|string|max:500',
         'price' => 'required|numeric|min:0',
         'compare_price' => 'nullable|numeric|min:0|gt:price',
         'image' => 'nullable|image|max:1024',
         'status' => 'required|in:Active,Draft,Archived',
         'gallery' => 'nullable|array',
         'gallery.*' => 'image',

    ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute field is required!!',
            'unique' => 'The value alredy exists!',
            'name.required' => 'The category name is mandatory!',

        ];
    }
}
