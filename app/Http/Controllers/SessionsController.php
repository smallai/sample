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

        //使用输入的邮箱和密码进行登录
        if (Auth::attempt($data, $request->has('remember'))) {
            $user = Auth::user();

            //邮箱是否已经验证通过
            if ($user->activated) {
                session()->flash('success', '登录成功！');
                return redirect()->intended(route('users.show', [Auth::user()]));
            } else {
                session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
                return redirect('/');
            }
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
