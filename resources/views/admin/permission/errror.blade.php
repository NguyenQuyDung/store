@extends('layouts.admin.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm dữ liệu truy cập'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('permission.store)}}" method="POST" class="col-md-6 m-auto">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Chọn Tên Module</label>
                        <select name="module_parent" class="form-control" id="exampleFormControlSelect1">
                            <option value="">Chọn Tên Module</option>
                            @foreach (config('permissions.table_module') as $moduleItem)
                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            @foreach(config('permissions.module_children1') as $children1)
                            <div class="col-md-3">
                                <label for="module_children">
                                    <input type="checkbox" id="module_children" name="module_children[]" value="{{$children1}}">
                                </label>
                                {{$children1}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="form-control btn btn-primary">Thêm Mới</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection