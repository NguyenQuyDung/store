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
<style>
    .entry-title,.articleName {
        font-size: 1.5rem;
        font-family: 'Montserrat', Helvetica, Arial, Lucida, sans-serif;
        padding-top: 20px;
    }
    .articleName a img, .detail a img{
        width: 1100px;
        height: 600px;
    }
</style>
<div class="container">
    <h1 class="entry-title">{{$detail_post->name}}</h1>
    <p class="post-meta"><span class="published text-dark">Feb {{$detail_post->created_at}}</span> | <a href="" rel="category tag" class=" text-dark">Blog</a> | <span class="comments-number"><a href="" class=" text-dark">0 share</a></span></p>
    <div class="content">
        {!! $detail_post->content !!}
    </div>
    <div class="content">
        {!! $detail_post->post_detail !!}
    </div>
</div>
@endsection

@section('footer')
@include('layouts.clients.compoments.footer')
@endsection