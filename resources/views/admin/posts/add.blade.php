@extends('layouts.admin.admin')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm Bài Viết'])
    <div class="content">
        <div class="container-fluid">
            <div id="content" class="container-fluid">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm bài viết
                    </div>
                    <div class="card-body">
                        <form action="{{route('posts.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tên bài viết</label>
                                <input class="form-control" type="text" name="name" id="name">
                                @error('name')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="content">Nội dung bài viết</label>
                                <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                                @error('content')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="detail">Chi tiết bài viết</label>
                                <textarea name="detail" class="form-control" id="detail" cols="30" rows="5"></textarea>
                                @error('detail')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="images">Hình Ảnh bài viết</label>
                                <input type="file" id="images" name="image_post_path" class="form-control-file">
                                @error('image_post_path')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục</label>
                                <select class="form-control" id="" name="parent_id">
                                    <option value="">Chọn danh mục</option>
                                    {{!!$htmlOption!!}}
                                </select>
                                @error('parent_id')
                                <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection