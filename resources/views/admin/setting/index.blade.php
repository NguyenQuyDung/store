@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Settings'])
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
                    <style>
                        .analytic a {
                            padding: 0px 2px;
                        }
                    </style>
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Thêm Settings
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a href="{{route('setting.add').'?type=Text'}}"><button class="dropdown-item" type="button">Text</button></a>
                                <a href="{{route('setting.add').'?type=Textarea'}}"><button class="dropdown-item" type="button">Textarea</button></a>

                            </div>
                        </div>
                    </div>
                    <form action="{{route('posts.action')}}">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="act">
                                <option>Chọn</option>

                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        </div>
                        @if ($settings->total()>0)
                        <table class="table table-hover table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Config key</th>
                                    <th scope="col">Config value</th>
                                    <th scope="col">Thời Gian Thêm</th>
                                    <th scope="col">Người Thêm</th>
                                    <th scope="col">Trạng Thái</th>
                                    <th scope="col">Tác Vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($settings as $item )
                                <tr>
                                    <th>{{$item->id}}</th>
                                    <td>{{$item->config_key}}</td>
                                    <td>{!!$item->config_value!!}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->user_create}}</td>
                                    @if($item->status=='Chờ Duyệt')
                                    <td style="line-height: 2;" class="badge-warning badge">{{$item->status}}</td>
                                    @else
                                    <td style="line-height: 2;" class="badge badge-success">{{$item->status}}</td>
                                    @endif
                                    <td>
                                        <a style="width:30px;" href="{{route('setting.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a style="width:30px;" href="{{route('setting.delete',$item->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$settings->links()}}
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