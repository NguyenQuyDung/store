@foreach ($menu->menuChildren as $child)
<a href="{{url('danh-muc-san-pham/'.$child->slug)}}" class="dropdown-item">{{$child->name}}</a>
@endforeach