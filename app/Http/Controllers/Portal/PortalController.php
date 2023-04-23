<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;

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

    $user_data = array(
      'email' => $request->get('email'),
      'password' => $request->get('password')
    );
    
    if(Auth::guard('user')->attempt($user_data)) {
      return redirect('job');
    } else{
      return redirect()->back()->with('flash_message_error', 'Wrong Login Details');
    }
  }

  public function myAcnt(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.profile',compact('user'));
    }
  }

  public function courses(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.course',compact('user'));
    } else {
      return view('portal.course');
    }
  }

  public function logout(Request $request){
    Auth::logout();
    Session::flush();
    return redirect('/');
  }
}
