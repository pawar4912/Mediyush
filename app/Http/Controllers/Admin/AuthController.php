<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (\Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            if($request->remember===null){
                setcookie('login_email',$request->email,100);
                setcookie('login_pass',$request->password,100);
             }
             else{
                setcookie('login_email',$request->email,time()+60*60*24*100);
                setcookie('login_pass',$request->password,time()+60*60*24*100);
 
             }
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'))->with('error','Invalid Login Details');
    }

    public function logout() {
        \Auth::guard('admin')->logout();
        return redirect('admin/login')->with('success','Admin logout successfully !!!');
    }
}
