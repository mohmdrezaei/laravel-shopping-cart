<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends WebsiteController
{
    public function index(Request $request)
    {
        $oldCart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart=new Cart($oldCart);
        $products=Product::latest()->paginate(9);
      return view('Website.Product.index',compact('products','cart'));
   }

    public function show(Product $product,Request $request)
    {
        $oldCart=$request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart=new Cart($oldCart);
        return view('Website.Product.show',compact('product','cart'));
    }
}
