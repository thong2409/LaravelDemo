@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Thêm Nhân Viên</h3>
                @include('admin.alert')
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
                        <div class="text-tiny">Thêm Nhân Viên</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('admin.user.store') }}">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Tên Nhân Viên <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Họ và Tên" name="name" tabindex="0"
                            value="{{ old('name') }}">
                    </fieldset>
                    <fieldset class="category">
                        <div class="body-title">Phân Quyền</div>
                        <div class="select flex-grow">
                            <select class="" name="is_admin">
                                <option value="">Chọn Quyền Hạn</option>
                                <option value="1">Admin</option>
                                <option value="0">Nhân viên thường</option>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Email <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Email" name="email" tabindex="0"
                            value="{{ old('email') }}"">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Mật Khẩu <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Mật Khẩu" name="password" tabindex="0"
                            value="{{ old('password') }}"">
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Địa Chỉ <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Địa Chỉ" name="address" tabindex="0"
                            value="{{ old('address') }}"">
                    </fieldset>

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
