@if ($category->categoryChildren->count())
<i class="fa fa-angle-down float-right mt-1"></i>
@endif
</a>
<div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
    @foreach ($category->categoryChildren as $children)
    @if ($children->categoryChildren->count())
    <a href="{{url('danh-muc-san-pham/'. $children->slug)}}" data-toggle="dropdown" class="dropdown-item">{{$children->name}}
        @include('layouts.clients.compoments.child_menu_category',['category' => $children])
    </a>
    @else
    <a href="{{url('danh-muc-san-pham/'.$children->slug)}}" class="nav-item nav-link">{{$children->name}}</a>
    @endif
    @endforeach
</div>