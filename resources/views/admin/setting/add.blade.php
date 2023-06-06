@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm Setting'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('setting.store')}}" method="POST" class="col-md-6 m-auto">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput">Config key</label>
                        <input type="text" name="config_key" class="form-control @error('config_key') is-invalid @enderror" id="formGroupExampleInput" placeholder="Điền config key">
                        @error('config_key')
                        <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">Config key không được để trống !</small>
                        @enderror
                    </div>
                    @if (request()->type==='Text')
                    <div class="form-group">
                        <label for="formGroupExampleInput">Config key</label>
                        <input type="text" name="config_value" class="form-control @error('config_value') is-invalid @enderror" id="formGroupExampleInput" placeholder="Điền config key">
                        @error('config_value')
                        <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">Config value không được để trống !</small>
                        @enderror
                    </div>
                    @elseif(request()->type==='Textarea')
                    <div class="form-group">
                        <label for="formGroupExampleInput">Config value</label>
                        <textarea type="text" name="config_value" class="form-control @error('config_value') is-invalid @enderror" id="formGroupExampleInput" placeholder="Điền config value"></textarea>
                        @error('config_value')
                        <small style="font-size: 16px; color:red !important;" class="form-text text-danger ">Config value không được để trống !</small>
                        @enderror
                    </div>
                    @endif
                    <button type="submit" class="form-control btn btn-primary">Thêm Setting</button>
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