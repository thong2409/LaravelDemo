<?php

namespace App\Exports;

use App\Models\Cart;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromQuery, WithHeadings
{
    public function query()
    {
        // Lấy dữ liệu từ bảng carts
        return Cart::query()
                    ->join('customers', 'carts.customer_id', '=', 'customers.id')                    
                    ->select('customers.full_name as customer_name','customers.phone','customers.address', 'carts.qty', 'carts.price');
    }

    public function headings(): array
    {
        return ['Tên khách hàng','Số điện thoại','Địa chỉ', 'Số lượng sản phẩm', 'Tổng tiền'];
    }
}
