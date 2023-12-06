@extends('home')


@section('content')

<div class="bg0 m-t-23 p-b-140 p-t-40">
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-lr-0-lg">
            <a href="/shop" class="stext-109 cl8 hov-cl1 trans-04 m-t-5" style=" font-size: 20px;">
                Sản phẩm
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <p style=" font-size: 20px; margin-bottom: 0px; margin-top: 10px">Danh Mục: &nbsp</p>
            <h1 style="margin-top: 0px; margin-bottom: 0px;">{{ $title }}</h1>
        </div>

        @include('products.list')

        {!! $products->links() !!}
    </div>
</div>
@endsection