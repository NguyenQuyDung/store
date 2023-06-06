<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use PHPUnit\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
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
            $list_users = User::orderBy('id','ASC')->paginate(5);
        } elseif ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_users = User::onlyTrashed()->orderBy('id', 'ASC')->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_users = User::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'ASC')->paginate(4);
        }
        $count_trash = User::onlyTrashed()->count();
        $public = User::count();
       // $list_users = $this->user::paginate(5);
        return view('admin.users.index', compact('list_users','count_trash','public', 'list_act'));
    }
    public function add()
    {
        $list_roles = $this->role->all();
        return view('admin.users.add', compact('list_roles'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('users.index')->with(
                'status',
                'Thêm thành viên thành công !'
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '---Line' . $exception->getLine());
        }
    }
    public function edit($id)
    {
        $roles = $this->role->all();
        $find_id = $this->user->find($id);
        $roleOfUser = $find_id->roles;
        return view('admin.users.edit', compact('roleOfUser', 'find_id', 'roles'));
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user = $this->user->find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('users.index')->with(
                'status',
                'Cập nhật thành viên thành công !'
            );
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '---Line' . $exception->getLine());
        }
    }
    public function delete($id)
    {
        $user_id = $this->user->find($id);
        $user_id->delete();
        return redirect()->route('users.index')->with(
            'status',
            'Xóa thành viên thành công !'
        );
    }
    public function action(Request $request){
        $list_check = $request->input('list_check');
        if (!empty($list_check)) {
            $act = $request->input('act');
            if ($act == 'delete') {
                User::destroy($list_check);
                return redirect()->route('users.index')->with('status', 'Bạn đã xóa bản ghi thành công !');
            }
            if ($act == 'restore') {
                User::withTrashed()->whereIn('id', $list_check)->restore();
                return redirect()->route('users.index')->with('status', 'Bạn đã khôi phục bản ghi thành công !');
            }
            if ($act == 'forceDelete') {
                User::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('users.index')->with('status', 'Bản ghi đã được xóa vĩnh viễn !');
            }
        }
    }
}
