@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Danh Sách Đơn Hàng</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin') }}">
                            <div class="text-tiny">Trang Chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Đơn Hàng</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('admin.product.search') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm..." class="" name="search" tabindex="2"
                                    value="{{ request('search') }}">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tên khách hàng</th>
                                <th style="padding-top: 12px">Địa chỉ</th>
                                <th>Số Điện Thoại</th>
                                <th>Tổng số lượng sản phẩm</th>
                                <th>Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->customer->full_name }}</td>
                                    <td>{{ $payment->customer->address }}</td>
                                    <td>{{ $payment->customer->phone }}</td>
                                    <td>{{ $payment->total_qty }}</td>
                                    <td>{{ number_format($payment->total_price, 0, ',', '.') }} đ</td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                    <a href="{{ url('/export-payments') }}" class="btn btn-primary">Xuất Excel </a>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
            </div>
        </div>
    </div>
@endsection
