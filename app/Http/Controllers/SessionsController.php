<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        //只有未登录用户才可以访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($data, $request->has('remember'))) {
            session()->flash('success', '登录成功！');
            return redirect()->intended(route('users.show', [Auth::user()]));
        } else {
            session()->flash('danger', '登录失败！');
            return redirect()->back();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flush('success', '您已成功退出！');
        return redirect()->route('login');
    }
}
