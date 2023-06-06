<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestResetPassword;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Menu;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.log.index', compact('menus'));
    }
    public function register(Request $request)
    {
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.log.register', compact('menus'));
    }
    public function postLogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //$credentials = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            // Authentication passed...
            return redirect()->route('index');
        }
        return redirect()->route('login');
    }

    public function postRegister(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        $check = $this->create($data);

        return redirect()->route('login');
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function logoutt()
    {
        Auth::logout();
        return redirect()->route('login.login');
    }
    public function forgetPass()
    {
        $menus = Menu::where('parent_id', 0)->get();
        return view('clients.log.forgetPassword', compact('menus'));
    }
    public function postForgetPass(Request $request)
    {
        $email = $request->email;
        $checkUser = User::where('email', $email)->first();
        if (!$checkUser) {
            return redirect()->back()->with('danger', 'Email bạn vừa nhập không tồn tại trên hệ thống !');
        }
        $code = bcrypt(md5(time() . $email));
        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();
        //dd($checkUser->email)
        $url = route('get.link.reset.password', ['code' => $checkUser->code, 'email' => $email]);
        $data = [
            'route' => $url
        ];
        Mail::send('clients.email.reset_password', $data, function ($message) use ($email) {
            $message->to($email, 'Reset Password')->subject('Khôi Phục Mật Khẩu Của Bạn !');
        });
        return redirect()->back()->with('success', 'Link lấy lại mật khẩu đã được gửi vào email của bạn !');
    }
    public function getPass(Request $request)
    {
        $menus = Menu::where('parent_id', 0)->get();
        $code = $request->code;
        $email = $request->email;
        $checkUser = User::where([
            'code' => $code,
            'email' => $email
        ])->first();
        if (!$checkUser) {
            return redirect('/')->with('danger', 'Xin Lỗi ! Đường dẫn lấy lại mật khẩu của bạn không đúng, bạn vui lòng thử lại !.');
        }
        return view('clients.log.resetPassword', compact('menus'));
    }
    public function postGetPass(RequestResetPassword $requestResetPassword)
    {
        if ($requestResetPassword->password) {
            $code = $requestResetPassword->code;
            $email = $requestResetPassword->email;
            $checkUser = User::where([
                'code' => $code,
                'email' => $email
            ])->first();
            if (!$checkUser) {
                return abort(403);
            }
            $checkUser->password = bcrypt($requestResetPassword->password);
            $checkUser->save();

            return redirect()->route('login')->with('success','Bạn đã thay đổi mật khẩu thành công, vui lòng điền thông tin để đăng nhập !');
        }
    }
}
