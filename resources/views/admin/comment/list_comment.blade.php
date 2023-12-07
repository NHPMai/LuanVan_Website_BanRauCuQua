@extends('admin.main')


@section('content')
<!-- <p style="font-weight:bold; font-size: 20px; ">Tổng Số Sản Phẩm: </p> -->
<div id="notify_comment"></div>
<table class="table pt-2">
    <thead style="background-color:blanchedalmond;">
        <tr>
            <th style="width: 30px; text-align: center;vertical-align: middle; border: 1px solid LightGray;">ID</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Tên người bình luận</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Bình luận</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Sản phẩm</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Ngày gửi</th>
            <th style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">Trạng thái</th>

            <th style="width: 100px; text-align: center;vertical-align: middle; border: 1px solid LightGray;">Hành Động</th>
        </tr>
    </thead>
    <tbody>
        @foreach($comment as $key => $comm)
        <tr>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $comm->id }}</td>
            <td style="vertical-align: middle;text-align: center; font-weight:700; font-size:17px; border: 1px solid LightGray;">{{ $comm->bl_ten }}</td>
            <td style="vertical-align: middle;text-align: left; border: 1px solid LightGray;"> {{$comm->binhluan}}
            <p style="margin-bottom: 0px; margin-left: 0px; font-weight:700">Trả lời: </p>
            
                <ul class="list_rep">
                    <style type="text/css">
                        ul.list_rep li {
                            list-style-type: decimal;
                            color: blue;
                            margin: 5px 10px;
                        }
                    </style>

                    @foreach ($comment_rep as $key => $comm_reply)
                        @if($comm_reply->bl_parent == $comm->id)
                            <li>{{$comm_reply->binhluan}}</li>
                         @endif
                    @endforeach
                </ul>

                @if($comm->bl_trangthai == 0)
                <textarea rows="3" class="form-control reply_comment_{{ $comm->id }}"></textarea>
                <button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{$comm->product_id}}" data-comment_id="{{$comm->id}}">Trả lời bình luận</button>
                @endif
            </td>

            <td style="vertical-align: middle;text-align: center; font-weight:600; color:firebrick; border: 1px solid LightGray;">{{ $comm->products->ten }} </td>
            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">{{ $comm->bl_ngay }}</td>

            @if( $comm->bl_trangthai == 1 )
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <input type="button" data-comment_status="0" data-comment_id="{{$comm->id}}" id="{{$comm->product_id}}" class="btn btn-primary btn-xs comment_duyet_btn" value="Duyệt &nbsp">
            </td>
            @else
            <td class="column-6" style="text-align: center;vertical-align: middle; border: 1px solid LightGray;">
                <input type="button" data-comment_status="1" data-comment_id="{{$comm->id}}" id="{{$comm->product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt &nbsp">
            </td>
            @endif

            <td style="vertical-align: middle;text-align: center; border: 1px solid LightGray;">
                <a class="btn btn-primary btn-sm" href="/admin/comments/edit/{{ $comm->id }}">
                    <i class="fas fa-edit"></i>
                </a>

                <a class="btn btn-success btn-sm" href="/admin/comments/unactive/{{$comm->id}}" onclick='return confirm("Bạn chắc chắn xóa bình luận này không?")'>
                    <i class="fas fa-lock-open"></i>
                </a>



            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection