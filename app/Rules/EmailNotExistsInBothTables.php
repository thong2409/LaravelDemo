<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use App\Models\Customer;

class EmailNotExistsInBothTables implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        // Kiểm tra email có tồn tại trong bảng users không
        $userExists = User::where('email', $value)->exists();
        
        // Kiểm tra email có tồn tại trong bảng customers không
        $customerExists = Customer::where('email', $value)->exists();

        // Nếu email không tồn tại trong cả 2 bảng thì trả về true (hợp lệ)
        return !$userExists && !$customerExists;
    }

    public function message()
    {
        return 'Tài khoản email đã tồn tại vui lòng nhập lại!';
    }
}

