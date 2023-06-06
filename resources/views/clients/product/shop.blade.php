@extends('layouts.clients.master')
@section('content')

<!-- Navbar Start -->
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
    </div>
</div>
<!-- Navbar End -->


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5" data-aos="zoom-in">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Cửa Hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0">Quay lại <a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Mua sắm ngay</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<style>
    .name {
        margin-top: -11px !important;
    }
</style>
<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <div class="border-bottom mb-4 pb-4">
                <div class="category_name col-lg-12 col-md-12 col-sm-12 p-2" style="height:45px;padding-top:12px !important;">
                    <h4 class="name text-center p-2">Sản Phẩm Nổi Bật</h4>
                </div>
                <style>
                    .custom-control .view {
                        transition: 0.5s;
                    }

                    .custom-control .view:hover {
                        color: blueviolet;
                        margin-left: 30px !important;
                    }

                    .box-shadow {
                        background: linear-gradient(-180deg, hsla(0, 0%, 100%, 0) 6%, #fff 83%);
                    }
                </style>
                <div class="box-shadow"></div>
                <form style="margin-left:-28px; height:860px; overflow: hidden;" class="more">
                    @foreach ($List_of_featured_products as $item)
                    <div class="custom-control overflow-hidden custom-checkbox d-flex align-items-center mb-3" data-aos="zoom-in">
                        <img height="80" width="100" src="{{url($item->fature_image_path)}}" alt="">
                        <div>
                            <h6 style="font-size:14px;" class="text-truncate mb-1">{{$item->name}}</h6>
                            <a style="font-size: 13px;padding: 5px 0px !important" href="{{url('chi-tiet-san-pham',$item->slug)}}" class="view btn btn-sm p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Sản Phẩm</a>
                        </div>
                    </div>
                    @endforeach
                </form>
                <button style="padding: 10px 30px;width:100%; border-radius:8px;" type="button" class="btn btn-danger sd read_more">Xem Thêm</button>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <style>
                    .category_name {
                        background: #009981;
                        margin-bottom: 30px;
                        display: inline-block;
                        height: 35px;
                        overflow: hidden;
                        border-radius: 100px;
                    }

                    .category_name:after {
                        content: " ";
                        border-top: 100px solid #00483d;
                        border-left: 30px solid #009981;
                        margin-left: 40px;
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
                @foreach ($categorys as $cat)
                @if ($list_of_product[$cat->id]->count())
                <div class="category_name col-lg-12 col-md-12 col-sm-12 p-2" data-aos="zoom-in">
                    <h4 class="name text-center p-2">Đồ Điện Tử {{$cat->name}}</h4>
                </div>
                @endif
                @foreach ($list_of_product[$cat->id] as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1" data-aos="zoom-in">
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
                @if ($list_of_product[$cat->id]->count())
                <div class="col-12 pb-1 justify-content-center m-auto d-flex ">
                    {{$list_of_product[$cat->id]->links()}}
                </div>
                @endif
                @endforeach
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<style>
    .actived {
        height: auto !important;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.read_more').click(function() {
            if ($(this).text() == 'Xem Thêm') {
                $('.more').addClass('actived');
                $(this).text('Thu Gọn');
            } else {
                $('.more').removeClass('actived');
                $(this).text('Xem Thêm');
            }
        });
    });
</script>
<!-- Shop End -->
@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection