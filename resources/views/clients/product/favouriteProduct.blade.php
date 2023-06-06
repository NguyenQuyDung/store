@extends('layouts.clients.master')
@section('content')
<div class="container-fuild text-center overflow-hidden">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
        <style>
            .category_name {
                background: #009981;
                margin-bottom: 30px;
                display: inline-block;
                height: 35px;
                overflow: hidden;
                border-radius: 100px;
            }

            .name {
                margin: 0 0 0 60px;
                background: #00483d;
                color: #fff;
                font-size: 14px;
                text-transform: uppercase;
                margin-top: -10px;
                padding-bottom: 20px !important;
                padding-top: 11px !important;
            }
        </style>
        @if (Auth::check())
        <div class="category_name col-lg-12 col-md-12 col-sm-12 p-2 mt-5" style="height:45px;padding-top:12px !important;">
            <h4 class="name text-center p-2">Danh Sách Sản Phẩm Yêu Thích</h4>
        </div>
        <div class="container-fluid">
            @if(session('status'))
            <div class="alert alert-success mt-2 mb-2">
                {{session("status")}}
            </div>
            @endif
        </div>
        @foreach ($favouriteProduct as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="zoom-in">
            <div class="d-flex justify-content-around">
                <a href="{{url('xoa-san-pham-yeu-thich',$product->id)}}" class="btn btn-success p-2" style="border-radius:5px;">Xóa</a>
                <a href="{{url('thu-hoi-san-pham-yeu-thich',$product->id)}}" class="btn btn-danger p-2" style="border-radius:5px;">Thu Hồi</a>
                <a href="{{url('chi-tiet-san-pham',$product->slug)}}" class="btn btn-dark p-2" style="border-radius:5px;">Chi Tiết</a>
            </div>
            <div class="card product-item border-0 mb-4">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img style="width:200px !important;" class="img-fluid w-100" src="{{url($product->fature_image_path)}}" alt="">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{$product->name}}</h6>
                    <div class="d-flex justify-content-center">
                        <h6 class="text-danger">{{number_format($product['price'],0,",",".")}} VNĐ</h6>
                        <h6 class="text-muted ml-2"><del>{{number_format($product['price_old'],0,",",".")}} VNĐ</del></h6>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border">
                    <a href="{{url('chi-tiet-san-pham',$product->slug)}}" class="btn btn-sm p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Sản Phẩm</a>
                    <a href="javascript:addCart({{$product->id}})" class="btn btn-sm p-0 show-modal"><i class="fas fa-shopping-cart text-primary mr-1"></i><span data-toggle="modal" data-target="#exampleModal">Thêm Giỏ Hàng</span></a>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="category_name col-lg-12 col-md-12 col-sm-12 p-2 mt-5" style="height:45px;padding-top:12px !important;">
            <h4 class="name text-center p-2">Chưa Có Sản Phẩm Yêu Thích Trên Trang Này !</h4>
        </div>
        @endif

    </div>

</div>
@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection