<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
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

        if (Auth::attempt($data)) {
            session()->flash('success', '登录成功！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', '登录失败！');
            return redirect()->back();
        }
    }
}
