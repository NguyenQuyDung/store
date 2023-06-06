@extends('layouts.admin.admin')
@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Phản Hồi </h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
            <li class="breadcrumb-item active">Phản hồi</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-body row">

        <div class="container-fluid">
          @if(session('status'))
          <div class="alert alert-success mt-2 mb-2">
            {{session("status")}}
          </div>
          @endif
        </div>
        <div class="col-5 text-center d-flex align-items-center justify-content-center">
          <div class="">
            <img src="{{asset('img/phan-hoi-cua-khach-hang.png')}}" alt="">
          </div>
        </div>
        <div class="col-7">
          <form action="{{route('sendmail')}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="inputName">Tên khách hàng: <b class="text-danger">{{$contact->name}}</b></label>
              <input type="text" id="inputName" name="name" class="form-control" value="{{$contact->name}}" />
            </div>
            <div class="form-group">
              <label for="inputEmail">E-Mail khách hàng: <b class="text-danger">{{$contact->name}}</b></label>
              <input type="email" id="inputEmail" name="email" class="form-control" value="{{$contact->email}}" />
            </div>
            <div class="form-group">
              <label for="inputEmail">Địa Chỉ khách hàng: <b class="text-danger">{{$contact->name}}</b></label>
              <input type="text" id="" class="form-control" name="address" value="{{$contact->address}}" />
            </div>
            <div class="form-group">
              <label for="inputEmail">Số Điện Thoại khách hàng: <b class="text-danger">{{$contact->name}}</b></label>
              <input type="text" id="" class="form-control" name="phone" value="{{$contact->phone}}" />
            </div>
            <div class="form-group">
              <label for="inputSubject">Công Việc khách hàng: <b class="text-danger">{{$contact->name}}</b></label>
              <input type="text" id="inputSubject" name="industry" class="form-control" value="{{$contact->industry}}" />
            </div>
            <div class="form-group">
              <label for="inputMessage">Thông Tin Cần Phản Hồi</label>
              <textarea id="inputMessage" name="info" class="form-control" rows="4" name="infor"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-primary w-100" value="Phản Hồi">
            </div>
          </form>
        </div>
      </div>
    </div>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection