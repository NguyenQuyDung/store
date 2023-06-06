<!-- <div class="col-lg-3 d-none d-lg-block">
    <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
        <h6 class="m-0">Danh Mục Sản Phẩm</h6>
        <i class="fa fa-angle-down text-dark"></i>
    </a>
    <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
        <div class="navbar-nav w-100" style="height: auto">
            @foreach ($categorys as $category)
            <div class="nav-item dropdown position-relative">
                <a href="{{$category->slug}}" class="nav-link" data-toggle="dropdown">{{$category->name}}
                    @include('layouts.clients.compoments.child_menu_category',['category' => $category])
            </div>
            @endforeach
        </div>
    </nav>
</div> -->
<!-- @if ($category->categoryChildren->count())
<i class="fa fa-angle-down float-right mt-1"></i>
@endif
</a>
<div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
    @foreach ($category->categoryChildren as $children)
    <a href="{{$children->slug}}" data-toggle="dropdown" class="dropdown-item">{{$children->name}}
        @if ($children->categoryChildren->count())
        @include('layouts.clients.compoments.child_menu_category',['category' => $children])
        @endif
    </a>
    @endforeach
</div> -->