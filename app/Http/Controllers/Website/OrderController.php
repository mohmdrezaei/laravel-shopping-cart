<?php

namespace App\Http\Controllers\Website;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;

class OrderController extends WebsiteController
{
    public function addToCart(Product $product, Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addToCart($product);

        $request->session()->put('cart', $cart);
        if (!is_null($request->ajax))
            return response()->json([
              "count"=> $cart->count
            ]);
            else
        return back();
    }

    public function removeFromCart(Product $product, Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeFromCart($product);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function updateCart(Product $product, Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->updateCart($product, $request->count);

        $request->session()->put('cart', $cart);
        return back();
    }

    public function cartShow(Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        return view('website.order.cart', compact('cart'));
    }

    public function addAddress(Request $request)
    {

        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addAddress($request->address);
        $request->session()->put('cart', $cart);
        return redirect(route('invoice'));

    }

    public function invoice(Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        return view('website.order.invoice', compact('cart'));

    }

    public function store(Request $request)
    {
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $order = auth()->user()->orders()->create([
            'price' => $cart->price,
            'address' => $cart->address
        ]);

        foreach ($cart->products as $item) {
            $product = $item['product'];
            $order->products()->attach([
                $product->id => [
                    'count' => $item['count'],
                    'price' => $product->price
                ]
            ]);
        }
        $invoice = new Invoice;
        $invoice->amount($order->price);
        return Payment::callbackUrl(route('payResult'))->purchase(
            $invoice,
            function ($driver, $transactionId) use ($order) {
                // We can store $transactionId in database.
                $order->update([
                    't_id' => $transactionId
                ]);
            }
        )->pay()->render();
    }

    public function payResult(Request $request)
    {
        $transaction_id = $request->Authority;
        $order = Order::where('t_id', $transaction_id)->first();
        if (is_null($order))
            abort(404);
        try {
            $receipt = Payment::amount($order->price)->transactionId($transaction_id)->verify();
            $order->update([
                'ref_id' => $receipt->getReferenceId(),
                'status'=>'payed'
            ]);

                $request->session()->remove('cart');
            dd('merc k kharid kardi');

        } catch (InvalidPaymentException $exception) {
            dd($exception->getMessage());
        }
    }
}
