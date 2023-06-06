@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh sách sản phẩm'])
    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="">
                <div class="border-primary font-weight-bold d-flex justify-content-between align-items-center">
                    <div class="col-md-6">
                        <a href="{{route('products.add')}}" class="btn btn-success">Thêm sản phẩm</a>
                    </div>
                    <div class="form-search form-inline col-md-6 float-right">
                        <form action="#" class="d-flex ">
                            <input type="text" name="keyword" style="width:500px; margin-right:5px;" value="{{request()->input('keyword')}}" class="form-control form-search" placeholder="Tìm kiếm">
                            <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Còn Hàng<span class="text-muted">({{$count_public}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô Hiệu Hóa<span class="text-muted">({{$count_trash}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Công Khai<span class="text-muted">({{$count_public}})</span></a>-
                        <a href="{{request()->fullUrlWithQuery(['status'=>'pending'])}}" class="text-primary">Chờ Duyệt<span class="text-muted">({{$count_Pending}})</span></a>
                    </div>
                    <form action="{{route('posts.actionproduct')}}">
                        <div class="form-action form-inline py-3">
                            <select class="form-control mr-1" id="" name="act">
                                <option>Chọn</option>
                                @foreach($list_act as $k => $act)
                                <option value="{{$k}}">{{$act}}</option>
                                @endforeach
                            </select>
                            <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                        </div>
                        @if ($list_products->total()>0)
                        <table class="table table-hover table-striped table-checkall">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        <input name="checkall" type="checkbox">
                                    </th>
                                    <th scope="col">#</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Người tạo</th>
                                    <th scope="col">Ngày tạo</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_products as $item )
                                <tr class="">
                                    <td>
                                        <input type="checkbox" name="list_check[]" value="{{$item->id}}">
                                    </td>
                                    <td>{{++$i}}</td>
                                    <td><img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($item->fature_image_path)}}" alt=""></td>
                                    <td><a href="#">{{$item->name}}</a></td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->category->name}}</td>
                                    <td>{{$item->user_create}}</td>
                                    <td>{{$item->created_at}}</td>
                                    @if($item->statusactive=="Còn Hàng")
                                    <td><span class="badge p-2 badge-success">{{$item->statusactive}}</span></td>
                                    @else
                                    <td><span class="badge p-2 badge-warning">{{$item->statusactive}}</span></td>
                                    @endif
                                    <td>
                                        <a href="{{route('products.edit', $item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="{{route('products.delete',$item->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$list_products->links()}}
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