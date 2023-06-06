@extends('layouts.clients.master')
@section('content')
<div class="container-fluid">
    <div class="row border-top px-xl-5">
        @include('layouts.clients.compoments.cate')
        <div class="col-lg-9">
            @include('layouts.clients.compoments.menu')
        </div>
    </div>
</div>
<!-- Navbar End -->
<style>
    .resource__content a:hover {
        transform: scale(1.1);
    }

    .dd {
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        color: #bf3ff5;
        display: inline-block;
        text-decoration: none;
        border-radius: 19px;
        background-color: #f8ebfe;
        min-width: 120px;
        margin-right: 2px;
        padding: 8px;
        cursor: pointer;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .dds {
        font-size: 14px;
        font-weight: 500;
        text-align: center;
        color: #bf3ff5;
        display: inline-block;
        text-decoration: none;
        border-radius: 19px;
        background-color: #f8ebfe;
        min-width: 120px;
        margin-right: 15px;
        padding: 8px;
        cursor: pointer;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
    }

    .img {
        border-radius: 5px;
        transition: 0.9s;
    }

    .img:hover {
        transform: scale(1.2);
        border-radius: 20px;
    }

    .feture {
        font-size: 20px;
        font-weight: 500;
        color: #bf3ff5;
        display: inline-block;
        text-decoration: none;
        background-color: #f8ebfe;
        min-width: 120px;
        padding: 8px 15px;
        -webkit-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        cursor: pointer;
        border: 2px solid #bf3ff5;
    }


    .resource__image {
        overflow: hidden;
    }
</style>
<div class="mt-5 br col-md-4" style="margin-left:55px;">
    <p class="feture">Bài Viết Nổi Bật</p>
</div>
<div style="max-width:1352px; margin:auto;" class="d-flex justify-content-around">
    @foreach ($posts_fature as $post)
    <div class="resource animated col-md-4" style="padding-top:5px;">
        <div class="resource__image" data-aos="zoom-in">
            <div class="resource__image-container">
                <div class="resource__image-bg mb-5">
                    <a class="h" href="{{url('bai-viet/'.$post->slug)}}">
                        <img class="img" width="413" height="216" src="{{url($post->image_path)}}" class="lazyload lazyloaded">
                    </a>
                </div>
            </div>
        </div>
        <div class="resource__content p-2" data-aos="zoom-in">
            <div class="resource__tags text-center">
                <a href="#" class="dd">{{$post->view}} Người xem</a>
                <a href="{{url('bai-viet/'.$post->slug)}}" class="dd">Chi Tiết</a>
                <a href="{{url('bai-viet/'.$post->slug)}}" class="dd">Xem Thêm</a>
            </div>
            <div class="recource__head mt-3">
                <h4>
                    <a href="{{url('bai-viet/'.$post->slug)}}" class="text-decoration-none text-dark" style="font-family: sans-serif;font-size: 20px; text-transform:lowercase;" rel="bookmark">
                        {{$post->name}}</a>
                </h4>
            </div>
        </div>
    </div>
    @endforeach
</div>
<div class="col-12 pb-1 pt-4 justify-content-center m-auto d-flex ">
    {{$posts_fature->links()}}
</div>
@foreach ($category_posts as $cat)
@if ($list_of_post[$cat->id]->count())
<div class="mt-5 br col-md-4" style="margin-left:55px;">
    <p class="feture">Bài Viết {{$cat->name}}</p>
</div>
@endif
<div style="max-width:1352px; margin:auto;" class="d-flex justify-content-around">
    @foreach ($list_of_post[$cat->id] as $post)
    <div class="resource animated col-md-4" style="padding-top:5px;">
        <div class="resource__image">
            <div class="resource__image-container">
                <div class="resource__image-bg mb-5" data-aos="zoom-in">
                    <a class="h" href="{{url('bai-viet/'.$post->slug)}}">
                        <img class="img" width="413" height="216" src="{{url($post->image_path)}}" class="lazyload lazyloaded">
                    </a>
                </div>
            </div>
        </div>
        <div class="resource__content">
            <div class="resource__tags text-center" data-aos="zoom-in">
                <a href="#" class="dds">{{$post->view}} Người xem</a>
                <a href="{{url('bai-viet/'.$post->slug)}}" class="dds">Chi Tiết</a>
                <a href="{{url('bai-viet/'.$post->slug)}}" class="dds">Xem Thêm</a>
            </div>
            <div class="recource__head mt-3" data-aos="zoom-in">
                <h4>
                    <a href="{{url('bai-viet/'.$post->slug)}}" class="text-decoration-none text-dark" style="font-family: sans-serif;font-size: 20px; text-transform:lowercase;" rel="bookmark">
                        {{$post->name}}</a>
                </h4>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- @if ($list_of_post[$cat->id]->count())
<div class="col-12 pb-1 justify-content-center m-auto d-flex ">
    {{$list_of_post[$cat->id]->links()}}
</div>
@endif -->
@endforeach


@endsection
@section('footer')
@include('layouts.clients.compoments.footer')
@endsection