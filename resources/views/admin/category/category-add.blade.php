@extends('layouts.admin')
@section('head')
    <script src="{{ asset('https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js') }}"></script>
    <style>
        .cke_notifications_area {
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Thêm Danh Mục</h3>
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
                        <a href="#">
                            <div class="text-tiny">Categories</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Thêm Danh Mục</div>
                    </li>
                </ul>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Session::has('error'))
                <div class="alert alert-danger error">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success error">
                    {{ Session::get('success') }}
                </div>
            @endif
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.category.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Tên Danh Mục <span class="tf-color-1">*</span>
                        </div>
                        <input class="flex-grow" type="text" placeholder="Tên danh mục" name="name" tabindex="0"
                            value="">
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Chọn Danh Mục Cha<span class="tf-color-1">*</span></div>
                        <div class="select flex-grow">
                            <select class="" name="parent_id">
                                <option value="0">Danh mục cha</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                @endforeach

                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title">Mô tả <span class="tf-color-1">*</span>
                        </div>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Mô tả"></textarea>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Nội dung<span class="tf-color-1">*</span>
                        </div>
                        <textarea name="content" id="content" placeholder="Nội dung"></textarea>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Hoạt động <span class="tf-color-1">*</span>
                        </div>
                        <div class="form-controller">

                            <input type="checkbox" name="active" id="active" value="1" checked>
                            <label for="active">Mở</label>
                            <input type="checkbox" name="no_active" id="no_active" value="0">
                            <label for="no_active">Tắt</label>
                        </div>

                    </fieldset>
                    {{-- <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>

                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="../../../localhost_8000/images/upload/upload-1.png" class="effect8"
                                    alt="">
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" id="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="myFile" name="myFile" accept="image/*">
                                </label>

                                <div id="image_show">

                                </div>
                                <input type="hidden" name="thumb" id="thumb">

                            </div>
                        </div>
                    </fieldset> --}}
                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Thêm Danh Mục</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <script>
        CKEDITOR.replace('content', {
            height: 250, // Chiều cao của editor
            width: '100%' // Đặt chiều rộng tùy ý, ví dụ '100%' hoặc '800px'
        });
    </script>
@endsection
