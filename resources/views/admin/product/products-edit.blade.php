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
                <h3>Thay đổi thông tin sản phẩm</h3>
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
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Sản phẩm</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Chỉnh sửa thông tin</div>
                    </li>
                </ul>

            </div>
            @if ($errors->any())
                <div class="alert alert-danger error">
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
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('admin.product.update', $product->id) }}">
                @csrf

                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Tên sản phẩm <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0"
                            value="{{ $product->name }}">
                    </fieldset>

                    {{-- <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0"
                            value="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset> --}}

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" id="parent-category" name="">
                                    <option>Chọn danh mục</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}">
                                            {{ $menu->name }}</option>
                                    @endforeach
                                </select>
                                <select id="sub-category" name="menu_id" class="form-control">
                                    <option value="">Chọn danh mục con</option>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}"
                                            {{ $menu->id == $product->menu_id ? 'selected' : '' }}>
                                            {{ $menu->name }}</option>
                                    @endforeach
                                    <!-- Danh mục con sẽ được thêm vào đây qua AJAX -->
                                </select>
                            </div>
                        </fieldset>
                        {{-- <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    <option value="1">Brand1</option>
                                    <option value="2">Brand2</option>
                                    <option value="3">Brand3</option>
                                    <option value="4">Brand4</option>

                                </select>
                            </div>
                        </fieldset> --}}
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Mô tả <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="description" placeholder="Short Description" tabindex="0">{{ $product->description }}</textarea>
                    </fieldset>

                    <fieldset class="description">
                        <div class="body-title mb-10">Nội dung <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="content" placeholder="Content" tabindex="0">{{ $product->content }}</textarea>
                    </fieldset>
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div style="padding-left: 190px;padding-bottom: 20px"><img src="{{ asset($product->image) }}"
                                id="preview-image" alt="" width="250px"></div>
                        <div class="mb-3">

                            <input type="file" class="form-control" value="{{ asset($product->image) }}" name="image"
                                id="image-input" aria-describedby="helpId" placeholder="" />
                        </div>
                    </fieldset>

                    <fieldset>
                        <div style="padding-left: 190px;padding-bottom: 20px"><img src="{{ asset($product->images) }}"
                                id="preview-image" alt="" width="250px"></div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="images" class="form-label">Ảnh mô tả sản phẩm</label>
                                <input type="file" name="images[]" id="images" value="{{ asset($product->images) }}"
                                    class="form-control" multiple>
                            </div>
                    </fieldset>

                    {{-- <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="upload-image mb-16">
                            <!-- <div class="item">
                                                                                                                                                                                                                                                <img src="images/upload/upload-1.png" alt="">
                                                                                                                                                                                                                                            </div>                                                 -->
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="text-tiny">Drop your images here or select <span class="tf-color">click
                                            to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                        multiple="">
                                </label>
                            </div>
                        </div>
                    </fieldset> --}}

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Giá bán: <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="number" placeholder="Enter regular price" name="price"
                                tabindex="0" value="{{ $product->price }}">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Giá giảm: <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="number" placeholder="Enter sale price" name="price_sale"
                                tabindex="0" value="{{ $product->price_sale }}">
                        </fieldset>
                    </div>


                    {{-- <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0"
                                value="">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity"
                                tabindex="0" value="{{ old('quantity') }}">
                        </fieldset>
                    </div> --}}

                    {{-- <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </fieldset>
                    </div> --}}
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Active</div>

                            <div class="form-controller">

                                <input type="checkbox" name="active" id="active" value="1"
                                    {{ $product->active == 1 ? 'checked' : '' }}>
                                <label for="active">Hoạt động</label>
                                <input type="checkbox" name="active" id="no_active" value="0"
                                    {{ $product->active == 0 ? 'checked' : '' }}>
                                <label for="no_active">Tắt hoạt động</label>
                            </div>
                        </fieldset>
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Cập nhật</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
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
