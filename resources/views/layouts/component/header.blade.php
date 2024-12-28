<header id="header" class="header header-fullwidth header-transparent-bg">
    <div class="container">
        <div class="header-desk header-desk_type_1">
            <div class="logo">
                <a href="{{ route('user') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Uomo" class="logo__image d-block" />
                </a>
            </div>

            <nav class="navigation">
                <ul class="navigation__list list-unstyled d-flex">
                    <li class="navigation__item">
                    <li class="navigation__item">
                        <a href="/danh-muc" class="navigation__link">Tất cả</a>
                    </li>
                    </li>
                    @foreach ($category as $menu)
                        <li class="navigation__item">
                            <a href="/danh-muc/{{ $menu->id }}-{{ Str::slug($menu->name, '-') }}.html"
                                class="navigation__link">{{ $menu->name }}</a>
                            @php
                                // Kiểm tra xem danh mục hiện tại có danh mục con không
                                $hasSubmenu = $allMenus->where('parent_id', $menu->id)->count() > 0;
                            @endphp

                            @if ($hasSubmenu)
                                <ul class="dropdown" style="margin-top: 10px">
                                    <li class="dropdown__item">
                                        @foreach ($allMenus as $submenu)
                                            @if ($submenu->parent_id == $menu->id)
                                                <a
                                                    href="/danh-muc/{{ $submenu->id }}-{{ Str::slug($submenu->name, '-') }}.html">{{ $submenu->name }}</a>
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </nav>

            <div class="header-tools d-flex align-items-center">
                <div class="header-tools__item hover-container">
                    <div class="js-hover__open position-relative">
                        <a class="js-search-popup search-field__actor" href="#">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_search" />
                            </svg>
                            <i class="btn-icon btn-close-lg"></i>
                        </a>
                    </div>

                    <div class="search-popup js-hidden-content">
                        <form action="{{ route('client.search') }}" method="GET" class="search-field container">
                            <p class="text-uppercase text-secondary fw-medium mb-4">Bạn đang cần tìm gì?</p>
                            <div class="position-relative">
                                <input class="search-field__input search-popup__input w-100 fw-medium" type="text"
                                    name="search" placeholder="Tìm sản phẩm" />
                                <button class="btn-icon search-popup__submit" type="submit">
                                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_search" />
                                    </svg>
                                </button>
                                <button class="btn-icon btn-close-lg search-popup__reset" type="reset"></button>
                            </div>

                            <div class="search-popup__results">
                                <div class="sub-menu search-suggestion">
                                    <h6 class="sub-menu__title fs-base">Tìm nhanh</h6>
                                    <ul class="sub-menu__list list-unstyled">
                                        @foreach ($menuChild as $index => $menu)
                                            @if ($index < 5)
                                                <li class="sub-menu__item"><a href="shop2.html"
                                                        class="menu-link menu-link_us-s">{{ $menu->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                    </ul>
                                </div>

                                <div class="search-result row row-cols-5"></div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="header-tools__item hover-container">
                    @if (session()->has('customer.name'))
                        <p>Chào, {{ session('customer.name') }}|</p>
                        <form action="{{ route('user.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-link">Đăng xuất</button>
                        </form>
                    @else
                        <a href="{{ route('admin.user.login') }}" class="header-tools__item">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_user" />
                            </svg>
                        </a>
                    @endif

                </div>

                <a href="/carts" class="header-tools__item header-tools__cart">
                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_cart" />
                    </svg>
                    @if (Session::has('carts') && count(Session::get('carts')) > 0)
                        <span
                            class="cart-amount d-block position-absolute js-cart-items-count">{{ count(Session::get('carts')) }}</span>
                    @else
                        <span class="cart-amount d-block position-absolute js-cart-items-count">0</span>
                    @endif


                </a>
            </div>
        </div>
    </div>
</header>
