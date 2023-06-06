@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @include('layouts.content-header', ['name' => 'Trang Chủ', 'key' => 'Thêm Menu'])
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <form action="{{route('permission.store')}}" method="POST" class="col-md-6 m-auto">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="exampleFormControlSelect1">Chọn Tên Module</label>
                        <select name="module_parent" class="form-control" id="exampleFormControlSelect1">
                            <option value="">Chọn Tên Module</option>
                            @foreach (config('permissions.table_module') as $moduleItem)
                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row cardd">
                            <div class="form-group col-md-12" style="background: black; color: azure; padding: 10px 20px; border-radius: 5px;">
                                <input type="checkbox" class="checkall" id="checkall">
                                <label for="checkall" class="mb-0" class="checkall">
                                    Check All
                                </label>
                            </div>
                            @foreach(config('permissions.module_children1') as $children1)
                            <div class="col-md-2">
                                <label for="module_children">
                                    <input type="checkbox" id="module_children" class="module_children" name="module_children[]" value="{{$children1}}">
                                </label>
                                {{$children1}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="form-control btn btn-primary">Thêm Mới</button>
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
@section('js')
<script>
    $('.checkall').on('click', function() {
        $(this).parents('.cardd').find('.module_children').prop('checked', $(this).prop('checked'));
    });
</script>
@endsection