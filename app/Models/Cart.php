<?php


namespace App\Models;


class Cart
{
    public $products = [];
    public $count = 0;
    public $price = 0;
    public $address = null;

    public function __construct($cart = null)
    {
        if (!is_null($cart)) {
            $this->products = $cart->products;
            $this->price = $cart->price;
            $this->count = $cart->count;
            $this->address = $cart->address;
        }

    }

    public function addToCart($product)
    {
        if (array_key_exists($product->id,$this->products)) {
            $this->products[$product->id]=[
                'product'=>$product,
                'count'=> $this->products[$product->id]['count'] +1,

            ];
        }
        else {
            $this->products[$product->id]=[
                'product'=> $product ,
                'count'=> 1 ,

            ];
        }

        $this->price += $product->price;
        $this->count += 1;
    }

    public function removeFromCart($product)
    {
        if (!array_key_exists($product->id , $this->products))
            return false;
        $count = $this->products[$product->id]['count'];
        $this->price -= $product->price *$count;
        $this->count -= $count;
        unset($this->products[$product->id]);

    }

    public function updateCart($product,$count)
    {
        if (!array_key_exists($product->id , $this->products))
            return false;

        $oldCount = $this->products[$product->id]['count'];
        $this->products[$product->id]=[
            'product'=> $product ,
            'count'=> $count ,

        ];

        $this->price -= $product->price *$oldCount;
        $this->count -= $oldCount;

        $this->price += $product->price *$count;
        $this->count += $count;


    }

    public function addAddress($address)
    {
        $this->address= $address;
    }

}
