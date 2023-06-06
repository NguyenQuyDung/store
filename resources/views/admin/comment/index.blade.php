@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh sách đánh giá sản phẩm'])


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
                @foreach ($list_comments as $comment)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0" style=" color: #0fe954 !important; font-size: 18px; font-weight: 500;">
                            Thông Tin Đánh Giá Sản Phẩm Của Khách Hàng
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead">Tên khách hàng: <b style="color:blueviolet;">{{$comment->name}}</b></h2>
                                    <p class="text-muted text-sm" style="color: darkred !important;font-size: 15px !important;"><b>Sản phẩm: </b>{{$comment->Product->name}}</p>
                                    @if ($comment->rating ==1)
                                    <p class="text-muted text-sm"><b>Số sao: ⭐☆☆☆☆</b></p>
                                    @elseif($comment->rating ==2)
                                    <p class="text-muted text-sm"><b>Số sao: ⭐⭐☆☆☆</b></p>
                                    @elseif ($comment->rating ==3)
                                    <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐☆☆</b></p>
                                    @elseif ($comment->rating ==4)
                                    <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐⭐☆</b></p>
                                    @else
                                    <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐⭐⭐</b></p>
                                    @endif
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Email: {{$comment->email}}</li>
                                        <li class="small"><span class="fa-li"></span>Trạng thái comment:
                                            @if ($comment->status==0)
                                            <b class="text-danger font-weight-bold">Chờ Duyệt</b>
                                            @else
                                            <b class="text-success">Đã Duyệt</b>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                @if ($comment->status==0)
                                <a href="{{url('action',$comment->id)}}" class="btn btn-sm bg-teal">
                                    Duyệt Comment
                                </a>
                                @else
                                <a href="{{url('wating',$comment->id)}}" class="btn btn-sm bg-danger">
                                    Chờ Duyệt Comment
                                </a>
                                @endif
                                <a href="{{url('delete-comment',$comment->id)}}" class="btn btn-sm bg-teal">Xóa</a>
                                <a href="{{url('comment-detail',$comment->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> Xem Thêm và Phản Hồi
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{ $list_comments->links() }}
            </div>
        </div>
    </div>
</div>
</div>
@endsection