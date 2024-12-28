@extends('layouts.admin')

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Sản Phẩm</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang Chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Sản Phẩm</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.product.add') }}"><i class="icon-plus"></i>Thêm
                        sản phẩm</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;width: 50px;">#</th>
                                <th>Tên sản phẩm</th>
                                <th style="text-align: center;">Giá gốc</th>
                                <th style="text-align: center;">Giá giảm</th>
                                <th>Danh mục</th>
                                <th style="text-align: center;width: 100px;">Trạng thái</th>
                                <th>Cập nhật</th>
                                <th>Hành động</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($products->isEmpty())
                                <p>Không có sản phẩm nào được tìm thấy theo tìm kiếm</p>
                            @else
                                @foreach ($products as $product)
                                    <tr>
                                        <td style="text-align: center">{{ $product->id }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ asset($product->image) }}" alt="" class="image">
                                            </div>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $product->name }}</a>
                                                <div class="text-tiny mt-3">{{ $product->name }}</div>
                                            </div>
                                        </td>
                                        <td style="text-align: center;">{{ number_format($product->price, 0, ',') }}VNĐ</td>
                                        <td style="text-align: center;">{{ number_format($product->price_sale) }}VNĐ</td>
                                        <td>{{ $product->menu->name }}</td>
                                        <td style="text-align: center">
                                            @if ($product->active == 0)
                                                <span class="btn btn-danger btn-xs">No</span>
                                            @else
                                                <span class="btn btn-success btn-xs">Yes</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->updated_at }}</td>
                                        <td>
                                            <div class="list-icon-function">
                                                <a href="{{route('admin.product.view',$product->id)}}" target="_blank">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
                                                    </div>
                                                </a>
                                                <a href="{{ route('admin.product.edit', $product->id) }}">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>
                                                <a href=""
                                                    onclick="removeRow({{ $product->id }}, '/admin/product/destroy')">
                                                    <div class="item text-danger delete">
                                                        <i class="icon-trash-2"></i>
                                                    </div>
                                                </a>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                        </tbody>
                    </table>
                    {!! $products->links() !!}
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                </div>
            </div>
        </div>
    </div>
@endsection
