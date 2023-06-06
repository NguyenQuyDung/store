@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Danh Mục Sản Phẩm'])
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <form action="{{route('categories.add')}}" method="POST" class="col-md-6 m-auto">
          @csrf
          <div class="form-group">
            <label for="formGroupExampleInput">Tên Danh Mục</label>
            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Điền tên danh mục">
            @error('name')
            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
            @enderror
          </div>
          <!-- <div class="form-group">
            <label for="formGroupExampleInput2">Đường Dẫn Danh Mục</label>
            <input type="text" name="slug" class="form-control" id="formGroupExampleInput2" placeholder="Điền đường dẫn danh mục ">
            @error('slug')
            <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">{{$message}}</small>
            @enderror
          </div> -->
          <div class="form-group">
            <label for="exampleFormControlSelect1">Chọn Danh Mục</label>
            <select name="parent_id" class="form-control" id="exampleFormControlSelect1">
              <option value="0">Chọn Danh Mục Cha</option>
              {{!! $htmlOption !!}}
            </select>
          </div>
          <button type="submit" class="form-control btn btn-primary">Thêm Danh Mục</button>
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