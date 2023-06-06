<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function loginAdmin()
    {
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('admin.login.index');
    }
    public function checklogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'required' => 'Bạn cần nhập :attribute trước khi đăng nhập !'
            ],
            [
                'email' => 'email',
                'password' => 'password'
            ]
        );
        // dd(bcrypt($request->password));
        $remember = $request->has('remember_me') ? true : false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $remember)) {
            return redirect()->to('home')->with(
                'status',
                'Chào Mừng Bạn Đến Với Trang Quản Trị Admin !'
            );
        }else{
            return response(redirect(url('/')), 404);
        }
    }
    public function error(){
        return view('errors.403');
    }
}
