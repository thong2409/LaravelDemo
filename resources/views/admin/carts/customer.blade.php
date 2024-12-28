@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Danh Sách Khách Hàng</h3>
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
                        <div class="text-tiny">Danh Sách Khách Hàng</div>
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
                                <th style="text-align: center;width: 50px;">#</th>
                                <th>Tên Khách Hàng</th>
                                <th style="width: 120px">Số Điện Thoại</th>
                                <th style="width: 350px">Email</th>
                                <th>Địa chỉ</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Hành động</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
                                    <td style="text-align: center">{{ $customer->id }}</td>
                                    <td class="pname">
                                        <div class="name">
                                            <a href="#" class="body-title-2">{{ $customer->full_name }}</a>
                                        </div>
                                    </td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>
                                        <div class="list-icon-function">
                                            <a href="{{ route('admin.customers.view', $customer->id) }}" target="_blank">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </a>
                                            <a href=""
                                                onclick="removeRow({{ $customer->id }}, '/admin/customers/destroy')">
                                                <div class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </div>
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                    {!! $customers->links() !!}
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
            </div>
        </div>
    </div>
@endsection
