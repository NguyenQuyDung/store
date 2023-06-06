<html>

<head>
    <meta charset="utf-8">
    <!-- Favicon -->
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Unimart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('img/icon.png')}}" type="image/x-icon" />
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body>
    <style>
        @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);

        .swal2-styled.swal2-confirm {
            border: 0;
            border-radius: 0.25em;
            background: initial;
            background-color: #b4b1d4;
            color: #fff;
            font-size: 1em;
            width: 100%;
            display: inline-block;
            padding: 10px 200px;
        }

        .toast-container {
            background-color: red !important;
        }

        .toast-message {
            color: #ff8600;
            font-weight: bold;
        }
    </style>
    @include('layouts.clients.compoments.modal')
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
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
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold" style="COLOR: red;
    font-weight: 800"><span class="text-primary font-weight-bold border px-3 mr-1" style="color:#ff8600 !important;">U</span>HUST</h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="{{url('tim-kiem-san-pham.html')}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control search-product" name="query" placeholder="Nhập Thông Tin Tìm Kiếm Sản Phẩm.......">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <button type="submit" style="    border: none;
    background: white; outline:none;"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
                <div class="list-product-search position-absolute" style="z-index: 1;
    background: #fff;
    height: auto;
    overflow: auto;
    width: 681px;">

                </div>
            </div>
            <div class="col-lg-3 col-6 text-right">
                @if (Auth::check())
                <a href="{{url('san-pham-yeu-thich.html')}}" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">{{$favouriteProductCount}}</span>
                </a>
                @else
                <a href="{{url('san-pham-yeu-thich.html')}}" class="btn border">
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a>
                @endif
                <a href="{{url('gio-hang.html')}}" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge" id="cart-count">{{Cart::count()}}</span>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->

    @yield('content')
    @yield('footer')
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <!-- Contact Javascript File -->
    <script src="{{asset('mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('mail/contact.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Template Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 4,
            freeMode: true,
            watchSlidesProgress: true,
        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            thumbs: {
                swiper: swiper,
            },
        });
    </script>
    <script type="text/javascript">
        function addCart(productId) {
            $.ajax({
                url: "cart/add",
                method: "GET",
                data: {
                    productId: productId
                },
                dataType: 'json',
                success: function(response) {
                    $('#cart-count').text(response['count']);
                    $('.price-total').text(response['total'] + 'VNĐ');
                    var cartHover_tbody = $('.select-items tbody');
                    var cartHover_extstItems = cartHover_tbody.find("tr" + "[data-rowId='" + response['cart'].rowId + "']");
                    var newItem = '<tr data-rowId="' + response['cart'].rowId + '">' +
                        '<td class="align-middle"><img src="http://localhost/unitop.vn/back-end/Unimart.com/Unimart.com/public/template-website/' + response['cart'].options.fature_image_path + '" alt="" style="width: 50px;"></td>' +
                        '<td class="align-middle">"' + response['cart'].name + '"</td>' +
                        '<td class="align-middle">' +
                        '<div class="input-group quantity mx-auto" style="width: 100px;">' +
                        '<div class="input-group-btn">' +
                        '<button class="btn btn-sm btn-primary btn-minus">' +
                        '<i class="fa fa-minus"></i>' +
                        '</button>' +
                        '</div>' +
                        '<input type="text" class="form-control form-control-sm bg-secondary text-center" value="' + response['cart'].qty + '" style="height:24px;">' +
                        '<div class="input-group-btn">' +
                        '<button class="btn btn-sm btn-primary btn-plus">' +
                        '<i class="fa fa-plus"></i>' +
                        '</button>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '<td class="align-middle"><i onclick="removeCart(' + response['cart'].rowId + ')" class="ti-close text-danger font-weight-bold" style="cursor:pointer;">🗑️</i></td>' +
                        '</tr>';

                    cartHover_tbody.append(newItem);
                    // console.log(newItem);
                },
                error: function(response) {
                    alert("Add Failed.");
                    console.log(response);
                }

            });
        }

        $(function() {
            $('.addFavorite').click(function(e) {
                e.preventDefault();
                let $this = $(this);
                let URL = $this.attr('href');
                if (URL) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: URL,
                        method: 'POST',
                        success: function(data) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: data.messages
                            })
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        },
                    });
                }

            });

        });

        function removeCart(rowId) {
            $.ajax({
                url: "cart/delete",
                method: "GET",
                data: {
                    rowId: rowId
                },
                dataType: 'json',
                success: function(response) {
                    $('#cart-count').text(response['count']);
                    $('.price-total').text(response['total'] + 'VNĐ');
                    //  location.reload(1000);
                    var cartHover_tbody = $('.select-items tbody');
                    var cartHover_exisItem = cartHover_tbody.find("tr" + "[data-rowId='" + rowId + "']");
                    cartHover_exisItem.remove();
                    var cart_tbody = $('.table-responsive tbody');
                    var cart_exisItem = cart_tbody.find("tr" + "[data-rowId='" + rowId + "']");
                    cart_exisItem.remove();
                    var cartItem = $('.sss').find("div" + "[data-rowId='" + rowId + "']");
                    cartItem.remove();
                    Swal.fire('Bạn đã xóa sản phẩm trong giỏ hàng thành công !');
                },
                error: function(response) {
                    alert("Delete Failed.");
                    console.log(response);
                }

            });
        }

        function destroyCart() {
            $.ajax({
                url: "cart/destroy",
                method: "GET",
                data: {},
                success: function(response) {
                    $('#cart-count').text('0');
                    $('.price-total').text('0' + 'VNĐ');
                    //  location.reload(1000);
                    var cartHover_tbody = $('.select-items tbody');
                    cartHover_tbody.children().remove();
                    var cart_tbody = $('.table-responsive tbody');
                    cart_tbody.children().remove();
                    var cartItem = $('.sss');
                    cartItem.children().remove();
                    // console.log(response);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        icon: 'success',
                        title: 'Xóa giỏ hàng thành công !'
                    })
                },
                error: function(response) {
                    alert("Delete Failed.");
                    console.log(response);
                }

            });
        }

        $(document).ready(function() {
            $('.error').click(function() {
                Command: toastr["success"](" <b style='color:red;'>Thông Báo:</b> Bạn cần đăng nhập mới có thể thực thi thao thác này !")

                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            });
            $('.changeQuantity').click(function() {
                let qty = $(this).closest('.align-middle').find('.number_order').val();
                let id = $(this).closest('.align-middle').find('.product_id').val();
                let token = $("#token").val();
                let data = {
                    id: id,
                    qty: qty,
                    token: token
                };
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'cart/update', // trang sử lý mặc định trang hiện tại
                    type: 'POST', // Post goặc Get, mặc ddingj Get
                    data: data, // Dữ liệu truyền lên Sever
                    // dataType: 'json', // Html, text, script hoặc json
                    success: function(data) {
                        $('#cart-count').text(data['num']);
                        $('.price-total').text(data['total_price'] + 'VNĐ');
                        $("#sub_total-" + id).text(data.sub_total);
                        $(".sub_total-" + id).text(data.sub_total);
                    },
                    // kiểm tra nếu có lỗi nó xuất lên
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    },
                });
            });
            $('.search-product').keyup(function() {
                let _text = $(this).val();
                let data = {
                    _text: _text
                };
                if (_text != '') {
                    $.ajax({
                        url: 'search/product', // trang sử lý mặc định trang hiện tại
                        type: 'GET', // Post goặc Get, mặc ddingj Get
                        data: data, // Dữ liệu truyền lên Sever
                        // dataType: 'json', // Html, text, script hoặc json

                        success: function(data) {
                            $('.list-product-search').html(data);
                            $('list-product-search').show();
                        },
                        // kiểm tra nếu có lỗi nó xuất lên
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        },
                    });
                } else {
                    $('.list-product-search').html('');
                    $('list-product-search').hide();
                }
            });

            //liên hệ
            $("#sendMessageButton").click(function(e) {
                e.preventDefault();
                let name = $('#name').val();
                let email = $('#email').val();
                let address = $('#address').val();
                let industry = $('#industry').val();
                let message = $('#message').val();
                let phone = $('#phone').val();
                let data = {
                    name: name,
                    email: email,
                    address: address,
                    industry: industry,
                    message: message,
                    phone: phone
                };
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: 'send-contact',
                    method: 'POST',
                    data: data,
                    success: function(data) {
                        $('#email').val('');
                        $('#address').val('');
                        $('#industry').val('');
                        $('#message').val('');
                        $('#phone').val('');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Gửi thành công, chúng tôi sẽ sớm phản hồi lại bạn sớm nhất có thể, vui lòng check email của bạn !'
                        })
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    },
                });
            })
        });
    </script>
    <script>
        //đánh giá sản phẩm
        $(document).ready(function() {
            $('.send-infor').click(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var email = $('#email').val();
                var message = $('#message').val();
                var rating = $('.star').val();
                var product_id = $('.product_id').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{route('sendComment')}}",
                    method: 'POST',
                    data: {
                        name: name,
                        email: email,
                        message: message,
                        rating: rating,
                        product_id: product_id
                    },
                    success: function(data) {
                        $('#name').val('');
                        $('#email').val('');
                        $('#message').val('');
                        $('.star').val('');
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Đánh giá sản phẩm thành công, Đánh giá của bạn đang được tiến hành phê duyệt xin cảm ơn !'
                        })
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        console.log(xhr.status);
                        console.log(thrownError);
                    },
                });
            });
        });
    </script>
</body>

</html>