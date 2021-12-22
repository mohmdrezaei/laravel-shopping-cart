<?php


namespace App\Models\Realations;


use App\Models\Order;

trait UserRealations
{
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
