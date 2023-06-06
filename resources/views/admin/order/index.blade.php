@extends('layouts.admin.admin')

@section('title')
<title>Admin</title>
@endsection
@section('content')
<div class="content-wrapper">
  <div class="card">
    <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
      <div class="col-md-6">
        <h2>Danh sách đơn hàng</h2>
      </div>
      <div class="form-search form-inline">
        <form action="#" class="d-flex ">
          <input type="text" style="width:500px; margin-right:5px;" name="keyword" class="form-control form-search" placeholder="Tìm kiếm">
          <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
        </form>
      </div>
    </div>
    <div class="card-body">
      <div class="analytic">
        <a href="{{request()->fullUrlWithQuery(['status'=>'Complete'])}}" class="text-primary">Vận Chuyển Thành Công<span class="text-muted">({{$count_complete}})</span></a>
        <a href="{{request()->fullUrlWithQuery(['status'=>'Processing'])}}" class="text-primary">Đang Xử Lý<span class="text-muted">({{$count_completess}})</span></a>
        <a href="{{request()->fullUrlWithQuery(['status'=>'being_transported'])}}" class="text-primary">Đang Vận Chuyển<span class="text-muted">({{$count_completes}})</span></a>
      </div>
      <form action="{{route('order.action')}}">
        <div class="form-action form-inline py-3">
          <select class="form-control mr-1" id="" name="act">
            <option>Chọn</option>
            @foreach($list_act as $k => $act)
            <option value="{{$k}}">{{$act}}</option>
            @endforeach
          </select>
          <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
        </div>
        @if ($list_Cusmtomers->total()>0)
        <table class="table table-hover table-striped table-checkall">
          <thead>
            <tr>
              <th>
                <input type="checkbox" name="checkall">
              </th>
              <th scope="col">#</th>
              <th scope="col">Mã đơn hàng</th>
              <th scope="col">Khách hàng</th>
              <th scope="col">Số Điện Thoại</th>
              <th scope="col">Trạng thái</th>
              <th scope="col">Tổng Tiền</th>
              <th scope="col">Thời gian</th>
              <th scope="col">Tác vụ</th>
            </tr>
          </thead>
          <tbody>
            @php
            $stt=0;
            @endphp
            @foreach ($list_Cusmtomers as $customer)
            @php
            $stt++;
            @endphp
            <tr>
              <td>
                <input type="checkbox" name="list_check[]" value="{{$customer->id}}">
              </td>
              <td>{{$stt}}</td>
              <td style="text-transform: uppercase;" class="font-weight-bold">{{$customer->code}}</td>
              <td>
                {{ $customer->name }}
              </td>
              <td><a href="#"> {{ $customer->phone_number }}</a></td>
              @if ($customer->status=="Đang Xử Lý")
              <td><a href="#" class="text-light p-1 bg-danger" style="border-radius:3px;">{{$customer->status}}</a></td>
              @else
              <td><a href="#" class="text-light bg-success p-1" style="border-radius:3px;">{{$customer->status}}</a></td>
              @endif
              <td><a href="#">{{number_format($customer->total,0,' ','.')}} VNĐ</a></td>
              <td>{{$customer->created_at}}</td>
              <td>
                <a href="{{route('order.detail',$customer->id)}}" style="background: #333c44;border: 1px solid red;
    border-radius: 50% !IMPORTANT;" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="view">👁️</a>
                <a href="{{route('order.delete',$customer->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Danh Mục Sản Phẩm Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete" style="border-radius:50% !important;"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </form>
      {{ $list_Cusmtomers->links() }}
      @else
      <p class="alert alert-danger">Hiện tại không có đơn hàng nào trên hệ thống !</p>
      @endif
    </div>
  </div>
  <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
    <i class="fas fa-chevron-up"></i>
  </a>
</div>
@endsection