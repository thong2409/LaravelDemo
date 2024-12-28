@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Hóa đơn</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin') }}">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Hóa đơn</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="">
                    <div class="" style="font-size: 20px">
                        <ul>
                            <li style="margin-bottom: 15px"><b>Tên Khách Hàng:</b>{{ $customer->full_name }}</li>
                            <li style="margin-bottom: 15px"><b>Số Điện Thoại:</b>{{ $customer->phone }}</li>
                            <li style="margin-bottom: 15px"><b>Địa Chỉ:</b>{{ $customer->address }}</li>
                            <li style="margin-bottom: 15px"><b>Email:</b>{{ $customer->email }}</li>
                        </ul>
                    </div>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 200px;text-align:center">Hình ảnh</th>
                                    <th>Sản phẩm</th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($carts as $cart)
                                    @php

                                        $price = $cart->price * $cart->qty;
                                        $total += $price;
                                    @endphp
                                    <tr>
                                        <td style="text-align:center">
                                            <div class="">
                                                <img loading="lazy" src="{{ asset($cart->product->image) }}" width="120"
                                                    height="120" alt="" />
                                            </div>
                                        </td>
                                        <td>
                                            {{ $cart->product->name }}
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">
                                                {{ number_format($cart->price, 0, '.') }} VNĐ
                                            </span>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__product-price">
                                                {{ $cart->qty }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="shopping-cart__subtotal">{{ number_format($price, 0, '.') }}
                                                VNĐ</span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4">Tổng Tiền:</td>
                                    <td>{{ number_format($total, 0, '.') }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>
@endsection
