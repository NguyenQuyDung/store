<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/adminlogin.css')}}">
    <link rel="shortcut icon" href="{{asset('images/loginadmin.png')}}" type="image/x-icon">
    <title>Login</title>
</head>

<body>
    <div id="login-container">
        <h3>Account Login</h3>
        <hr>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="{{url('admin')}}" method="post">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="email-label">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-label">
                        </div>
                        <div class="input-group mb-3">
                            @error('email')
                            <small style="display:block;font-size: 14px; color:#62f989 !important" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="password-label">
                                    <i class="fa fa-key" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-label">
                        </div>
                        <div class="input-group mb-3">
                            @error('password')
                            <small style="display:block;font-size: 14px; color:#62f989 !important" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>

                        <label class="container-checkbox">Remember My Account
                            <input type="checkbox" name="remember_me" checked="checked">
                            <span class="checkmark"></span>
                        </label>

                        <div class="text-center">
                            <button type="submit" class="btn btn-customized">Login Account</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>