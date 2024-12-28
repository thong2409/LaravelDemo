@extends('layouts.client')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Mua sắm và thanh toán</h2>
            @include('admin.alert')
            <div class="checkout-steps">
                <a href="/carts" class="checkout-steps__item ">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Giỏ hàng</span>
                        <em>Quản lý giỏ hàng của bạn</em>
                    </span>
                </a>
                <a href="/carts/checkout" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Mua sắm và thanh toán</span>
                        <em>Thanh toán giỏ hàng của bạn</em>
                    </span>
                </a>
                <a href="order-confirmation.html" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Xác nhận</span>
                        <em>Xem và xác nhận hóa đơn của bạn</em>
                    </span>
                </a>
            </div>
            <form name="checkout-form" action="{{ route('cart.checkout') }}" method="POST">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>THÔNG TIN MUA SẮM</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <input type="hidden" name="id" value="{{ session('customer.id') }}">
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" value="{{ session('customer.name') }}"
                                        name="full_name" required>
                                    <label for="name">Họ vầ tên *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ session('customer.phone') }}" required>
                                    <label for="phone">Số điện thoại *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="email"
                                        value="{{ session('customer.email') }}">
                                    <label for="zip">Email *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" name="address"
                                        value="{{ session('customer.address') }}">
                                    <label for="state">Địa chỉ *</label>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout__payment-methods">
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="radio"
                                            name="payment_method" id="checkout_payment_method_1" value="Chuyển Khoản">
                                        <label class="form-check-label" for="checkout_payment_method_1">
                                            Chuyển Khoản
                                            {{-- <p class="option-detail">
                                                Make your payment directly into our bank account. Please use your Order ID
                                                as
                                                the payment
                                                reference.Your order will not be shipped until the funds have cleared in our
                                                account.
                                            </p> --}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="radio"
                                            name="payment_method" id="checkout_payment_method_2" value="Thẻ Ghi Nợ">
                                        <label class="form-check-label" for="checkout_payment_method_2">
                                            Thẻ Ghi Nợ
                                            {{-- <p class="option-detail">
                                                Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum
                                                gravida
                                                nec dui. Aenean
                                                aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim
                                                viverra
                                                nunc, ut aliquet
                                                magna posuere eget.
                                            </p> --}}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input form-check-input_fill" type="radio"
                                            name="payment_method" id="checkout_payment_method_3"
                                            value="Thanh toán khi nhận hàng" checked>
                                        <label class="form-check-label" for="checkout_payment_method_3">
                                            Thanh toán khi nhận hàng
                                            {{-- <p class="option-detail">
                                                Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum
                                                gravida
                                                nec dui. Aenean
                                                aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim
                                                viverra
                                                nunc, ut aliquet
                                                magna posuere eget.
                                            </p> --}}
                                        </label>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="checkout__totals-wrapper">
                        @php
                            $total = 0;
                        @endphp
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>HÓA ĐƠN</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>SẢN PHẨM</th>
                                            <th align="right">CHI PHÍ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($products as $product)
                                            @php
                                                $price =
                                                    $product->price_sale != null
                                                        ? $product->price_sale
                                                        : $product->price;
                                                $priceEnd = $price * $carts[$product->id];
                                                $total += $priceEnd;
                                                $VAT = $total - $total * 0.9;
                                                $totalBill = $total + $VAT;
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{ $product->name }} x {{ $carts[$product->id] }}
                                                </td>
                                                <td align="right">
                                                    {{ number_format($priceEnd, 0, '.') }}

                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>TỔNG HÓA ĐƠN</th>
                                            <td align="right">{{ number_format($total, 0, '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>GIAO HÀNG</th>
                                            <td align="right">Miễn phí giao hàng</td>
                                        </tr>
                                        <tr>
                                            <th>VAT</th>
                                            <td align="right">{{ number_format($VAT, 0, '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>TỔNG CỘNG</th>
                                            <td align="right">{{ number_format($totalBill, 0, '.') }}</td>
                                            <input type="hidden" name="total"
                                                value="{{ number_format($totalBill, 0, '.') }}">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button class="btn btn-primary btn-checkout">XUẤT HÓA ĐƠN</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection
