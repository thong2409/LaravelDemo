@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Danh Mục</h3>
                @include('admin.alert')
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="index.html">
                            <div class="text-tiny">Trang chủ</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Danh Mục</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search" method="GET" action="{{ route('admin.category.search') }}">
                            <fieldset class="name">
                                <input type="text" placeholder="Tìm kiếm..." class="" name="search" tabindex="2"
                                    value="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.category.add') }}"><i class="icon-plus"></i>Thêm
                        danh mục</a>
                </div>
                <div class="wg-table table-all-user">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 50px;text-align: center">#</th>
                                <th>Tên danh mục</th>
                                <th style="width: 100px;text-align: center">Trạng thái</th>
                                <th>Mô tả</th>
                                <th>Cập nhật</th>
                                <th style="width: 100px;text-align: center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($menus->isEmpty())
                                <p>Không có danh mục nào phù hợp với tìm kiếm</p>
                            @else
                                {!! \App\Helpers\Helper::menu($menus) !!}
                            @endif



                        </tbody>

                    </table>

                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>
@endsection
