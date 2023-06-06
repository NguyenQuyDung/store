@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @if(session('status'))
    <div class="alert alert-success mt-2 mb-2">
        {{session("status")}}
    </div>
    @endif
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thống Kê Doanh Số'])
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid pt-0">
            <div class="row">
                <div class="col">
                    <a href="">
                        <div class="card text-white bg-primary mb-3" style="max-width: 18rem; height:200px;">
                            <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_complete}}</h5>
                                <p class="card-text mt-2" style="font-size:20px;">Đơn hàng thành công</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="">
                        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;height:200px;">
                            <div class="card-header">ĐANG XỬ LÝ</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_completesss}}</h5>
                                <p class="card-text mt-2" style="font-size:20px;">Đơn hàng đang xử lý</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col">
                    <div class="card text-white bg-success mb-3" style="max-width: 18rem;height:200px;">
                        <div class="card-header">DOANH SỐ</div>
                        <div class="card-body">
                            @if($revenue < 1) <h5 class="card-title">0<span>Đ</span></h5>
                                @elseif($revenue < 999) <h5 class="card-title">{{number_format($revenue, 0, ',', '.')}}.000.000 <span> VND</span></h5>
                                    @else
                                    <h5 class="card-title">{{number_format($revenue, 0, ',', '.')}}.000.000<span>VND</span></h5>
                                    @endif
                                    <p class="card-text mt-2" style="font-size:20px;">Doanh số hệ thống</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <a href="">
                        <div class="card text-white mb-3" style="max-width: 18rem; background-color:blueviolet;height:200px;">
                            <div class="card-header">ĐƠN HÀNG ĐANG VẬN CHUYỂN</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_completes}}</h5>
                                <p class="card-text mt-2" style="font-size:20px;">Đang vận chuyển</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col" style="padding-left:0px;">
                    <a href="">
                        <div class="card text-white bg-dark mb-3" style="max-width: 18rem;height:200px;">
                            <div class="card-header">ĐƠN HÀNG HỦY</div>
                            <div class="card-body">
                                <h5 class="card-title">{{$count_completess}}</h5>
                                <p class="card-text mt-2" style="font-size:20px;">Đơn hủy trong hệ thống</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- end analytic  -->
            <div class="card">
                <div class="card-header font-weight-bold">
                    THÔNG TIN KHÁCH HÀNG ĐÃ MUA SẢN PHẨM
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã Khách hàng</th>
                                <th scope="col">Khách hàng</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Tổng Giá</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thời gian</th>
                                <th scope="col">Chi Tiết</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lists as $list)
                            <tr>
                                <th scope="row">10</th>
                                <td><a href="" style="text-transform:uppercase; color:black;">{{$list->code}}</a></td>
                                <td>
                                    {{ $list->name }}
                                </td>
                                <td>{{$list->phone_number}}</td>
                                <td>{{number_format($list->total,0,' ','.')}} VNĐ</td>
                                @if ($list->status == 'Hoàn Tất')
                                <td class="">
                                    <span class="badge badge-success p-1">{{ $list->status }}</span>
                                </td>
                                @elseif($list->status == 'Đang Xử Lý')
                                <td><span class="badge badge-warning p-1">{{$list->status}}</span></td>
                                @elseif ($list->status == 'Đang Vận Chuyển')
                                <td class="text-success"><span class="p-1 badge badge-info">{{ $list->status }}</span></td>
                                @elseif ($list->status == 'Hủy Đơn Hàng')
                                <td class="text-success"><span class="p-1 badge badge-dark">{{ $list->status }}</span></td>
                                @endif
                                <td>{{$list->created_at}}</td>
                                <td class="pl-4">
                                    <a href="{{route('order.detail',$list->id)}}" style="border: 1px solid royalblue;padding:6px; background:aliceblue; border-radius:10px;" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-ellipsis-h" style="color:blue;" aria-hidden="true"></i></a>

                                </td>
                                <td class="pl-4">
                                    <a style="width:30px;" href="{{route('order.delete',$list->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection