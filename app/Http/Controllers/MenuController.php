<?php

namespace App\Http\Controllers;

use App\Components\MenuRecusive;
use App\Menu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    //
    private $menuRecusive;
    public function __construct(MenuRecusive $menuRecusive)
    {
        $this->menuRecusive = $menuRecusive;
    }
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
          $list_menus = Menu::where(['status' => 'Công Khai'])->paginate(5);
        } elseif ($status == 'trash') {
          $list_act = [
            'restore' => 'Khôi Phục',
            'forceDelete' => 'Xóa Vĩnh Viễn',
          ];
          $list_menus = Menu::onlyTrashed()->paginate(5);
        } elseif ($status == 'pending') {
          $list_act = [
            'public' => 'Công Khai',
            'delete' => 'Xóa Tạm Thời',
            'forceDelete' => 'Xóa Vĩnh Viễn',
          ];
          $list_menus = Menu::where(['status' => 'Chờ Duyệt'])->paginate(5);
        } elseif ($status == 'public') {
          $list_act = [
            'delete' => 'Xóa Tạm Thời',
            'pending' => 'Chờ Duyệt'
          ];
          $list_menus = Menu::where(['status' => 'Công Khai'])->paginate(5);
        } else {
          $list_menus = Menu::paginate(5);
        }
        $count_public = Menu::where(['status' => 'Công Khai'])->count();
        $count_Pending = Menu::where(['status' => 'Chờ Duyệt'])->count();
        $count_trash = Menu::onlyTrashed()->count();
        $count = Menu::count();
        return view('admin.menus.index', compact('list_menus',   'count',
        'list_act',
        'count_public',
        'count_Pending',
        'count_trash'))->with('i',(request()->input('page',1) -1)*5);
    }
    public function create()
    {
        $optionSelect = $this->menuRecusive->menurecusiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
    }
    public function add(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
            ],
            [
                'required' => ':attribute không đưọc để trống !'
            ],
            [
                'name' => 'Tên menu'
            ]
        );
        Menu::create(
            [
                'name' => $request->input('name'),
                'slug' => Str::slug($request->input('name')),
                'parent_id' => $request->input('parent_id'),
                'user_create' => Auth::user()->name
            ]
        );
        return redirect()->route('menu.index')->with('status', 'Bạn đã thêm menu thành công !');
    }
    public  function delete(Request $request, $id)
    {
        $find_id = Menu::find($id);
        $find_id->delete();
        return redirect()->route('menu.index')->with('status', 'Bạn đã xóa menu thành công !');
    }
    public function edit($id)
    {
        $find_id = Menu::find($id);
        $optionSelect = $this->menuRecusive->menurecusiveEdit($find_id->parent_id);
        return view('admin.menus.edit', compact('find_id', 'optionSelect'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required'
            ],
            [
                'required' => ':attribute không được để trống !'
            ],
            [
                'name' => 'Tên menu'
            ]
        );
        Menu::where('id',$id)->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'parent_id' => $request->input('parent_id')
        ]);
        return redirect()->route('menu.index')->with('status', 'Bạn đã cập nhật menu thành công !');
    }
    public function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
          $act = $request->input('act');
          if ($act == 'delete') {
            Menu::destroy($list_check);
            return redirect()->route('menu.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
          }
          if ($act == 'restore') {
            Menu::withTrashed()->whereIn('id', $list_check)->restore();
            return redirect()->route('menu.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
          }
          if ($act == 'forceDelete') {
            Menu::withTrashed()
              ->whereIn('id', $list_check)
              ->forceDelete();
            return redirect()->route('menu.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
          }
          if ($act == 'pending') {
            Menu::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
            return redirect()->route('menu.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
          }
          if ($act == 'public') {
            Menu::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
            return redirect()->route('menu.index')->with('status', 'Bạn đã chuyển trạng thái thành công !');
          }
        }
    }
}
