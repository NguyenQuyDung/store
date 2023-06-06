@extends('layouts.clients.master')
@if(session('status'))
<div class="alert alert-danger mt-2 mb-2">
    {{session("status")}}
</div>
@endif
@section('content')
@include('layouts.clients.compoments.slider-category')
<div class="container-fluid pt-5">
    <div class="row px-xl-5 pb-3">
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="d-flex align-items-center border mb-4" style="padding: 20px;">
                <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">Chất Lượng Sản Phẩm</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="d-flex align-items-center border mb-4" style="padding: 20px;">
                <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                <h5 class="font-weight-semi-bold m-0">Miễn Phí Vận Chuyển</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="d-flex align-items-center border mb-4" style="padding: 20px;">
                <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">14-Ngày Đổi Trả</h5>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-anchor-placement="bottom-bottom">
            <div class="d-flex align-items-center border mb-4" style="padding: 20px;">
                <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                <h5 class="font-weight-semi-bold m-0">24/7 Hỗ Trợ</h5>
            </div>
        </div>
    </div>
</div>
<!-- Featured End -->
<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Nổi Bật</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        <style>
        </style>
        @foreach ($List_of_featured_products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1" data-aos="fade-up" data-aos-duration="2000">
            <div class="card product-item border-0 mb-4" data-aos="zoom-in-down">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{url($product->fature_image_path)}}" title="{{$product->name}}">
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
    </div>
</div>
<!-- Products End -->
<!--{{url('them-san-pham',$product->slug)}} 
    javascript:addCart({{$product->id}}) -->

<!-- Offer Start -->
<div class="container-fluid offer pt-5" data-aos="fade-up" data-aos-anchor-placement="top-center">
    <div class="row px-xl-5">
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-right text-white mb-2 py-5 px-5">
                <img src="img/offer-1.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">GIẢM GIÁ 20% TẤT CẢ ĐƠN HÀNG</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ Sưu Tập Máy Lạnh</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Đến Ngay</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 pb-4">
            <div class="position-relative bg-secondary text-center text-md-left text-white mb-2 py-5 px-5">
                <img src="img/offer-2.png" alt="">
                <div class="position-relative" style="z-index: 1;">
                    <h5 class="text-uppercase text-primary mb-3">GIẢM GIÁ 20% TẤT CẢ ĐƠN HÀNG</h5>
                    <h1 class="mb-4 font-weight-semi-bold">Bộ Sưu Tập Điện Thoại</h1>
                    <a href="" class="btn btn-outline-primary py-md-2 px-md-3">Đến Ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Offer End -->





<!-- Products Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Mới</span></h2>
    </div>
    <div class="row px-xl-5 pb-3">
        @foreach ($new_products as $product)
        <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
            <div class="card product-item border-0 mb-4" data-aos="fade-up" data-aos-anchor-placement="top-center">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid" src="{{url($product->fature_image_path)}}" alt="">
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
        <div class="col-12 justify-content-center m-auto d-flex pb-1">
            {{$new_products->links()}}
        </div>
    </div>
</div>
<!-- Products End -->

<!-- Subscribe Start -->
<div class="container-fluid bg-secondary my-5" data-aos="fade-up" data-aos-anchor-placement="top-center">
    <div class="row justify-content-md-center py-5 px-xl-5">
        <div class="col-md-6 col-12 py-5">
            <div class="text-center mb-2 pb-2">
                <h2 class="section-title px-5 mb-3" style="font-family: sans-serif;"><span class="bg-secondary px-2">Cập Nhật Sản Phẩm Qua</span></h2>
                <p style="font-family: sans-serif;">Vui lòng điền thông tin bên dưới để biết thêm thông tin của sản phẩm của chúng tôi <span class="text-danger font-weight-bold" style="font-size: 20px;">Xin Cảm Ơn</span>....</p>
            </div>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control border-white p-4" placeholder="Email của bạn !">
                    <div class="input-group-append">
                        <button class="btn btn-primary px-4">Hoàn Tất</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Subscribe End -->


<!-- Vendor Start -->
<div class="container-fluid py-5" data-aos="fade-up" data-aos-anchor-placement="top-center">
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel vendor-carousel">
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo1.jpg')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo2.png')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo3.png')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo4.jpg')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo5.png')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo6.jpg')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo7.png')}}" alt="">
                </div>
                <div class="vendor-item border p-4">
                    <img src="{{asset('img/logo8.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Vendor End -->
<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@endsection
<!-- Footer Start -->
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection

<!-- Footer End -->