@extends('admin.main')

<style>
    th,
    td {
        border: 1px solid LightGray;
    }
</style>
@section('content')
<table class="table pt-2" id="myTable">
    <thead style="background-color:blanchedalmond;">
        <tr>
            <th style="width: 50px;text-align: center;">ID</th>
            <th style="text-align: center;">Tên</th>
            <th style="text-align: center;">Trạng thái</th>
            <th style="text-align: center;">Ngày cập nhật</th>
            <th style="text-align: center;">Hành Động</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        {!! \App\Helpers\Helper::menu($menus) !!}
    </tbody>
</table>
@endsection