@extends('layouts.admin.admin')
@section('content')
@section('title')
<title>Admin</title>
@endsection
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm slider'])
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
                        <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name_slider">Tên slider</label>
                                    <input type="name" placeholder="Tên slider" name="name_slider" class="form-control" id="name_slider">
                                    @error('name_slider')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="name_slug">Mô tả</label>
                                    <input type="name_slug" placeholder="Mô tả slider" name="descript" class="form-control" id="name_slug">
                                    @error('descript')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6" style="overflow:hidden;">
                                    <label for="file-product">Ảnh slider</label>
                                    <input type="file" name="file" id="file-uploader" class="form-control-file  mb-3" accept=".jpg, .jpeg, .png">

                                    @error('file')
                                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-danger p-2">Thêm Slider</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection