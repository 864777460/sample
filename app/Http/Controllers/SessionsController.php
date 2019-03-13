<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class SessionsController extends Controller
{
    public function __construct(){
      $this->middleware('guest',[
     'only' => ['create']
      ]);
    }
    //
    public function create(){
      if (!empty(Auth::user())) {
        return redirect()->route('users.show',Auth::user());
      }
      else
      {
    	return view('sessions.create');
    }
    }

    public function store(Request $request){
       $info = $this->validate($request,[
       'email' => 'required|email',
       'password' => 'required'
       ]);
       if (Auth::attempt($info,$request->has('remember'))) {
        if (Auth::user()->activated == 0) {
            Auth::logout();
               session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
               return redirect('/');
        }
        else
        {
          session()->flash('success', '欢迎回来！');
       	return redirect()->intended(route('users.show',[Auth::user()]));
       }
       }
       else{
       	session()->flash('danger','抱歉，邮箱或密码不正确');
       	return redirect()->back()->withInput();
       }
    }

    public function destroy(){
      Auth::logout();
      session()->flash('success','成功退出');
      return redirect('login');
    }
}
