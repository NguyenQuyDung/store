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
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Thanh Toán</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Thanh toán</p>
        </div>
    </div>
</div>
<div class="container-fluid pt-5">
    <form action="{{route('addOrder')}}" method="post">
        @csrf
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Điền Thông Tin Bên Dưới Để Tiến Hàng Thanh Toán</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Họ Và Tên</label>
                            <input class="form-control" name="fullname" type="text" placeholder="Nhập họ và tên">
                            @error('fullname')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" name="email" type="text" placeholder="Nhập email">
                            @error('email')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Tỉnh/Thành Phố</label>
                            <select id="city-dropdown" class="custom-select" name="city" required>
                                <option selected="">Chọn Thành Phố</option>
                                @foreach ($countries as $data)
                                <option value="{{$data->id}}">
                                    {{$data->_name}}
                                </option>
                                @endforeach
                            </select>
                            @error('city')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Số Điện Thoại</label>
                            <input class="form-control" name="phone_number" type="text" placeholder="Nhập số điện thoại">
                            @error('phone_number')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Quận/Huyện</label>
                            <select id="district-dropdown" name="district" class="custom-select" required> 
                                <option selected="">Chọn Quận Huyện</option>
                            </select>
                            @error('district')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">

                        </div>
                        <div class="col-md-6 form-group">
                            <label>Phường/Xã</label>
                            <select id="ward-dropdown" name="ward" class="custom-select" required>
                                <option selected="">Chọn Phường Xã</option>

                            </select>
                            @error('ward')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6 form-group">
                            <label for="">Ghi Chú</label>
                            <textarea name="note" class="form-control w-100" id="" cols="30" rows="4" placeholder="Ghi chú"></textarea>
                        </div>
                    </div>

                </div>
                <div class="collapse mb-4" id="shipping-address">
                    <h4 class="font-weight-semi-bold mb-4">Shipping Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address Line 2</label>
                            <input class="form-control" type="text" placeholder="123 Street">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Country</label>
                            <select class="custom-select">
                                <option selected="">United States</option>
                                <option>Afghanistan</option>
                                <option>Albania</option>
                                <option>Algeria</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>City</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>State</label>
                            <input class="form-control" type="text" placeholder="New York">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>ZIP Code</label>
                            <input class="form-control" type="text" placeholder="123">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Tổng Đơn Hàng</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Sản Phẩm</h5>
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
                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Hình Thức Thanh Toán</h4>

                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer" value="Thanh Toán Khi Nhận Hàng">
                                <label class="custom-control-label" for="banktransfer">Thanh Toán Khi Nhận Hàng</label>
                                @error('payment')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" style="font-family: none;
    color: darkred;">Đặt Hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#city-dropdown').on('change', function() {
            var idCountry = this.value;
            $("#district-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-district')}}",
                type: "POST",
                data: {
                    country_id: idCountry,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#district-dropdown').html('<option value="">Chọn Quận Huyện</option>');
                    $.each(result.states, function(key, value) {
                        $("#district-dropdown").append('<option value="' + value
                            .id + '">' + value._name + '</option>');
                    });
                    $('#ward-dropdown').html('<option value="">Chọn Phường Xã</option>');
                }
            });
        });

        $('#district-dropdown').on('change', function() {
            var idState = this.value;
            $("#ward-dropdown").html('');
            $.ajax({
                url: "{{url('api/fetch-ward')}}",
                type: "POST",
                data: {
                    state_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#ward-dropdown').html('<option value="">Chọn Phường Xã</option>');
                    $.each(res.cities, function(key, value) {
                        $("#ward-dropdown").append('<option value="' + value
                            .id + '">' + value._name + '</option>');
                    });
                }
            });
        });

    });
</script>

@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection