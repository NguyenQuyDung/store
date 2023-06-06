@extends('layouts.admin.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh sách sản phẩm'])
    <div class="container-fluid">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
        <div id="content">
            <div id="content" class="container-fluid">
                <div class="card">
                    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                        <h5 class="m-0 ">Danh sách bài viết</h5>
                        <div class="form-search form-inline">
                            <form action="#" class="d-flex float-right">
                                <input type="text" name="keyword" value="{{request()->input('keyword')}}" style="width:500px; margin-right:5px;" class="form-control form-search" placeholder="Tìm kiếm">
                                <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="analytic">
                            <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích Hoạt<span class="text-muted">({{$count_public}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô Hiệu Hóa<span class="text-muted">({{$count_trash}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Công Khai<span class="text-muted">({{$count_public}})</span></a>-
                            <a href="{{request()->fullUrlWithQuery(['status'=>'pending'])}}" class="text-primary">Chờ Duyệt<span class="text-muted">({{$count_Pending}})</span></a>
                        </div>
                        <form action="{{route('posts.actionposts')}}">
                            <div class="form-action form-inline py-3">
                                <select class="form-control mr-1" id="" name="act">
                                    <option>Chọn</option>
                                    @foreach($list_act as $k => $act)
                                    <option value="{{$k}}">{{$act}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                            </div>
                            @if($list_posts->total()>0)
                            <table class="table table-striped table-hover table-checkall">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input name="checkall" type="checkbox">
                                        </th>
                                        <th scope="col">#</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Tiêu đề</th>
                                        <th scope="col">Danh mục</th>
                                        <th scope="col">Ngày tạo</th>
                                        <th scope="col">Người tạo</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Tác vụ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list_posts as $value)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="list_check[]" value="{{$value->id}}">
                                        </td>
                                        <td scope="row">{{++$i}}</td>
                                        <td><img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($value->image_path)}}" alt=""></td>
                                        <td><a href="" style="overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    line-height: 3.5;
    width: 500px;">{{$value->name}}</a></td>
                                        <td>{{$value->categorypost->name}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td style="color: blue;font-weight: 800;">{{$value->user_create}}</td>
                                        @if($value->status=='Chờ Duyệt')
                                        <td style="margin-top: 20px;" class="badge-warning badge">{{$value->status}}</td>
                                        @else
                                        <td style="margin-top: 20px;" class="badge badge-success">{{$value->status}}</td>
                                        @endif
                                        <td>
                                            <a style="width:30px;" href="{{route('posts.edit', $value->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                            <a style="width:30px;" href="{{route('posts.delete',$value->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$list_posts->links()}}
                            @else
                            <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection