<?php

namespace App\Http\Requests\Auth;

use App\Rules\EmailNotExistsInBothTables;
use Illuminate\Foundation\Http\FormRequest;

class RegisterFromRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', new EmailNotExistsInBothTables], // Sử dụng rule mới
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
        ];
    }
    public function messages(){
        return [
            'full_name.required' => 'Họ và tên không được để trống.',
            'full_name.string' => 'Họ và tên phải là một chuỗi.',
            'full_name.max' => 'Họ và tên không được vượt quá :max ký tự.',
            'email.required' => 'Email không được để trống.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu không được để trống.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'address.required' => 'Địa chỉ không được để trống.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'address.max' => 'Địa chỉ không được vượt quá :max ký tự.',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là số',
        ];
    }
}
