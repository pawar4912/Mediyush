<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductOrders;
use DB;
use DataTables;

class ProductController extends Controller
{
    public function getProductPhotos() {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        $products->withPath('/admin/products/list');
        return view('admin.products.list', compact('products'));
    }

    public function productAdd(Request $req) {
        $req->validate([
            'name' => 'required',
            'price' => 'required',
            'original_price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = new Product();
        $product->name = $req->name;
        $product->price = $req->price;
        $product->original_price = $req->original_price;
        $product->description = $req->description;
        $imageName = time().'.'.$req->image->extension();  
        $req->image->move(public_path('products'), $imageName);
        $product->image = $imageName;
        $product->save();
        return redirect('admin/products/list')->with('success','Shop product added successfully !!!');
    }

    public function getEditProducts($id) {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function editProduct($id, Request $req) {
        $req->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        $product = Product::find($id);
        $product->name = $req->name;
        $product->price = $req->price;
        $product->original_price = $req->original_price;
        $product->description = $req->description;
        if($req->image != ''){
            if($product->image != ''  && $product->image != null){
                 $file_old = public_path('products').'/'.$product->image;
                 unlink($file_old);
            }
            $imageName = time().'.'.$req->image->extension();  
            $req->image->move(public_path('products'), $imageName);
            $product->image = $imageName;
        }
        $product->update();
        return redirect('admin/products/list')->with('success','Shop Product updated successfully !!!');
    }

    public function deleteProducts($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect('admin/products/list')->with('success','Shop Product delete successfully !!!');
    }

    public function getProductOrders(Request $request) {
        if ($request->ajax()) {
            $data = DB::select('select users.*, product_orders.payment_id as payment_id from product_orders inner join users on product_orders.userid = users.id where status = 0 group by payment_id');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn ='<a href="/admin/products/orders/'.$row->payment_id.'"
                    class="btn btn-primary"><i class="ri-eye-fill"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.products.orders');
    }

    public function viewProductOrders($id, Request $request) {
        if ($request->ajax()) {
            $data = DB::table('product_orders')
                ->select('products.*', 'product_orders.product_price as product_price')
                ->join('products', 'product_orders.product_id', '=', 'products.id')
                ->where('product_orders.payment_id',$id)
                ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function($row){       
                    $image ='<img src="/products/'. $row->image .'" heigth="150" width="150" alt="tag">';
                    return $image;
                })
                ->rawColumns(['image'])
                ->make(true);
        }
        return view('admin.products.view-order', compact('id'));
    }

    public function completeProductOrders($id) {
        ProductOrders::where('payment_id', $id)->update(['status' => 1]);
        return redirect('admin/products/orders')->with('success','Order completed successfully !!!');
    }
}
