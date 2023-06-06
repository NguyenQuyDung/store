
<nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
    <a href="" class="text-decoration-none d-block d-lg-none">
        <h1 class="m-0 display-5 font-weight-semi-bold" style="COLOR: red;
    font-weight: 800;"><span class="text-primary font-weight-bold border px-3 mr-1">U</span>HUST</h1>
    </a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" >
        @foreach ($menus as $key => $menu)
        <div class="navbar-nav mr-auto py-0" style="margin-right:40px !important;">
            <div class="nav-item dropdown">
                @if ($menu->menuChildren->count())
                <a href="{{url($menu->slug)}}" style="display: contents;" class="nav-link  {{$key==0?'active':''}}">{{$menu->name}}</a>
                @include('layouts.clients.compoments.menuw',['menu', $menu])
                @else
                <a href="{{url($menu->slug)}}"style="display: contents;" class="nav-link {{$key==0?'active':''}}">{{$menu->name}}</a>
                @include('layouts.clients.compoments.menuw',['menu', $menu])
                @endif
            </div>
        </div>
        @endforeach
        <div class="navbar-nav ml-auto py-0">
            @if (Auth::check())
            <a href="" class="nav-item nav-link font-weight-bold text-danger">{{Auth::user()->name}}</a>
            <a href="{{url('logout.html')}}" class="nav-item nav-link text-success font-weight-bold">Đăng xuất</a>
            
            @else
            <a href="{{url('dang-nhap.html')}}" class="nav-item nav-link" >Đăng Nhập</a>
            <a href="{{url('dang-ky.html')}}" class="nav-item nav-link">Đăng Ký</a>
            @endif
         
        </div>
    </div>
</nav>
