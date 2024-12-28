<html>

<head>
    <title>SurfsideMedia</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="surfside media" />
    <style>
        /* Thêm kiểu dáng cho nút */
        .btn-confirm {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            /* Màu xanh Bootstrap */
            border: none;
            border-radius: 5px;
            text-decoration: none;
            /* Xóa gạch chân */
            text-align: center;
        }

        .btn-confirm:hover {
            background-color: #0056b3;
            /* Màu xanh đậm hơn khi hover */
        }
    </style>
</head>

<body>
    <h1>Bạn có 1 đơn hàng</h1>

    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="border: 1px solid #ddd; padding: 8px;">Sản phẩm</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Giá tiền</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Số lượng</th>
                <th style="border: 1px solid #ddd; padding: 8px;">Tổng tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderData as $item)
                @php
                    $price = $item['price'] * $item['qty'];
                @endphp
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['product_name'] }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($item['price'], 0, '.') }} VNĐ
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['qty'] }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($price, 0, '.') }} VNĐ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right; border: 1px solid #ddd; padding: 8px;">Tổng Sản Phẩm:</td>
                <td style="border: 1px solid #ddd; padding: 8px;">{{ count($orderData) }}</td>
            </tr>
        </tbody>

    </table>
    <h1>Đặt hàng thành công!</h1>
    <p>Cảm ơn bạn đã đặt hàng. Đơn hàng của bạn đang được xử lý.</p>
</body>


</html>
