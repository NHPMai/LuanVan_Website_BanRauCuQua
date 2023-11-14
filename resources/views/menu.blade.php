@extends('home')


@section('content')

    <div class="bg0 m-t-23 p-b-140 p-t-40">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <p style=" font-size: 20px; margin-bottom: 0px;">Danh Mục: &nbsp</p>
                   <h1 style="margin-top: 0px; margin-bottom: 0px;">{{ $title }}</h1>
                </div>
            </div>

            @include('products.list')

            {!! $products->links() !!}
        </div>
    </div>
@endsection