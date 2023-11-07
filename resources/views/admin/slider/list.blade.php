@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th style="width: 50px">ID</th>
                <th style="text-align: center;vertical-align: middle;">Tiêu Đề</th>
                <th style="text-align: center;vertical-align: middle;">Link</th>
                <th style="text-align: center;vertical-align: middle;">Ảnh</th>
                <th style="text-align: center;vertical-align: middle;">Trạng Thái</th>
                <th style="text-align: center;vertical-align: middle;">Cập Nhật</th>
                <th style="text-align: center;vertical-align: middle;">Hành Động</th>
            </tr>
        </thead>
        <tbody>
                @foreach($sliders as $key => $slider)
                <tr>
                    <td style="text-align: center;vertical-align: middle;">{{ $slider->id }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $slider->name }}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $slider->url }}</td>
                    <td style="text-align: center;vertical-align: middle;"><a href="{{ $slider->thumnb }}" target="_blank">
                            <img src="{{ $slider->thumnb }}" height="40px">
                        </a>
                    </td>
                    <td style="text-align: center;vertical-align: middle;">{!! \App\Helpers\Helper::active($slider->active) !!}</td>
                    <td style="text-align: center;vertical-align: middle;">{{ $slider->updated_at }}</td>
                    <td style="text-align: center;vertical-align: middle;">
                        <a class="btn btn-primary btn-sm" href="/admin/sliders/edit/{{ $slider->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" 
                            onclick="removeRow({{$slider->id}},'/admin/sliders/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        
                    </td>
                </tr>
                @endforeach
        </tbody>
    </table>


    {!! $sliders->links() !!}
@endsection
