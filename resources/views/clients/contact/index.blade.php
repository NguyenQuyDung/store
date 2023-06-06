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
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Liên Hệ Chúng Tôi</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Liên Hệ</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4" data-aos="zoom-in">
        <h2 class="section-title px-5"><span class="px-2" style="font-family: sans-serif;">Liên Hệ Với Bất Kì Câu Hỏi Nào</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form>
                    <div class="control-group" data-aos="zoom-in">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Điền tên của bạn" required="required" data-validation-required-message="Tên của bạn không được để trống !" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" data-aos="zoom-in">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Điền email của bạn" required="required" data-validation-required-message="Email của bạn không được để trống !" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" data-aos="zoom-in">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại của bạn" required="required" data-validation-required-message="Ngành nghề của bạn không được để trống !" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" data-aos="zoom-in">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Nhập nơi bạn đang sinh sống" required="required" data-validation-required-message="Địa chỉ của bạn không được để trống !" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" data-aos="zoom-in">
                        <input type="text" class="form-control" id="industry" name="industry" placeholder="Nhập thông tin công việc của bạn" required="required" data-validation-required-message="Ngành nghề của bạn không được để trống !" />
                        <p class="help-block text-danger"></p>
                    </div>
                    <div class="control-group" data-aos="zoom-in">
                        <textarea class="form-control" rows="6" id="message" name="message" placeholder="Điền thông tin thắc mắc cần liên hệ giải đáp" required="required" data-validation-required-message="Ý kiến của bạn không được để trống !"></textarea>
                        <p class="help-block text-danger"></p>
                    </div>
                    <div data-aos="zoom-in">
                        <button class="w-100 btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Gửi Đi</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-3" data-aos="zoom-in">Liên Lạc</h5>
            <p data-aos="zoom-in"><b class="text-danger font-weight-bold">(*)</b> Mọi thông tin thắc mắc vui lòng nhập thông tin liên hệ với chúng tôi, mọi thông tin thắc mắc của Qúy Khách sẽ được chúng tôi giải đáp trong thời gian ngắn nhất xin cảm ơn !</p>
            <p data-aos="zoom-in"><b class="text-danger font-weight-bold">(*)</b> Để đảm bảo sự uy tín của chúng tôi về dịch vụ chăm sóc và tư vấn khách hàng về sản phẩm thì Chúng tôi hứa <b class="text-danger">sẽ không chia sẻ bất kì thông tin của bạn </b> cho bất cứ ai !</p>
            <div class="d-flex flex-column mb-3" data-aos="zoom-in">
                <h5 class="font-weight-semi-bold mb-3">Cừa Hàng 1</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Bắc Sơn Sóc Sơn Hà Nội</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>dn5678853@gmail.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+034 591 0508</p>
            </div>
            <div class="d-flex flex-column" data-aos="zoom-in">
                <h5 class="font-weight-semi-bold mb-3">Cửa Hàng 2</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Thanh Trì Hà Nội</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>dunghust2003@gmail.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+037 823 2506</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


<!-- Footer Start -->

@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection