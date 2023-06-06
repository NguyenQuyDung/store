<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use App\Role;

class AdminRoleController extends Controller
{
    //
    private $role;
    private $permission;
    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    public function index(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa Tạm Thời',
        ];
        if ($status == 'public') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
            ];
            $list_roles = Role::orderBy('id','ASC')->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_roles = Role::onlyTrashed()->orderBy('id', 'ASC')->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_roles = Role::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'ASC')->paginate(4);
        }
        $count_trash = Role::onlyTrashed()->count();
        $public = Role::count();
        return view('admin.roles.index', compact('list_roles','public','count_trash','list_act'));
    }
    public function add()
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        return view('admin.roles.add', compact('permissionsParent'));
    }
    public function store(Request $request)
    {

        $role =  $this->role->create(
            [
                'name' => $request->name_roles,
                'display_name' => $request->descript
            ]
        );
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('roles.index')->with('status', 'Thêm vai trò thành công !');
    }
    public function edit($id)
    {
        $permissionsParent = $this->permission->where('parent_id', 0)->get();
        $role = $this->role->find($id);
        $permissionChecked = $role->permissions;
        return view('admin.roles.edit', compact('permissionsParent', 'role', 'permissionChecked'));
    }
    public function update(Request $request, $id)
    {

        $role =  $this->role->find($id)->update(
            [
                'name' => $request->name_roles,
                'display_name' => $request->descript
            ]
        );
        $role = $this->role->find($id);
        // syns để xem nếu chưa có dữ liệu trùng thì ta sẽ thêm vào
        // còn nếu có rồi thì dữ liệu sẽ không được thêm vào nữa
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('roles.index')->with('status', 'Cập nhật vai trò thành công !');
    }
    public function delete($id)
    {
        $id = $this->role->find($id);
        $id->delete();
        return redirect()->route('roles.index')->with('status', 'Xóa vai trò thành công !');
    }
}
