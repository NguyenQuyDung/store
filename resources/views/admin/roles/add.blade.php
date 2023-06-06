@extends('layouts.admin.admin')
@section('content')
@section('title')
<title>Admin</title>
@endsection
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm quyền'])
    <div class="content">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
        <div class="container-fluid">
            <div class="">
                <div class="card" style="margin-left: 20px; height:auto;">
                    <div class="card-header font-weight-bold" style="border-bottom:none;">
                        <form action="{{route('roles.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="name_roles">Tên quyền</label>
                                    <input type="name" placeholder="Tên quyền" name="name_roles" class="form-control" id="name_slider">
                                    @error('name_roles')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="name_slug">Mô tả quyền trong hệ thống</label>
                                    <textarea name="descript" placeholder="Mô tả quyền" id="" cols="30" rows="10"></textarea>
                                    @error('descript')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group" style="margin-left: 10px;
    background: black;
    color: azure;
    padding: 10px 20px;
    border-radius: 5px;">
                                    <input type="checkbox" class="checkall" id="checkall">
                                    <label for="checkall" class="mb-0" class="checkall">
                                        Check All
                                    </label>
                                </div>
                                @foreach ($permissionsParent as $item)
                                <div class="cardss text-dark bg-light mb-3 col-md-12">
                                    <div class="card-header" style="background:darkgray;">
                                        <input type="checkbox" value="" id="{{$item->name}}" class="checkbox_wrapper">
                                        <label for="{{$item->name}}">
                                            Model {{$item->name}}
                                        </label>
                                    </div>
                                    <div class="d-flex justify-content-around">
                                        @foreach ($item->permissionsChildren as $child)
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <input type="checkbox" class="checkbox_children" name="permission_id[]" value="{{$child->id}}" id="{{$child->name}}">
                                                <label for="{{$child->name}}">
                                                    {{$child->name}}
                                                </label>
                                            </h5>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <button class="btn btn-success p-2 text-center d-block">Thêm Mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $('.checkbox_wrapper').on('click', function() {
        $(this).parents('.cardss').find('.checkbox_children').prop('checked', $(this).prop('checked'));
    });
    $('.checkall').on('click', function() {
        $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    });
</script>
@endsection