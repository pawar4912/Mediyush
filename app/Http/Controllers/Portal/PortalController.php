<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use DB;
use Session;
use App\Models\Event;
use App\Models\News;
use App\Models\Product;
use App\Models\GallaryPhoto;
use App\Models\Payment;
use App\Models\Video;
use App\Models\Feedback;
use App\Models\Course;

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
      return redirect(isset($request->redirect) ? $request->redirect : '/');
    } else{
      return redirect()->back()->with('error', 'Wrong Login Details');
    }
  }

  public function myAcnt(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      $logginUser = $user->id;
			
			$details = DB::table('purchased_courses')
            ->select('courses.*')
            ->join('courses', 'purchased_courses.course_id', '=', 'courses.id')
						->where('purchased_courses.userid', $logginUser)
						->get();
      return view('portal.profile',compact('user', 'details'));
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

  public function home(){
    $events = Event::orderBy('id', 'DESC')->get();

    $products = Product::orderBy('id', 'DESC')->get();

    $news = News::orderBy('id', 'DESC')->get();

    $videos = Video::orderBy('id', 'DESC')->get();

    $courses = Course::orderBy('id', 'DESC')->get();
  
    $feedbacks = User::select('feedback.*', 'users.first_name', 'users.last_name')->join('feedback', 'feedback.userid', '=', 'users.id')->orderBy('created_at', 'DESC')->get();

    $gallaryPhotos = GallaryPhoto::orderBy('position', 'ASC')->get();

    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.home', compact('events', 'products', 'gallaryPhotos', 'user', 'news', 'videos', 'feedbacks', 'courses'));
    }
    return view('portal.home', compact('events', 'products', 'gallaryPhotos', 'news',  'videos', 'feedbacks', 'courses'));
  }

  public function updateProfile(Request $req) {
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      $req->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'experience' => 'required',
        'skills' => 'required',
        'qualification' => 'required'
    ]);
  
      $users = User::find($user->id);

      if($req->cv != ''){  
        if($users->cv != ''  && $users->cv != null){
          $file_old = public_path('cv').'/'.$users->photos;
          unlink($file_old);
        }
        $imageName = time().'.'.$req->cv->extension();  
        $req->cv->move(public_path('cv'), $imageName);
        $users->cv = $imageName;
      }

      $users->first_name = $req->firstName;
      $users->last_name = $req->lastName;
      $users->experience = $req->experience;
      $users->skills = $req->skills;
      $users->qualification = $req->qualification;

      $users->update();
      return back()->with('success','Profile Updated Successfully!!');
    }
    
  }

  public function contact(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.contact',compact('user'));
    }

    return view('portal.contact');
  }

  public function sendMail(Request $req) {
    $details = [
      'title' => $req->subject,
      'firstName' => $req->firstName,
      'message' => $req->message
    ];

    \Mail::to('tejaswinimore47@gmail.com')->send(new \App\Mail\MyMail($details));
   
    return redirect()->back()->with('success', 'Message send successfully!');
  }

  public function about(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.about',compact('user'));
    }

    return view('portal.about');
  }
}
