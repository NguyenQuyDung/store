@extends('layouts.clients.master')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid" data-aos="fade-up" data-aos-anchor-placement="top-center">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
    </div>
</div>
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Giỏ Hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Giỏ Hàng</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 mb-5 select-items">
            @if(session('success'))
            <div class="alert alert-success mt-2 mb-2 " style="width:100%; font-size:14px; color:greenyellow;">
                {{session("success")}}
            </div>
            @endif
            @if(Cart::count()>0)
            @csrf
            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
            <button class="btn btn-info mb-2" onclick="confirm('Bạn Chắc Chắc Có Muốn Xóa Toàn Bộ Sản Phẩm Trong Giỏ Hàng Không ?')===true?destroyCart():''">Xóa Toàn Bộ Sản Phẩm Trong Giỏ Hàng</button>
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Sản Phẩm</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @php
                    $stt = 0;
                    @endphp
                    @foreach(Cart::content() as $cart)
                    @php
                    $stt++;
                    @endphp
                    <tr data-rowId="{{$cart->rowId}}">
                        <td class="align-middle"><img height="70" src="http://localhost/unitop.vn/back-end/Unimart.com/Unimart.com/{{$cart->options->fature_image_path}}"></td>
                        <td class="align-middle"><a href="{{url('san-pham')}}" class="text-decoration-none">{{$cart->name}}</a></td>
                        <td class="align-middle text-danger product-seleted">{{number_format($cart->price,0,",",".")}} VNĐ</td>
                        <td class="align-middle">
                            <input type="hidden" class="product_id" value="{{$cart->rowId}}">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-minus changeQuantity">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary text-center number_order" data-id="{{$cart->rowId}}" data-rowid="[{{$cart->rowId}}]" value="{{$cart->qty}}" name="num-order-cart" data-url="{{route('ajax_shopping_cart')}}" style="height:24px;" minlength="1" maxlength="10">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-primary btn-plus changeQuantity">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-danger font-weight-normal money" id="sub_total-{{$cart->rowId}}">{{number_format($cart->price* $cart->qty,0,' ','.')}} VNĐ</td>
                        <td class="align-middle"><i onclick="removeCart('{{$cart->rowId}}')" class="ti-close text-danger font-weight-bold" style="cursor:pointer;">🗑️</i></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="text-center">
                <button class="btn btn-success">Chưa Có Bất Kì Sản Phẩm Nào Trong Giỏ Hàng</button>
                <button class="btn btn-lg" style="color: black;font-weight: 600;">Bạn vui lòng click <a class="text-danger pl-2 pr-2" href="{{url('san-pham')}}">Vào Đây</a>Để Mua Hàng Xin Cảm Ơn ! <br>
                    <img class="mt-2" src="{{asset('img/empty-cart.png')}}" alt="">
                </button>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <form class="mb-5" action="">
                <div class="input-group">
                    <input type="text" class="form-control p-4" placeholder="Nhập Mã Giảm Giá">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Áp Dụng</button>
                    </div>
                </div>
            </form>
            <div class="card border-secondary mb-5 sss">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Tóm Tắt Giỏ Hàng</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-bold text-danger">Tên sản phẩm</h6>
                        <h6 class="font-weight-bold text-danger">Thành tiền</h6>
                    </div>
                    @foreach(Cart::content() as $cart)
                    <div class="d-flex justify-content-between cartt mb-3 pt-1" data-rowId="{{$cart->rowId}}">
                        <h6 class="font-weight-medium name">{{$cart->name}}</h6>
                        <h6 class="font-weight-medium text-danger sub_total-{{$cart->rowId}}">{{number_format($cart->price* $cart->qty,0,' ','.')}} VNĐ</h6>
                    </div>
                    @endforeach
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Tổng Tiền</h5>
                        <h5 class="font-weight-bold text-danger price-total">{{Cart::total()}} VNĐ</h5>
                    </div>
                    @if (Auth::check())
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-primary my-3 py-3">Thanh Toán</a>
                    @else
                    <button class="btn btn-success">Bạn vui lòng đăng nhập thì mới có thể mua hàng</button>
                    @endif
                    @if (@empty(Cart::content()))
                    <button class="btn btn-success">Bạn Cần Mua Hàng Để Có Thể Thanh Toán</button>
                    @endempty
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer')
@include('layouts.clients.compoments.footer')

@endsection