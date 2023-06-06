<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    //
    public function index(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa Tạm Thời',
            'public' => 'Công Khai',
            'pending' => 'Chờ Duyệt'
        ];
        if ($status == 'active') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'public' => 'Công Khai',
                'pending' => 'Chờ Duyệt'
            ];
            $list_sliders = Slider::where(['status' => 'Công Khai'])->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_sliders = Slider::onlyTrashed()->paginate(5);
        } elseif ($status == 'pending') {
            $list_act = [
                'public' => 'Công Khai',
                'delete' => 'Xóa Tạm Thời',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_sliders = Slider::where(['status' => 'Chờ Duyệt'])->paginate(5);
        } elseif ($status == 'public') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'pending' => 'Chờ Duyệt'
            ];
            $list_sliders = Slider::where(['status' => 'Công Khai'])->paginate(5);
        } else {
            $list_sliders = Slider::paginate(5);
        }
        $count_public = Slider::where(['status' => 'Công Khai'])->count();
        $count_Pending = Slider::where(['status' => 'Chờ Duyệt'])->count();
        $count_trash = Slider::onlyTrashed()->count();
        $count = Slider::count();
        return view('admin.sliders.index', compact('list_sliders', 'count_trash','list_act', 'count', 'count_public', 'count_Pending'))->with('i', (request()->input('page', 1) - 1) * 5);;
    }
    public function create()
    {
        return view('admin.sliders.add');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'name_slider' => 'required',
                'descript' => 'required',
                'file' => 'required'
            ],
            [
                'required' => ':attribute slider không được để trống !'
            ],
            [
                'name_slider' => 'Tên',
                'descript' => 'Mô tả',
                'file' => 'Hình ảnh'
            ]
        );
        if ($request->hasFile('file')) {
            $slider =  $request->file;
            $name = $slider->getClientOriginalName();
            $images_product = $slider->move('public/template-website/upload', $name);
        }
        Slider::create([
            'name' => $request->name_slider,
            'descripts' => $request->descript,
            'image_path' => $images_product,
            'slug' => Str::slug($request->name_slider),
            'user_create' => Auth::user()->name,
        ]);
        return redirect()->route('slider.index')->with('status', 'Bạn đã thêm silder thành công !');
    }
    public function edit($id)
    {
        $find_id = Slider::find($id);
        return view('admin.sliders.edit', compact('find_id'));
    }
    public function update(Request $request, $id)
    { {
            $request->validate(
                [
                    'name_slider' => 'required',
                    'descript' => 'required',
                    'file' => 'required'
                ],
                [
                    'required' => ':attribute slider không được để trống !'
                ],
                [
                    'name_slider' => 'Tên',
                    'descript' => 'Mô tả',
                    'file' => 'Hình ảnh'
                ]
            );
            if ($request->hasFile('file')) {
                $slider =  $request->file;
                $name = $slider->getClientOriginalName();
                $images_product = $slider->move('public/template-website/upload', $name);
            }
            Slider::where('id', $id)->update([
                'name' => $request->name_slider,
                'descripts' => $request->descript,
                'image_path' => $images_product,
                'slug' => Str::slug($request->name_slider),
                'user_create' => Auth::user()->name,
            ]);
            return redirect()->route('slider.index')->with('status', 'Bạn đã cập nhật silder thành công !');
        }
    }
    public function delete($id)
    {
        $find_id = Slider::find($id);
        $find_id->delete();
        return redirect()->route('slider.index')->with('status', 'Bạn đã xóa silder thành công !');
    }
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
            $act = $request->input('act');
            if ($act == 'delete') {
                Slider::destroy($list_check);
                return redirect()->route('slider.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
            }
            if ($act == 'restore') {
                Slider::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect()->route('slider.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
            }
            if ($act == 'forceDelete') {
                Slider::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('slider.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
            }
            if ($act == 'pending') {
                Slider::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
                return redirect()->route('slider.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
            if ($act == 'public') {
                Slider::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
                return redirect()->route('slider.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
            }
        }
    }
}
