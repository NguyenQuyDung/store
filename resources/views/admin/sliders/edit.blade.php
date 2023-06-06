@extends('layouts.admin.admin')
@section('content')
@section('title')
<title>Admin</title>
@endsection
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Cập nhật slider'])
    <div class="content">
        @if(session('status'))
        <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
        </div>
        @endif
        <div class="container-fluid">
            <div class="">
                <div class="card" style="margin-left: 20px; height:500px;">
                    <div class="card-header font-weight-bold" style="border-bottom:none;">
                        <form action="{{route('slider.update',$find_id->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="name_slider">Tên slider</label>
                                    <input type="name" placeholder="Tên slider" value="{{$find_id->name}}" name="name_slider" class="form-control" id="name_slider">
                                    @error('name_slider')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-12">
                                    <label for="name_slug">Mô tả</label>
                                    <input type="name_slug" value="{{$find_id->descripts}}" placeholder="Mô tả slider" name="descript" class="form-control" id="name_slug">
                                    @error('descript')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-12" style="overflow:hidden;">
                                    <label for="file-product">Ảnh slider</label>
                                    <input type="file" name="file" id="file-uploader" class="form-control-file  mb-3" accept=".jpg, .jpeg, .png">

                                    @error('file')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($find_id->image_path)}}" alt="">
                                </div>
                            </div>
                            <button class="btn btn-danger p-2">Cập Nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection