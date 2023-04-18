<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class PortalController extends Controller
{
    public function register(Request $req) {
        $req->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'cpassword' => 'required'
        ]);

        if ($req->password !== $req->cpassword) {
            return redirect()->back()->withErrors('Password and confirm password should be same');
        }

        Users::create([
            'first_name' => $req->firstName,
            'last_name' => $req->lastName,
            'email' => $req->email,
            'password' => Hash::make($req->password)
        ]);

        return back()->with('success','You have successfully registered & Please login!');
    }

    public function userLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (\Auth::guard('user')->attempt($request->only(['email','password']))){
            setcookie('login_email',$request->email,time()+60*60*24*100);
            setcookie('login_pass',$request->password,time()+60*60*24*100);
            return redirect()->intended('/job');
        }

        return back()->withInput($request->only('email', 'remember'))->with('error','Invalid Login Details');
    }
}
