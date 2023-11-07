@extends ('home')
@section('content')
    <div class="row isotope-grid">
        @foreach($products as $key => $product)

        <div class="col-sm-6 col-md-4 col-lg-3 p-t-100 isotope-item women">
            <!-- Block2 -->
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->hinhanh }}" alt="{{ $product->name }}">
                </div>

                <div class="block2-txt flex-w flex-t p-t-50">
                    <div class="block2-txt-child1 flex-col-l px-5">
                        <a href="/san-pham/{{ $product->id }}-{{ Str::slug($product->ten, '-') }}.html"
                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6" >
                            {{ $product->ten}}
                        </a>

                        <span class="stext-105 cl3">
                        {!!  \App\Helpers\Helper::gia($product->gia)  !!}đ
                            
                        </span>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
@endsection

