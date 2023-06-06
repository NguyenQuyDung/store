@extends('layouts.admin.admin')
@section('content')
@section('title')
<title>Admin</title>
@endsection
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh sách slider'])
    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('slider.create')}}" class="btn btn-success float-right mb-3">Thêm Slider</a>
                </div>
                <div class="card" style="margin-left: 20px;">
                    <div class="card-header font-weight-bold" style="width:1190px;">
                        Danh sách slider
                    </div>
                    <div class="card-body" style="min-height: 500px">
                        <div class="analytic">
                            <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích Hoạt<span class="text-muted">({{$count_public}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô Hiệu Hóa<span class="text-muted">({{$count_trash}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Công Khai<span class="text-muted">({{$count_public}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'pending'])}}" class="text-primary">Chờ Duyệt<span class="text-muted">({{$count_Pending}})</span></a>
                        </div>
                        <form action="{{route('slider.action')}}">
                            <div class="form-action form-inline py-3">
                                <select class="form-control mr-1" id="" name="act">
                                    <option>Chọn</option>
                                    @foreach($list_act as $k => $act)
                                    <option value="{{$k}}">{{$act}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                            </div>
                            @if ($list_sliders->total()>0)
                            <table class="table table-striped table-hover table-checkall">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input name="checkall" type="checkbox">
                                        </th>
                                        <th scope="col" class="text-center">Thứ tự</th>
                                        <th scope="col">Hình ảnh slider</th>
                                        <th scope="col">Tên slider</th>
                                        <th scope="col">Đường dẫn slider</th>
                                        <th scope="col" class="text-center">Trạng thái</th>
                                        <th scope="col" class="text-center">Người tạo</th>
                                        <th scope="col" class="text-center">Ngày tạo</th>
                                        <th scope="col" class="text-center">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_sliders as $item )
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{$item->id}}">
                                        </td>
                                        <th scope="row" class="text-center">{{++$i}}</th>
                                        <td><img height="60" width="60" style="border:2px solid red; border-radius:8px; height:60px !important;" src="{{url($item->image_path)}}" alt="" class="img-fluid"></td>
                                        <td scope="" class="text-center"><span>{{$item->name}}</span></td>
                                        <td scope="" class="text-center"><span>{{$item->slug}}</span></td>
                                        @if($item->status=="Công Khai")
                                        <td><span class="badge p-2 badge-success">{{$item->status}}</span></td>
                                        @else
                                        <td><span class="badge p-2 badge-warning">{{$item->status}}</span></td>
                                        @endif
                                        <td class="text-center"><span>{{$item->user_create}}</span></td>
                                        <td class="text-center"><span>{{$item->created_at}}</span></td>
                                        <td class="d-flex">
                                            <a style="width:30px;" href="{{route('slider.edit',$item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a style="width:30px;" href="{{route('slider.delete',$item->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                            @endif
                        </form>

                    </div>
                    {{$list_sliders->links()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection