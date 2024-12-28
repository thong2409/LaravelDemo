@extends('layouts.client')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                        href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="true">ĐĂNG
                        KÝ</a>
                </li>
            </ul>
            @include('admin.alert')
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel"
                    aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="{{ route('user.register.store') }}" name="register-form"
                            class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control form-control_gray " name="full_name" value="">
                                <label for="name">Họ và tên</label>
                            </div>
                            <div class="pb-3"></div>
                            <div class="form-floating mb-3">
                                <input id="email" type="email" class="form-control form-control_gray " name="email"
                                    value="" autocomplete="email">
                                <label for="email">Email *</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="phone" type="number" class="form-control form-control_gray " name="phone"
                                    value="" autocomplete="phone">
                                <label for="phone">Số Điện Thoại *</label>
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password" class="form-control form-control_gray "
                                    name="password">
                                <label for="password">Mật khẩu *</label>
                            </div>
                            <div class="pb-3"></div>
                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control form-control_gray"
                                    name="password_confirmation">
                                <label for="password">Xác nhận mật khẩu *</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input id="address" type="text" class="form-control form-control_gray" name="address">
                                <label for="address">Địa chỉ *</label>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" id="register" type="submit">Đăng
                                Ký</button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">Bạn đã có tài khoản?</span>
                                <a href="{{ route('admin.user.login') }}" class="btn-text js-show-register">Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
