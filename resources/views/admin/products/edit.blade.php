@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: black !important;
            border: 1px solid #aaa;
            border-radius: 4px;
            box-sizing: border-box;
            display: inline-block;
            margin-left: 5px;
            margin-top: 5px;
            padding: 0;
            padding-left: 20px;
            position: relative;
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: bottom;
            white-space: nowrap;
        }
    </style>
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Cập nhật sản phẩm'])
    <div class="">
        <div class="card-header font-weight-bold">
            Cập nhật sản phẩm
        </div>
        <div class="card-body">
            <form action="{{route('products.update', $find_id->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" value="{{$find_id->name}}" name="name" id="name">
                            @error('name')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Giá hiện tại</label>
                            <input class="form-control" value="{{ $find_id->price}}" type="text" name="price" id="name">
                            @error('price')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Giá cũ</label>
                            <input class="form-control" value="{{ $find_id->price_old}}" type="text" name="price_old" id="name">
                            @error('price_old')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="intro" class="form-control" id="intro" cols="30" rows="5">{{$find_id->content}}</textarea>
                            @error('intro')
                            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết sản phẩm</label>
                    <textarea name="detail" class="form-control" id="detail" cols="30" rows="5">{{$find_id->content_detail}}</textarea>
                    @error('detail')
                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="img">Ảnh sản phẩm</label> <br>
                    <input type="file" id="img" multiple class="p-2" name="image_product_path" class="form-control-file">
                    @error('image_product_path')
                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4">
                    <img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($find_id->fature_image_path)}}" alt="">
                </div>
                <div class="form-group">
                    <label for="img">Thư viện ảnh sản phẩm</label> <br>
                    <input type="file" id="img" class="p-2" multiple="multiple" name="image_path[]" class="form-control-file">
                    @error('image_path')
                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-around col-md-4">
                    @foreach ($find_id->ProductImage as $img)
                    <img height="60" width="60" style="border:2px solid red; border-radius:8px;" src="{{url($img->image_path)}}" alt="">
                    @endforeach
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control select_option" id="" name="parent_id">
                        <option value="">Chọn danh mục</option>
                        {{!!$htmlOption!!}}
                    </select>
                    @error('parent_id')
                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="select2">Chọn tags cho sản phẩm</label>
                    <select class="form-control select2" name="tag_name[]" id="select2" multiple="multiple">
                        @foreach ($find_id->Tags as $tagItem)
                            <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                        @endforeach
                    </select>
                    @error('tag_name')
                    <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".select2").select2({
            tags: true,
            tokenSeparators: [',']
        });
        $(".select_option").select2({
            placeholder: "Tìm kiếm danh mục sản phẩm",
            allowClear: true
        });
    });
</script>
@endsection