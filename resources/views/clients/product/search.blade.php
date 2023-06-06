@extends('layouts.clients.master')
@section('content')

<!-- Navbar Start -->
<div class="container-fluid" data-aos="zoom-in">
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
        <h1 class="font-weight-semi-bold text-uppercase mb-3">{{$query}}</h1>
        <div class="d-inline-flex">
            <p class="m-0">Quay lại <a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Mua sắm ngay</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5" data-aos="zoom-in">
    <div class="row px-xl-5" data-aos="zoom-in">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Sản Phẩm Theo Giá</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">500.000 - 10.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">15.000.000 - 30.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">35.000.000 - 60.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">65.000.000 - 90.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">Giá Nhỏ Hơn 90.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-6">
                        <label class="custom-control-label" for="price-6">Giá Lớn Hơn 90.000.000 <u class="text-danger" style="font-size: 15px;font-weight: 600;">VNĐ</u></label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-8">
                        <label class="custom-control-label" for="price-8">Giá Nhỏ Nhất</label>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-7">
                        <label class="custom-control-label" for="price-7">Giá Lớn Nhất</label>
                    </div>
                </form>
            </div>
            <!-- Price End -->

            <!-- Color Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Lọc Sản Phẩm Theo Hãng</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="color-all">
                        <label class="custom-control-label" for="price-all">All Company</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-1">
                        <label class="custom-control-label" for="color-1">Đồng Hồ Apple</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-2">
                        <label class="custom-control-label" for="color-2">Điện Thoại Iphone</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-3">
                        <label class="custom-control-label" for="color-3">Smart TV</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="color-4">
                        <label class="custom-control-label" for="color-4">Máy Tính LapTop</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="color-5">
                        <label class="custom-control-label" for="color-5">PC Gamming</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                </form>
            </div>
            <!-- Color End -->

            <!-- Size Start -->
            <style>
                .name {
                    margin-top: -11px !important;
                }
            </style>
            <div class="mb-5">
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
                <form style="margin-left:-28px; height:860px; overflow: hidden;" class="more">
                    @foreach ($List_of_featured_products as $item)
                    <div class="custom-control overflow-hidden custom-checkbox d-flex align-items-center mb-3">
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
            <!-- Size End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12" data-aos="zoom-in">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{route('search_product')}}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tìm kiếm tên sản phẩm" name="query">
                                <div class="input-group-append">
                                    <button type="submit" class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Sắp Xếp Theo
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" name="name_asc" href="#">Tên tăng dần</a>
                                <a class="dropdown-item" name="name_desc" href="#">Tên giảm dần</a>
                                <a class="dropdown-item" name="price_asc" href="#">Giá tăng dần</a>
                                <a class="dropdown-item" name="price_desc" href="#">Giá giảm dần</a>
                            </div>
                        </div>
                    </div>
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

                    .cart .cart-icon i {
                        font-size: 60px;
                        display: block;
                        background: transparent linear-gradient(90deg, #009981 0%, #00483d 100%) 0% 0% no-repeat padding-box;
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                    }

                    .icon-cart-index:before {
                        content: '2';
                    }

                    [class*='icon-']:before {
                        display: inline-block;
                        font-family: 'hoangha';
                        font-style: normal;
                        font-weight: normal;
                        line-height: 1;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                    }

                    .cart .cart-icon i {
                        font-size: 60px;
                        display: block;
                        background: transparent linear-gradient(90deg, #009981 0%, #00483d 100%) 0% 0% no-repeat padding-box;
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                    }
                </style>
                <div class="category_name col-lg-12 col-md-12 col-sm-12 p-2">
                    <h4 class="name text-center p-2">Tìm Kiếm Đồ Điện Tử - <span class="font-weight-bold" style="color:#e4a5ab !important;">"{{$query}}"</span></h4>
                </div>
                @if ($results->total()>0)
                @foreach ($results as $product)
                <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
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
                        <a href="javascript:addCart({{$product->id}})" class="btn btn-sm p-0 show-modal"><i class="fas fa-shopping-cart text-primary mr-1"></i><span data-toggle="modal" data-target="#exampleModal">Thêm Giỏ Hàng</span></a>                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-12">
                    <i class="icon-cart-index"></i>
                    <img class="p-3 m-auto d-flex" src="{{asset('img/no-item.png')}}" alt="">
                    <p class="text-center text-dark font-weight-bold">Sản Phẩm <span class="text-danger">"{{$query}}"</span> Không Được Tìm Thấy , Bạn Vui Lòng Nhập Lại Thông Tin Để Tiếp Tục Tìm Kiếm !</p>
                </div>
                @endif
                <div class="col-12 pb-1 justify-content-center m-auto d-flex ">
                    {{$results->links()}}
                </div>
            </div>
        </div>
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
@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection