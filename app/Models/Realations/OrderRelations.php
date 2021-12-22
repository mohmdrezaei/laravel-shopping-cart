<?php


namespace App\Models\Realations;


use App\Models\Product;

trait OrderRelations
{
    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot('price', 'count');
    }
}
