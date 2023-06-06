<div class="container-fluid mb-5" style="z-index: 0;">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.menu-category')
        <style>
            .carousel-caption {
                background: rgb(71 11 11 / 18%) !important;
            }

            .carousel-item {
                overflow: hidden;
                transition: 0.6s;
            }

            .carousel-item:hover {
                transform: scale(1.2) !important;
            }
        </style>
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
            <div id="header-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" style="border-radius: 5px;box-shadow: #a2aed4 0px 7px 29px 0px;">
                    <div class="carousel-item active" style="height: 410px;">
                        <img class="img-fluid" src="{{url($list_sliders->image_path)}}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Giảm Giá Cho Đơn Hàng Của Bạn</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Đồ Điện Tử</h3>
                                <a href="" class="btn btn-light py-2 px-3">Sắm Ngay</a>
                            </div>
                        </div>
                    </div>
                    @foreach ($sliders as $Slider)
                    <div class="carousel-item" style="height: 410px;">
                        <img class="img-fluid" src="{{url($Slider->image_path)}}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 700px;">
                                <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Giảm Giá Cho Đơn Hàng Của Bạn</h4>
                                <h3 class="display-4 text-white font-weight-semi-bold mb-4">Đồ Điện Tử</h3>
                                <a href="" class="btn btn-light py-2 px-3">Sắm Ngay</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                    <div class="btn btn-dark" style="width: 40px;height: 35px;">
                        <span class="carousel-control-prev-icon mb-n2"></span>
                    </div>
                </a>
                <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                    <div class="btn btn-dark" style="width: 40px;height: 35px;">
                        <span class="carousel-control-next-icon mb-n2"></span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>