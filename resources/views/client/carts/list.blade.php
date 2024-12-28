@extends('layouts.client')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            @include('admin.alert')
            <h2 class="page-title">Giỏ hàng</h2>
            <div class="checkout-steps">
                <a href="/carts" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Giỏ hàng</span>
                        <em>Quản lý giỏ hàng của bạn</em>
                    </span>
                </a>
                <a href="/carts/checkout" class="checkout-steps__item">
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
            <form action="" method="post">
                <div class="shopping-cart">
                    @php
                        $total = 0;
                    @endphp
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th></th>
                                    <th>Giá tiền</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @if (!empty($products))
                                <tbody>

                                    @foreach ($products as $product)
                                        @php
                                            $price = $product->price_sale != 0 ? $product->price_sale : $product->price;
                                            $priceEnd = $price * $carts[$product->id];
                                            $total += $priceEnd;
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="shopping-cart__product-item">
                                                    <img loading="lazy" src="{{ asset($product->image) }}" width="120"
                                                        height="120" alt="" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="shopping-cart__product-item__detail">
                                                    <h4>{{ $product->name }}</h4>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="shopping-cart__product-price">
                                                    {{ number_format($price, 0, '.') }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="qty-control position-relative">
                                                    <input type="number" name="quantity[{{ $product->id }}]"
                                                        value="{{ $carts[$product->id] }}" min="1"
                                                        class="qty-control__number text-center">
                                                    <div class="qty-control__reduce">-</div>
                                                    <div class="qty-control__increase">+</div>
                                                </div>
                                            </td>
                                            <td>
                                                <span
                                                    class="shopping-cart__subtotal">{{ number_format($priceEnd, 0, '.') }}</span>
                                            </td>
                                            <td>
                                                <a href="carts/delete/{{ $product->id }}" class="remove-cart">
                                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                        <path
                                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            @else
                                <h3 class="text-center">Giỏ hàng của bạn đang rỗng</h3>
                            @endif
                        </table>


                        <div class="cart-table-footer">


                            @csrf
                            <button type="submit" formaction="/update-cart" class="btn btn-light">CẬP NHẬT GIỎ
                                HÀNG</button>
            </form>
            </div>
            </div>
            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3></h3>
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>Tổng tiền</th>
                                    <td>{{ number_format($total, 0, '.') }}</td>
                                </tr>

                                <tr>
                                    <th>VAT</th>
                                    <td>10%</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="/carts/checkout" class="btn btn-primary btn-checkout">THANH TOÁN</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
