@extends('layouts.clients.master')
@section('content')
<div class="container-fluid" data-aos="fade-up" data-aos-anchor-placement="top-center">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
    </div>
</div>
<div class="container m-auto pt-5">
    <div class="section-detail">
        <div class="row">
            <div class="col-12">
                <p class="text-success text-center fw-bold h3 "><i class="fa fa-check-circle" style="font-size:48px;color:green"></i></p>
            </div>
            <div class="col-12">
                <h1 class="text-success text-center fw-bold h4">Đặt hàng thành công!!</h1>
            </div>
            <div class="col-12">
                <p class="text-center h6">Cảm ơn quý khách đã đặt hàng tại ismart của chúng tôi</p>
                <p class="text-center h6">Đội ngũ chăm sóc khách hàng sẽ liên hệ sớm nhất có thể để xác nhận đơn hàng</p>
            </div>
            <div class="col-12">
                <div class="h6 fw-bold">Mã đơn hàng: <b style="text-transform: uppercase;">{{$data['code']}}</b></div>
            </div>
            <div class="col-12">
                <div class="col-12 h6" style="color: green !important;">🔴Thông tin khách hàng</div>
                <table class="table border border-3">
                    <thead>
                        <tr class="text-center border-bottom">
                            <th>Tên khách hàng</th>
                            <th>Địa chỉ</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$data['fullname']}}</td>
                            <td>{{$data['address']}}</td>
                            <td>{{$data['email']}}</td>
                            <td>{{$data['phone']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 mt-4">
                <div class="col-12 h6 " style="color: green !important;">🔴Thông tin khách hàng</div>
                <table class="table table-bordered border border-3">
                    <thead>
                        <tr class="text-center border-bottom">
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt = 0;
                        @endphp
                        @foreach($data['order'] as $item)
                        @php
                        $stt++;
                        @endphp
                        <tr class="border-bottom">
                            <td>
                                <a href="" class="thumb">
                                    <img height="80" class="m-0" src="{{url($item->options->fature_image_path)}}" alt="">

                                </a>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{number_format($item->price,0,' ','.')}} VNĐ</td>
                            <td>{{$item->qty}}</td>
                            <td>{{number_format($item->price* $item->qty,0,' ','.')}} VNĐ</td>

                        </tr>
                        @endforeach
                        <tr>
                            <th class="text-end text-danger" colspan="10">Tổng: {{$data['total']}} VNĐ</th>
                        </tr>
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    <button class="btn btn-danger"><a href="{{url('trang-chu')}}" class="" style="color:aliceblue;">Về Trang Chủ</a></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection