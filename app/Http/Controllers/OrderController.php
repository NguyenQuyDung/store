<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'Processing' => 'Đang Xử Lý',
            'Complete' => 'Hoàn Tất',
            'forceDelete' => 'Xóa Vĩnh Viễn',
            'Garbage_can' => 'Hủy Đơn Hàng',
            'being_transported' => 'Đang Vận Chuyển',
        ];
        $list_Cusmtomers = Customer::where(['status' => 'Đang Xử Lý'])->orderBy('id', 'DESC')->paginate(10);
        if ($status == 'Processing') {
            $list_act = [
                'Complete' => 'Hoàn Tất',
                'being_transported' => 'Đang Vận Chuyển',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_Cusmtomers = Customer::where('id', '>', 0)->orderBy('id', 'DESC')->paginate(10);
        } elseif ($status == 'being_transported') {
            $list_act = [
                'Complete' => 'Hoàn Tất',
                'Processing' => 'Đang Xử Lý',
            ];
            $list_Cusmtomers = Customer::where(['status' => 'Đang Vận Chuyển'])->orderBy('id', 'DESC')->paginate(10);
        } elseif ($status == 'Complete') {
            $list_act = [
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_Cusmtomers = Customer::where(['status' => 'Hoàn Tất'])->orderBy('id', 'DESC')->paginate(10);
        }  else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_Cusmtomers = Customer::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'DESC')->paginate(10);
        }

        $count_completee = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_complete = Customer::where(['status' => 'Hoàn Tất'])->count();
        $count_completes = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_completess = Customer::where(['status' => 'Đang Xử Lý'])->count();

        // $list_Cusmtomers = Customer::orderBy('id', 'DESC')->paginate(10);
        // $detail = OrderDetail::where('order_id', $list_orders->id)->get();
        // dd($detail);
        return view('admin.order.index', compact(
            'list_Cusmtomers',
            'count_completee',
            'count_complete',
            'count_completes',
            'count_completess',
            'list_act'
        ));
    }
    public function detail($id, Request $request)
    {

        $list_Cusmtomers = Customer::find($id);
        $orderDetail = Order::where('id_customer', '=', $list_Cusmtomers->id)->get();
        //dd($list_Cusmtomers);
        //dd($orderDetail);
        //  {{number_format($order->price, 0, ',', '.')}}đ
        $qty = Order::where('id_customer', '=', $list_Cusmtomers->id)->sum('qty');
        $act = $request->input('act');
        $list_act = [
            'Complete' => 'Hoàn Tất',
            'being_transported' => 'Đang Vận Chuyển',
            'Processing' => 'Đang Xử Lý',

            'Garbage_can' => 'Hủy Đơn Hàng',
        ];
        if ($act == 'Complete') {
            Customer::where('id', $id)->update(['status' => 'Hoàn Tất']);
            return back()->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'being_transported') {
            Customer::where('id', $id)->update(['status' => 'Đang Vận Chuyển']);
            return back()->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'Processing') {
            Customer::where('id', $id)->update(['status' => 'Đang Xử Lý']);
            return back()->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'Garbage_can') {
            Customer::where('id', $id)->update(['status' => 'Hủy Đơn Hàng']);
            return back()->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        return view('admin.order.detail', compact('orderDetail', 'list_Cusmtomers', 'qty', 'list_act'));
    }
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'restore') {
                    Customer::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    Customer::destroy($list_check);
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'Complete') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Hoàn Tất']);
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }
                if ($act == 'Garbage_can') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Hủy Đơn Hàng']);
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }
                if ($act == 'Processing') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Đang Xử Lý']);
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }
                if ($act == 'being_transported') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Đang Vận Chuyển']);
                    return redirect()->route('order.index')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }
            }
        }
    }
    function delete($id)
    {
        $order = Customer::find($id);
        $order->delete();
        return redirect()->route('order.index')->with('status', 'Bạn Đã Xóa Đơn Hàng Thành Công !');
    }
}
