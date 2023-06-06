@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Cập nhật thành viên'])
    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
    </div>
    <div class="content">
        <style>
            .select2-container--default .select2-selection--multiple .select2-selection__choice {
                background-color: black !important;
                border: 1px solid #aaa;
                border-radius: 4px;
                box-sizing: border-box;
                display: inline-block;
                margin-left: 5px;
                margin-top: 5px;
                padding: 0;
                padding-left: 20px;
                position: relative;
                max-width: 100%;
                overflow: hidden;
                text-overflow: ellipsis;
                vertical-align: bottom;
                white-space: nowrap;
            }
        </style>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Cập nhật thành viên
                </div>
                <div class="card-body">
                    <form action="{{route('users.update', $find_id->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Họ và tên</label>
                            <input class="form-control" value="{{$find_id->name}}" type="text" name="name" id="name" value="">
                            @error('name')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" value="{{$find_id->email}}" type="text" name="email" id="email">
                            @error('email')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input class="form-control" type="password" name="password" id="email">
                            @error('password')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Xác Nhận Mật khẩu</label>
                            <input class="form-control" type="password" name="password_confirm" id="email">
                            @error('password_confirm')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nhóm quyền</label>
                            <select name="role_id[]" class="form-control select2" id="" multiple>
                                <option>Chọn quyền</option>
                                @foreach ($roles as $role)
                                <option {{$roleOfUser->contains('id',$role->id )?'selected':''}} value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                            @error('image')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" value="CẬP NHẬT" class="btn btn-primary" name="btn_add">Cập nhật thành viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2({
            tags: true,
            tokenSeparators: [',']
        });
    });
</script>
@endsection