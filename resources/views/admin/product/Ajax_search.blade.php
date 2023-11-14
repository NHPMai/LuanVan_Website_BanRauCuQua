<!-- @foreach ($data as $np)

<div class="media"><a class="pull-left" 
    href="{{route('san-pham/{id}-{slug}.html.' ,['id'=>$np->id, 'slug'=>Str::slug($np->ten)]) }}">
    <img class="media-object" width="50" src="{{ $product->hinhanh}}"></a>

    <div class="media-body">
        <h4 class="media-heading">
            <a href="{{route('san-pham/{id}-{slug}.html.' ,['id'=>$np->id, 'slug'=>Str::slug($np->ten)]) }}">{{$np->ten}}</a>
        </h4>
        <p>{{Str::words(strip_tags($np->mota), 7)}}</p>
    </div>
</div>
@endforeach -->