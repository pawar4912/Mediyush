<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function getCoupons(Request $request) {
        if ($request->ajax()) {
            $data = Coupon::select('*');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn ='<a href="/admin/coupons/edit/'.$row->id.'"
                        class="btn btn-secondary"><i class="ri-edit-2-line"></i></a>
                        <a href="/admin/coupons/delete/'.$row->id.'" class="btn btn-danger">
                        <i class="ri-delete-bin-5-line"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.coupons.list');
    }

    public function couponAdd(Request $request) {
        $request->validate([
            'code' => 'required|unique:coupons',
            'type' => 'required',
            'minimum_amount_required' => 'required',
            'description' => 'required',
        ]);
        $coupon = new Coupon();
        if ($request->type == 'fix_price') {
            if (!isset($request->amount)) {
                return back()->with('error','amount is required');
            } else {
                $coupon->amount = $request->amount;
            }
        } else if ($request->type == 'percentage') {
            if (!isset($request->percentage)) {
                return back()->with('error','percentage is required');
            } else {
                $coupon->percentage = $request->percentage;
            }
        }
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->minimum_amount_required = $request->minimum_amount_required;
        $coupon->description = $request->description;
        $coupon->save();
        return redirect('admin/coupons/list')->with('success','Coupon added successfully !!!');
    }

    public function getEditCoupon($id) {
        $coupon = Coupon::find($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function editCoupon($id, Request $request) {
        $request->validate([
            'code' => 'required|unique:coupons,code,' . $id,
            'type' => 'required',
            'minimum_amount_required' => 'required',
            'description' => 'required',
        ]);
        $coupon = Coupon::find($id);
        if ($request->type == 'fix_price') {
            if (!isset($request->amount)) {
                return back()->with('error','amount is required');
            } else {
                $coupon->amount = $request->amount;
            }
        } else if ($request->type == 'percentage') {
            if (!isset($request->percentage)) {
                return back()->with('error','percentage is required');
            } else {
                if ($request->percentage > 99) {
                    return back()->with('error','percentage always less than 99');
                }
                $coupon->percentage = $request->percentage;
            }
        }
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->minimum_amount_required = $request->minimum_amount_required;
        $coupon->description = $request->description;
        $coupon->update();
        return redirect('admin/coupons/list')->with('success','Coupon updated successfully !!!');
    }

    public function deleteCoupon($id) {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect('admin/coupons/list')->with('success','Coupon deleted successfully !!!');
    }
}
