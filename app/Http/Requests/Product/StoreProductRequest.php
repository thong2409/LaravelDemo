<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif,webp|max:4096',
            'images.*' => 'image|mimes:jpeg,jpg,png,gif,webp|max:4096',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' =>'Nhập tên sản phẩm',
            'name.max' =>'Tên sản phẩm chỉ được tối đa 255 kí tự',
            'image.required' =>'Chọn ảnh sản phẩm'
        ];
    }
}
