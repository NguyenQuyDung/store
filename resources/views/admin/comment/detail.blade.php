@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
<!-- Content Wrapper. Contains page content -->
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Chi tiết đánh giá sản phẩm'])


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
                    <div class="card-body">
                        <form action="{{url('reply-comment')}}" method="post">
                            @csrf
                            <table class="table table-striped table-checkall">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            *
                                        </th>
                                        <th scope="col">Tên khách hàng</th>
                                        <th scope="col">Tên sản phẩm</th>
                                        <th scope="col">Ảnh</th>
                                        <th scope="col">Số sao</th>
                                        <th scope="col">Địa chỉ email</th>
                                        <th scope="col">Ngày</th>
                                        <th scope="col">Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>
                                            Chi Tiết
                                        </td>
                                        <td>{{$infordetailComment->name}}</td>
                                        <td><img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($infordetailComment->Product->fature_image_path)}}" alt=""></td>
                                        <td><a href="{{url('chi-tiet-san-pham',$product->slug)}}">{{$infordetailComment->Product->name}}</a></td>
                                        <td> @if ($infordetailComment->rating ==1)
                                            <p class="text-muted text-sm"><b>Số sao: ⭐☆☆☆☆</b></p>
                                            @elseif($infordetailComment->rating ==2)
                                            <p class="text-muted text-sm"><b>Số sao: ⭐⭐☆☆☆</b></p>
                                            @elseif ($infordetailComment->rating ==3)
                                            <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐☆☆</b></p>
                                            @elseif ($infordetailComment->rating ==4)
                                            <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐⭐☆</b></p>
                                            @else
                                            <p class="text-muted text-sm"><b>Số sao: ⭐⭐⭐⭐⭐</b></p>
                                            @endif
                                        </td>
                                        <td>{{$infordetailComment->email}}</td>
                                        <td>{{$infordetailComment->created_at}}</td>
                                        <td>@if ($infordetailComment->status==0)
                                            <b class="text-danger font-weight-bold">Chờ Duyệt</b>
                                            @else
                                            <b class="text-success">Đã Duyệt</b>
                                            @endif
                                        </td>

                                    </tr>
                                    <tr>
                                        <p>Nhận Xét Đánh Giá Của Khách Hàng <b class="text-success font-weight-bold">{{$infordetailComment->name}}</b> Về
                                            Sản Phẩm <b class="text-danger">{{$infordetailComment->Product->name}}</b>
                                        </p>
                                    </tr>
                                    <div class="btn col-md-3 position-relative s" style="border:2px solid red;">
                                        <b class="text-success font-weight-bold">{{$infordetailComment->name}} Đã Đánh Giá: </b>{{$infordetailComment->comment }}
                                    </div>
                                    @if($reply->count())
                                    <div class="ml-5 col-md-6 mt-2" style="border:1px solid green;">
                                        <b class="text-success p-2 font-weight-bold">Phản hồi <b class="text-danger">"HUST"</b> về khách hàng {{$infordetailComment->name}}:</b>
                                        {{$reply->reply_comment}}
                                    </div>
                                    @endif
                                    <div>
                                        <button class="btn h btn-danger col-md-3 mt-2">Vui lòng nhập thông tin phản hồi về khách hàng tại bên dưới !</button>
                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                        <input type="hidden" name="comment_id" value="{{$infordetailComment->id}}">
                                        <input type="text" class="form-control col-md-12 p-2" name="reply" style="padding:30px 10px !important;font-size:18px; margin-top:10px;" placeholder="Nhập thông tin phản hồi khách hàng tại đây !">
                                    </div>
                                </tbody>
                            </table>
                            <table class="table table-stripedv">
                                <button type="submit" class="btn btn-success w-25 pt-2 pb-2">Hoàn Thành</button>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection