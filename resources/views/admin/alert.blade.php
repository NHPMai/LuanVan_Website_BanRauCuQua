@if ($errors->any())
    <div class="alert alert-danger" style="font-weight: 700; font-size:18px">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (Session::has('error'))
    <div class="alert alert-danger" style="font-weight: 700; font-size:18px">
        {{ Session::get('error') }}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success" style="font-weight: 700; font-size:18px">
        {{ Session::get('success') }}
    </div>
@endif

