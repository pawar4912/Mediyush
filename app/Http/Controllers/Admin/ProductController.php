<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

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
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $product = new Product();
        $product->name = $req->name;
        $product->price = $req->price;
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
}
