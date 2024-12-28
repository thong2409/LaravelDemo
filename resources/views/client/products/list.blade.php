@foreach ($products as $key => $product)
    <div class="col-6 col-md-4 col-lg-3">
        <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
            <div class="pc__img-wrapper">
                <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">
                    <img loading="lazy" src="{{ asset($product->image) }}" width="330" height="400"
                        alt="Cropped Faux leather Jacket" class="pc__img">
                </a>
            </div>

            <div class="pc__info position-relative">
                <h6 class="pc__title"><a
                        href="/san-pham/{{ $product->id }}-{{ Str::slug($product->name, '-') }}.html">{{ $product->name }}</a>
                </h6>
                <div class="product-card__price d-flex align-items-center">
                    <span class="money price text-secondary">
                        {!! \App\Helpers\Helper::price($product->price, $product->price_sale) !!}
                    </span>
                </div>

                <div
                    class="anim_appear-bottom position-absolute bottom-0 start-0 d-none d-sm-flex align-items-center bg-body">
                    <a class="btn-link btn-link_lg me-4 text-uppercase fw-medium js-add-cart js-open-aside"
                        href="/add-cart" title="Add To Cart">Thêm vào giỏ hàng</a>

                    <button class="pc__btn-wl bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_heart" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach
