<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;
use App\Models\GallaryPhoto;
use App\Models\Course;
use App\Models\cart;
use App\Models\News;
use App\Models\Feedback;
use Auth;
use DB;
use Session;
use Razorpay\Api\Api;
use App\Models\Payment;

class ServiceController extends Controller
{
	public function getEvent()
	{
		$events = Event::orderBy('id', 'DESC')->where('status', '1')->get();
		return view('portal.services.event', compact('events'));
	}

	public function getCourse()
	{
		$course = Course::orderBy('id', 'DESC')->get();
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
			return view('portal.services.course',compact('user', 'course'));
		} else {
			return view('portal.services.course', compact('course'));
		}
	}

	public function getNews()
	{
		$news = News::orderBy('id', 'DESC')->get();
		return view('portal.services.news', compact('news'));
	}

	public function addToCart($id, Request $req)
	{
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();

			$logginUser = $user->id;
			$courseId = $id;
			$isAddedToCart = cart::where('userid', $logginUser)->where('courseid', $courseId)->get();

			if ($isAddedToCart && count($isAddedToCart) !== 0) {
				return back()->with('error','Course already in cart');
			}

			$cart = new cart();
      $cart->userid = $logginUser;
      $cart->courseid = $courseId;
      $cart->save();
			return redirect('cart');
		} else {
			return back()->with('error','Please login first');
		}
	}

	public function getCart()
	{
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
			$logginUser = $user->id;
			
			$carts = DB::table('carts')
            ->select('carts.id', 'courses.start_date', 'courses.end_date', 'courses.auther', 'courses.name', 'courses.banner', 'courses.price')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->join('courses', 'carts.courseid', '=', 'courses.id')
						->where('carts.userid', $logginUser)
						->get();
			return view('portal.cart',compact('carts', 'user'));
		}
	}

	public function deleteCart($id) {
		$deleteCart = cart::find($id);
		$deleteCart->delete();
		return redirect('cart')->with('success','Course remove successfully!!');
	}

	public function store(Request $request) {
		$user=Auth::guard('user')->user();
		$logginUser = $user->id;
    $input = $request->all();
    $api = new Api (env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    $payment = $api->payment->fetch($input['razorpay_payment_id']);
    if(count($input) && !empty($input['razorpay_payment_id'])) {
        try {
            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));

						$cartdetails =  DB::table('carts')
														->select('*')
														->where('carts.userid', $logginUser)
														->get();
						
						foreach ($cartdetails as $key=>$value){
							$payment = Payment::create([
                'userid' => $value->userid,
                'courseid' => $value->courseid,
                'total_price' => $response['amount']
            ]);
						}
        } catch(Exceptio $e) {
            return $e->getMessage();
            Session::put('error',$e->getMessage());
            return redirect()->back();
        }
    }
    Session::put('success',('Payment Successful'));
    return redirect()->back();
	}

	public function contact(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.contact',compact('user'));
    }

    return view('portal.contact');
  }

	public function webinar(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.services.webinar',compact('user'));
    }

    return view('portal.services.webinar');
  }

	public function blog(){
    if(Auth::guard('user')->user()){
      $user=Auth::guard('user')->user();
      return view('portal.services.blog',compact('user'));
    }

    return view('portal.services.blog');
  }

	public function getSingleCourse($id) {
		$details = Course::find($id);
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
      return view('portal.services.coursedesc',compact('user', 'details'));
		}

		return view('portal.services.coursedesc',compact('details'));
	}

	public function getSingleEvent($id) {
		$details = Event::find($id);
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
      return view('portal.services.eventdesc',compact('user', 'details'));
		}

		return view('portal.services.eventdesc',compact('details'));
	}

	public function feedback() {
		if(Auth::guard('user')->user()){
			return view('portal.feedback');
		}
		return redirect('login?redirect=feedback')->with('error','For feedback please login first');
	}

	public function submitFeedback(Request $req) {
		if(Auth::guard('user')->user()){
			$feedback = new Feedback;
			$feedback->message = $req->message;
			$feedback->userid = Auth::guard('user')->user()->id;
			$feedback->save();
			return redirect()->back()->with('success','Course remove successfully!!');
		}
		return redirect('login?redirect=feedback')->with('error','For feedback please login first');
	}
}