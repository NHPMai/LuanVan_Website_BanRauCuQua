<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Giỏ Hàng Của Bạn
            </span>
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            @php $sumPriceCart = 0; @endphp
            <ul class="header-cart-wrapitem w-full">
                @if (count($products) > 0)
                    @foreach($products as $key => $product)
                        @php
                            $gia = \App\Helpers\Helper::gia($product->gia);
                            $sumPriceCart += $product->gia;
                        @endphp
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="{{ $product->hinhanh }}" alt="IMG">
                            </div>

                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    {{ $product->ten }}
                                </a>

                                <span class="header-cart-item-info">
                                       {!! $gia !!}
                                </span>
                            </div>
                        </li>
                    @endforeach
                @endif

            </ul>

            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Tổng: {{ number_format($sumPriceCart, '0', '', '.') }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{route('user.order-detail')}}"  class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        Xem giỏ hàng
                    </a>

                    <a href="{{route('user.showcheckout')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                       Thanh Toán
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>