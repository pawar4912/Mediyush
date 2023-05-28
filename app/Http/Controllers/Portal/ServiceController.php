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
use App\Models\PurchasedCourse;
use App\Models\ProductOrders;

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
			$isAddedToCart = cart::where('userid', $logginUser)->where('entity_id', $id)->where('entity_type', 'course')->first();

			if ($isAddedToCart) {
				return back()->with('error','Course already in cart');
			}

			$cart = new cart();
			$cart->userid = $logginUser;
			$cart->entity_id = $id;
			$cart->entity_type = 'course';
			$cart->save();
			return redirect('cart');
		} else {
			return redirect('login?redirect=/service/course')->with('error','Please login first');
		}
	}

	public function addToCartProduct($id, Request $req) {
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
			$logginUser = $user->id;
			$isAddedToCart = cart::where('userid', $logginUser)->where('entity_id', $id)->where('entity_type', 'product')->first();
			if ($isAddedToCart) {
				return back()->with('error','Product already in cart');
			}

			$cart = new cart();
			$cart->userid = $logginUser;
			$cart->entity_type = 'product';
			$cart->entity_id = $id;
			$cart->save();
			return redirect('cart');
		} else {
			return  redirect('login?redirect=/all-products')->with('error','Please login first');
		}
	}

	public function getCart()
	{
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
			$logginUser = $user->id;
			
			$cartCources = DB::table('carts')
            ->select('courses.*', 'carts.id as cart_id')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->join('courses', 'carts.entity_id', '=', 'courses.id')
			->where('carts.userid', $logginUser)
			->where('carts.entity_type', 'course')
			->get();
			$cartProducts = DB::table('carts')
            ->select('products.*', 'carts.id as cart_id')
            ->join('users', 'carts.userid', '=', 'users.id')
            ->join('products', 'carts.entity_id', '=', 'products.id')
			->where('carts.userid', $logginUser)
			->where('carts.entity_type', 'product')
			->get();
			return view('portal.cart',compact('cartCources', 'cartProducts', 'user'));
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
	$amount = $payment['amount'];
    if(count($input) && !empty($input['razorpay_payment_id'])) {
        try {
            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
			$payment = new Payment();
			$payment->transaction_id = $input['razorpay_payment_id'];
			$payment->total_price = $amount;
			$payment->userid = $logginUser;
			$payment->save();
			$cartdetails =  DB::table('carts')->select('*')->where('carts.userid', $logginUser)->get();
						
			foreach ($cartdetails as $key=>$value){
				if ($value->entity_type == 'product') {
					$prod = Product::find($value->entity_id);
					$product_order = new ProductOrders;
					$product_order->payment_id = $payment->id;
					$product_order->userid = $logginUser;
					$product_order->products = json_encode(array('id' => $value->entity_id, 'amount' => $prod->price));
					$product_order->save();
				} else {
					$purchased_course = new PurchasedCourse;
					$purchased_course->payment_id = $payment->id;
					$purchased_course->course_id = $value->entity_id;
					$purchased_course->userid = $logginUser;
					$purchased_course->save();
				}
			}
			DB::table('carts')->select('*')->where('carts.userid', $logginUser)->delete();
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

	public function productsView(Request $req) {
		$products = Product::orderBy('id', 'DESC')->get();
		return view('portal.products', compact('products'));
	}

	public function getSingleProduct($id) {
		$product = Product::find($id);
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
      		return view('portal.services.proddesc',compact('user', 'product'));
		}
		return view('portal.services.proddesc',compact('product'));
	}

	public function getSingleNews($id) {
		$news = News::find($id);
		if(Auth::guard('user')->user()){
			$user=Auth::guard('user')->user();
      		return view('portal.services.newsdesc',compact('user', 'news'));
		}
		return view('portal.services.newsdesc',compact('news'));
	}
}