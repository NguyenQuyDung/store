@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh Mục Sản Phẩm'])


    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
    </div> <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('categories.create')}}" class="btn btn-success float-right mb-3">Thêm Danh Mục</a>
                </div>
                <div class="col-md-12">
                    @if($count>0)
                    <style>
                        .analytic a {
                            padding: 0px 2px;
                        }
                    </style>
                    <div class="analytic">
                        <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích Hoạt<span class="text-muted">({{$count_public}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô Hiệu Hóa<span class="text-muted">({{$count_trash}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Công Khai<span class="text-muted">({{$count_public}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'pending'])}}" class="text-primary">Chờ Duyệt<span class="text-muted">({{$count_Pending}})</span></a>
                    </div>
                    <form action="{{route('categories.action')}}">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="act">
                                <option>Chọn</option>
                                @foreach($list_act as $k => $act)
                                <option value="{{$k}}">{{$act}}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        </div>
                        <table class="table table-hover table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Danh Mục</th>
                                    <th scope="col">Đường Link</th>
                                    <th scope="col">Thời Gian Thêm</th>
                                    <th scope="col">Người Thêm</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Tác Vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt=0;
                                @endphp
                                @foreach ($list_categories as $item )
                                @php
                                $stt++;
                                @endphp
                                <tr>
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$item->id}}">
                                    </td>
                                    <th scope="row">{{++$i}}</th>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->slug}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td class="text-primary font-weight-bolder">{{$item->user_create}}</td>
                                    @if($item->status=='Chờ Duyệt')
                                    <td style="line-height: 2;" class="badge-warning badge">{{$item->status}}</td>
                                    @else
                                    <td style="line-height: 2;" class="badge badge-success">{{$item->status}}</td>
                                    @endif
                                    <td>  
                                        <a style="width:30px;" href="{{route('categories.edt_cat', $item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a style="width:30px;" href="{{route('categories.delete_cat',$item->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$list_categories->links()}}
                        @else
                        <p class="alert alert-danger">Chưa có danh mục sản phẩm trên trang này !</p>
                        @endif
                    </form>

                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection