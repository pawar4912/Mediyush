<?php

namespace App\Http\Controllers\portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Product;
use App\Models\GallaryPhoto;
use App\Models\Course;
use App\Models\cart;
use Auth;
use DB;

class ServiceController extends Controller
{
	public function getEvent()
	{
		$events = Event::orderBy('id', 'DESC')->get();
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

	// public function getNews()
	// {
	// 	$course = Course::orderBy('id', 'DESC')->get();
	// 	return view('portal.services.course', compact('course'));
	// }

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
            ->select('carts.id', 'courses.start_date', 'courses.end_date', 'courses.auther', 'courses.name', 'courses.banner')
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
}