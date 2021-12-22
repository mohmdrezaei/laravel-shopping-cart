<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends DashboardController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $products=Product::latest()->paginate(2);
        return view('Dashboard.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'price' => 'required',
            'image'=>'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $imageName= time() . "_". rand(1000,9999).".".$request->image->extension();
        $image=$request->image->storeAs('images',$imageName,'public');

        Product::create([
            'title'=>$request->title,
            'price'=>$request->price,
            'body'=>$request->body,
            'image'=>$image
        ]);
        return redirect(route('dashboard.product.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('dashboard.product.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, product $product)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:2|max:255',
            'body'=>'nullable',
            'price'=>'required|numeric',
            'image'=>'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->image)
        {
            $imageName= time() . "_". rand(1000,9999).".".$request->image->extension();
            $image=$request->image->storeAs('images',$imageName,'public');
        }
        else
        {
            $image=$product->image;
        }


        $product->update([
            'title'=>$request->title,
            'price'=>$request->price,
            'body'=>$request->body,
            'image'=>$image
        ]);
        return redirect(route('dashboard.product.edit',['product'=>$product->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        unlink('storage/'.$product->image);
        return redirect(route('dashboard.product.index'));
    }
}
