@extends('layouts.clients.master')
@section('content')
<style>
    .swiper {
        width: 100%;
        height: 100%;
    }

    label {
        color: darkred;
        display: inline-block;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .rate {
        float: left;
        height: 46px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        height: 80%;
        width: 100%;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-button-prev:after,
    .swiper-button-next:after {
        color: black;
        font-size: 28px;
        opacity: 0.8;
        font-weight: bold;
    }
</style>
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
    </div>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Chi Tiết Sản Phẩm</h1>
            <p class="text-danger">{{$product->name}}</p>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Trang Chủ</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Chi Tiết Sản Phẩm</p>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border ">
                        <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2">
                            <div class="swiper-wrapper">
                                @foreach ($product->ProductImage as $key => $img)
                                <div class="swiper-slide {{$key==0?'active':''}}">
                                    <img class="w-50" style="margin-left:30px; height:300px;" src="{{url($img->image_path)}}" alt="Image">
                                </div>
                                @endforeach
                            </div>
                            <div class="swiper-button-next font-weight-bold"></div>
                            <div class="swiper-button-prev font-weight-bold"></div>
                        </div>
                        <div thumbsSlider="" class="swiper mySwiper">
                            <div class="swiper-wrapper justify-content-between">
                                @foreach ($product->ProductImage as $key => $img)
                                <div class="swiper-slide">
                                    <img class="w-75 h-75" src="{{url($img->image_path)}}" alt="Image">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{$product->name}}</h3>
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2">
                        @if ($rating ==1)
                        <small class="text-muted text-sm" style="font-size:20px;"><b>⭐☆☆☆☆</b></small>
                        @elseif($rating==2)
                        <small class="text-muted text-sm" style="font-size:20px;"><b>⭐⭐☆☆☆</b></small>
                        @elseif ($rating==3)
                        <small class="text-muted text-sm" style="font-size:20px;"><b>⭐⭐⭐☆☆</b></small>
                        @elseif ($rating==4)
                        <small class="text-muted text-sm" style="font-size:20px;"><b>⭐⭐⭐⭐☆</b></small>
                        @elseif ($rating==5)
                        <small class="text-muted text-sm" style="font-size:20px;"><b>⭐⭐⭐⭐⭐</b></small>
                        @else
                        <small class="text-muted text-sm" style="font-size:20px;"><b>☆☆☆☆☆</b></small>
                        @endif
                    </div>
                    <small class="pt-1">({{ $comments->count() }} Đánh giá)</small>
                    <!-- <div class="text-primary mr-2">
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star"></small>
                        <small class="fas fa-star-half-alt"></small>
                        <small class="far fa-star"></small>
                    </div>
                    <small class="pt-1">(50 Đánh giá)</small> -->
                </div>
                <h3 class="font-weight-semi-bold mb-4 text-danger">{{number_format($product['price'],0,",",".")}} VNĐ</h3>
                <p class="mb-4">{!!$product->content!!}</p>
                <!-- <form action="{{url('them-san-pham',$product->slug)}}"> -->
                <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                @if (Auth::check())
                <a href="{{route('addfavoriteproduct', $product->id)}}" class="btn btn-danger px-3 addFavorite"> <i class="fas fa-heart text-lights pr-2"></i></i>Yêu Thích
                    sản phẩm</a>
                @else
                <a href="#?" class="btn btn-danger px-3 error"> <i class="fas fa-heart text-lights pr-2"></i></i>Yêu Thích
                    sản phẩm</a>
                @endif
                <form action="{{url('them-san-pham/'.$product->slug)}}">
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 150px;">
                            <!-- <div class="input-group-btn">
                                <button class="btn btn-danger btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div> -->
                            <b style="color: white;font-family: sans-serif" class="btn btn-danger mb-2">Số Lượng Thêm: </b> <br><input type="number" style="font-size: 18px; height: 39px;color: red; padding: 10px 15px;font-weight: 700;" class="form-control bg-secondary text-center" name="qty" value="1">
                            <!-- <div class="input-group-btn">
                                <button class="btn btn-danger btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div> -->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger px-3"><i class="fa fa-shopping-cart mr-1"></i> Thêm Giỏ Hàng</button>
                </form>
                <div class="d-flex pt-2">
                    <p class="text-dark font-weight-medium mb-0 mr-2">Chia sẻ trên:</p>
                    <div class="d-inline-flex">
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Mô Tả</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">Thông Tin</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Đánh Giá Sản Phẩm (0)</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">{{$product->name}}</h4>
                        <p>{!! $product->content !!}.</p>
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

                        .list-group {
                            margin: 0px auto;
                            display: flex;
                            flex-direction: column;
                            padding-left: 0;
                            margin-bottom: 0;
                            max-width: 1000px;
                        }
                    </style>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-3 text-center">{{$product->name}}</h4>
                                <ul class="list-group list-group-flush more" style="height:860px; overflow: hidden;">
                                    <li class="list-group-item px-0 ">
                                        {!! $product->content_detail !!}
                                    </li>
                                </ul>
                            </div>
                            <button style="padding: 10px 30px; z-index:3;margin: 0px auto;border-radius: 8px; color:rebeccapurple; background: bottom;border: 1px solid;" type="button" class="btn btn-danger sd read_more">Xem Thêm</button>
                            <div style="height: 300px;z-index:0;  position: absolute;bottom: 66px;width: 100%; left: 0;background: linear-gradient(-180deg,hsla(0,0%,100%,0) 6%,#fff 83%);top: 700px;">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4" style="font-size: 18px !important;">Đánh giá sao cho sản phẩm <b class=" text-danger font-weight-bold">"{{ $product->name }}"</b></h4>
                                @foreach ($comments as $comment)
                                <div class="media mb-4">
                                    <img src="{{asset('img/no-avt.png')}}" alt="Image" class="img-fluid mr-3 mt-1" style="width: 50px; height:50px; border-radius:8px;border: 2px solid greenyellow;">
                                    <div class="media-body">
                                        <h6 class="mb-0">{{$comment->name}}<small> - <i>{{$comment->created_at}}</i></small></h6>
                                        <div class="text-primary">
                                            @if ($comment->rating ==1)
                                            <p class="text-muted text-sm mb-0"><b>⭐☆☆☆☆</b></p>
                                            @elseif($comment->rating ==2)
                                            <p class="text-muted text-sm mb-0"><b>⭐⭐☆☆☆</b></p>
                                            @elseif ($comment->rating ==3)
                                            <p class="text-muted text-sm mb-0"><b>⭐⭐⭐☆☆</b></p>
                                            @elseif ($comment->rating ==4)
                                            <p class="text-muted text-sm mb-0"><b>⭐⭐⭐⭐☆</b></p>
                                            @else
                                            <p class="text-muted text-sm mb-0"><b>⭐⭐⭐⭐⭐</b></p>
                                            @endif
                                        </div>
                                        <p class="mb-0" style="font-size: 14px;color: darkblue;">{{$comment->comment}}</p>
                                        @foreach ($replyComments as $rep)
                                        <div class="reply m-2" style="margin-left:00px !important; border-left:1px solid green;">
                                            <p class="mb-0 ml-3"><b class="text-danger">HUST</b><small class="text-success font-weight-bold pl-2 pr-2">Nguyễn Qúy Dũng</small>
                                                <small>{{ $rep->created_at }}</small>
                                                <br>
                                            <p><img style="height:80px;" src="{{asset('img/aminn.jpg')}}" alt=""> <b style="font-weight: 400;color: indigo;font-size: 15px;">{{$rep->reply_comment}}</b></p>
                                            </p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Để lại đánh giá</h4>
                                <small>Địa chỉ email của bạn sẽ không được công bố. Các trường bắt buộc được đánh dấu *</small>
                                <form method="POST">
                                    @csrf
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2" style="line-height:3;">Số sao * :</p>
                                        <div class="rating rate">
                                            <input type="hidden" name="product_id" class="product_id" value="{{$product->id}}">
                                            <input type="radio" id="star5" name="rate" value="5" class="star" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="rate" value="4" class="star" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="rate" value="3" class="star" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="rate" value="2" class="star" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="rate" value="1" class="star" />
                                            <label for="star1" title="text">1 stars</label>
                                        </div>
                                        <p class="rating-value" style="line-height:3; color:red; font-weight:bold;"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="message">Đánh giá của bạn *</label>
                                        <textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Tên của bạn *</label>
                                        <input type="text" name="name" class="form-control" id="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email của bạn *</label>
                                        <input type="email" name="email" class="form-control" id="email">
                                    </div>
                                    @if (Auth::check())
                                    <div class="form-group mb-0">
                                        <input type="button" value="Đánh Giá" class="btn btn-danger text-light w-100 p-2 px-3 send-infor">
                                    </div>
                                    @else
                                    <div class="form-group mb-0">
                                        <input type="button" disabled style="cursor: no-drop;" value="Bạn Cần Đăng Nhập Mới Có Thể Thực Thi Thao Tác Này !" class="btn btn-danger text-light w-100 p-2 px-3">
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid py-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Sản Phẩm Liên Quan</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($demo as $item)
                    <div class="card product-item border-0">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-75" src="{{url($item->fature_image_path)}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$item->name}}</h6>
                            <div class="d-flex justify-content-center">
                                <h6 class="text-danger">{{number_format($product['price'],0,",",".")}} VNĐ</h6>
                                <h6 class="text-muted ml-2"><del>{{number_format($product['price_old'],0,",",".")}} VNĐ</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{url('chi-tiet-san-pham',$item->slug)}}" class="btn btn-sm p-0"><i class="fas fa-eye text-primary mr-1"></i>Xem Sản Phẩm</a>
                            <a href="" class="btn btn-sm p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Thêm Giỏ Hàng</a>
                        </div>
                    </div>
                    @endforeach
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
<script>
    const radioElement = document.querySelectorAll('input');

    const rating = document.querySelector('.rating-value');

    radioElement.forEach((radio) => {
        radio.addEventListener('click', () => {
            let value = radio.value;
            rating.innerText = `Đánh giá ${value} trong 5`;
        });
    });
</script>
@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection