@extends('layouts.client')
@section('content')
    <main>

        <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow"
            data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true
      }'>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="assets/images/home/demo3/slideshow-character1.png" width="542"
                                height="733" alt="Woman Fashion 1"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                            <div class="character_markup type2">
                                <p
                                    class="text-uppercase font-sofia mark-grey-color animate animate_fade animate_btt animate_delay-10 mb-0">
                                    Dresses</p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6
                                class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                New Arrivals</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
                            <a href="#"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                                Now</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="assets/images/slideshow-character1.png" width="400" height="733"
                                alt="Woman Fashion 1"
                                class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                            <div class="character_markup">
                                <p
                                    class="text-uppercase font-sofia fw-bold animate animate_fade animate_rtl animate_delay-10">
                                    Summer
                                </p>
                            </div>
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6
                                class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                New Arrivals</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
                            <a href="#"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                                Now</a>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="overflow-hidden position-relative h-100">
                        <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                            <img loading="lazy" src="assets/images/slideshow-character2.png" width="400" height="690"
                                alt="Woman Fashion 2"
                                class="slideshow-character__img animate animate_fade animate_rtl animate_delay-10 w-auto h-auto" />
                        </div>
                        <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                            <h6
                                class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                New Arrivals</h6>
                            <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">Night Spring</h2>
                            <h2 class="h1 fw-bold animate animate_fade animate_btt animate_delay-5">Dresses</h2>
                            <a href="#"
                                class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">Shop
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div
                    class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
                </div>
            </div>
        </section>
        <div class="container mw-1620 bg-white border-radius-10">



            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="products-grid container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">SẢN PHẨM NỔI BẬT</h2>
                <div class="row" id="loadProducts">
                    @include('client.products.list')
                </div>
                <div class="text-center mt-2" id="button-loadMore">
                    <input type="hidden" name="" id="page" value="1">
                    <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium" onclick="loadMore()">Xem
                        thêm</a>
                </div>
            </section>
        </div>

        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

    </main>
@endsection
