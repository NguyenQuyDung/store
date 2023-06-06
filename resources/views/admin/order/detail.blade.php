@extends('layouts.admin.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<div id="content" class="container" style="margin: 0px auto;
    margin-left: 250px; max-width:1250px;">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex align-items-center">
            <h5 class="m-0 mr-5"><a href="">Thông tin đơn hàng</a></h5>
        </div>
        <div class="card-body" id="detail-order">
            <h5>Thông tin khách hàng</h5>
            <table style="table-layout:auto; width:100%; font-size:14px;" border="1">
                <thead>
                    <tr style="background-color: rgb(236 236 236);">
                        <th class="text-center p-2">Mã Đơn Hàng</th>
                        <th class="text-center p-2">Họ và tên</th>
                        <th class="text-center p-2">Số điện thoại</th>
                        <th class="text-center p-2">Email</th>
                        <th class="text-center p-2">Địa chỉ</th>
                        <th class="text-center p-2">Thời gian đặt hàng</th>
                        <th class="text-center p-2">Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:14%;" class="text-center p-2"><a href="" style="text-transform:uppercase;">{{$list_Cusmtomers->code}}</a></td>
                        <td style="width:10%;" class="text-center p-2">{{$list_Cusmtomers->name}}</td>
                        <td style="width:8%;" class="text-center p-2">{{$list_Cusmtomers->phone_number}}</td>
                        <td style="width:15%;" class="text-center p-2">{{$list_Cusmtomers->email}}</td>
                        <td style="width:30%;" class="text-center p-2">{{$list_Cusmtomers->address}}</td>
                        <td style="width:12%;" class="text-center p-2">{{$list_Cusmtomers->created_at}}</td>
                        <td style="width:10%;">{{$list_Cusmtomers->note}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="  mt-3">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Trạng thái đơn hàng:
                            <span style="font-size: 14px" class="px-1 p-2 bg-info text-light rounded">{{$list_Cusmtomers->status}}</span>
                        </h5>
                        <div class="form-action form-inline py-2">
                            <form action="{{route('order.detail',$list_Cusmtomers->id)}}" method="GET">
                                @csrf
                                <select class="form-control mr-2" name="act">
                                    <option>Chọn</option>
                                    @foreach($list_act as $k => $act)
                                    <option value="{{$k}}">{{$act}}</option>
                                    @endforeach
                                </select>
                                <input type="submit" name="btn-update" value="Cập nhật" style="padding: 5px 8px;border:1px solid rgb(163, 241, 241);color:aliceblue" class="rounded bg-primary">
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <table style="table-layout: fixed;width:100%;font-size:14px" border="1">
                            <thead>
                                <tr style=" background-color:  rgb(236 236 236);">
                                    <th class="text-center p-2">Tổng số lượng</th>
                                    <th class="text-center p-2">Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center p-2">{{$qty}}</td>
                                    <td class="text-center p-2">{{number_format($list_Cusmtomers->total, 0, ',', '.')}}VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 "><a href="">CHI TIẾT ĐƠN HÀNG ĐÃ ĐẶT</a></h5>
        </div>
        <div class="card-body">
            <table style="table-layout: auto;width:100%;font-size:16px;">
                <thead>
                    <tr style="border-bottom: 1px solid gray; background-color: rgb(236 236 236);">
                        <th class="text-center py-2">Ảnh Sản Phẩm</th>
                        <th class="text-center">Tên Sản Phẩm</th>
                        <th class="text-center">Mã Sản Phẩm</th>
                        <th class="text-center">Số Lượng Sản Phẩm</th>
                        <th class="text-center">Giá Sản Phẩm</th>
                        <th class="text-center">Phương Thức Thanh Toán</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderDetail as $order)
                    <tr style="border-bottom: 1px solid rgb(241, 229, 229);">
                        <td style="width:15%;" class="text-center p-2"><img src="{{url($order->images)}}" alt="" class="img-fluid" style="max-width:110px;"></td>
                        <td style="width:30%;" class="text-center">{{$order->nameProduct}}</td>
                        <td style="width:15%;" class="text-center"><a href="" style="text-transform:uppercase;">{{$order->code}}</a></td>
                        <td style="width:15%;" class="text-center">{{$order->qty}}</td>
                        <td style="width:15%;" class="text-center text-bold" style="color:red;">{{number_format($order->price, 0, ',', '.')}}VNĐ</td>
                        <td style="width:30%;" class="text-center">{{$order->payment}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection