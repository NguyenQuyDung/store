<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSettingRequest;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSettingController extends Controller
{
    //
    public function index()
    {
        $settings = Setting::paginate(5);
        return view('admin.setting.index', compact('settings'));
    }
    public function add()
    {
        return view('admin.setting.add');
    }
    public function edit($id)
    {
        $find_id = Setting::find($id);
        return view('admin.setting.edit', compact('find_id'));
    }
    public function update(Request $request, $id)
    {
        Setting::where('id',$id)->update(
            [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'user_create' => Auth::user()->name
            ]
        );
        return redirect()->route('setting.index')->with(
            'status',
            'Bạn đã cập nhật bản ghi thành công !'
        );
    }
    public function delete($id){
        $find_id = Setting::find($id);
        $find_id->delete();
        return redirect()->route('setting.index')->with(
            'status',
            'Bạn đã xóa bản ghi thành công !'
        );
    }
    public function store(AddSettingRequest $request)
    {
        Setting::create(
            [
                'config_key' => $request->config_key,
                'config_value' => $request->config_value,
                'user_create' => Auth::user()->name
            ]
        );
        return redirect()->route('setting.index')->with(
            'status',
            'Bạn đã thêm bản ghi thành công !'
        );
    }
}
