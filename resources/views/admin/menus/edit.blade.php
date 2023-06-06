@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Cập nhật menu'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <form action="{{route('menu.update', $find_id->id)}}" method="POST" class="col-md-6 m-auto">
          @csrf
          <div class="form-group">
            <label for="formGroupExampleInput">Tên Menu</label>
            <input type="text" value="{{$find_id->name}}" name="name" class="form-control" id="formGroupExampleInput" placeholder="Nhập tên menu">
            @error('name')
            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Chọn Menu Cha</label>
            <select name="parent_id" class="form-control" id="exampleFormControlSelect1">
              <option value="0">---Chọn---</option>
            {{!!$optionSelect!!}}
            </select>
          </div>
          <button type="submit" class="form-control btn btn-primary">Cập Nhật</button>
        </form>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection