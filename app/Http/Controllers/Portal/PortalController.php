<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
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
        $user = new User;
        $user->first_name = $req->firstName;
        $user->last_name = $req->lastName;
        $user->email = $req->email;
        $user->password = bcrypt($req->password);
        $user->save();

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
