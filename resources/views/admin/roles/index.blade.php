@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh sách quyền'])
    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                    <h5 class="m-0 ">Danh sách quyền</h5>
                    <div class="form-search form-inline">
                        <form action="#" class="d-flex">
                            <input type="text" name="keyword" class="form-control form-search" placeholder="Tìm kiếm" value="{{request()->input('keyword')}}">
                            <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Kích Hoạt<span class="text-muted">({{$public}})</span></a>
                        <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Thùng Rác<span class="text-muted">({{$count_trash}})</span></a>
                    </div>
                    <form action="{{route('users.action')}}">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="act">
                                <option>--Chọn--</option>
                                @foreach($list_act as $k => $act)
                                <option value="{{$k}}">{{$act}}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        </div>
                        @if ($list_roles->total()>0)
                        <table class="table table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" name="checkall">
                                    </th>
                                    <th scope="col">STT</th>
                                    <th scope="col">Tên quyền</th>
                                    <th scope="col">Mô tả quyền</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt=0;
                                @endphp
                                @foreach ($list_roles as $user)
                                @php
                                $stt++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$user->id}}">
                                    </td>
                                    <th scope="row">{{$stt}}</th>
                                    <td>{{ $user->name }}</td>
                                    <td style="color:blue">{!!$user->display_name!!}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>
                                        <a href="{{route('roles.edit',$user->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('roles.delete', $user->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$list_roles->links()}}
                        @else
                        <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection