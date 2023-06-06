<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     // <option value="{{$moduleItem}}">{{$moduleItem}}</option>

    //     if (Gate::allows('is-admin')) {
    //         return view('admin.home.index');
    //     }else{
    //         abort(403);
    //     } 
    // }
    public function home()
    {

        $count_complete = Customer::where(['status' => 'Hoàn Tất'])->count();
        $count_completes = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_completess = Customer::where(['status' => 'Hủy Đơn Hàng'])->count();
        $count_completesss = Customer::where(['status' => 'Đang Xử Lý'])->count();
        //$shows = Customer::where('id','>',0)->orderBy('id','DESC')->paginate(10);
        $revenue = Customer::select('total')->sum('total');
        $lists = Customer::paginate(10);
        return view('admin.home.index', compact(
            'lists',
            'count_complete',
            'count_completes',
            'count_completess',
            'count_completesss',
            'revenue'
        ));
    }
}
