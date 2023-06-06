<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;

class AdminPermissionController extends Controller
{
    public function createPermission()
    {
        return view('admin.permission.add');
    }
    public function storePermission(Request $request)
    {
        $pemission = Permission::create([
            'name' => $request->module_parent,
            'display_name' => $request->module_parent,
            'parent_id' => 0
        ]);
        foreach ($request->module_children as $value) {
            Permission::create(
                [
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $pemission->id,
                    'key_code' => $request->module_parent . '_' . $value
                ]
            );
        }
    }
}
