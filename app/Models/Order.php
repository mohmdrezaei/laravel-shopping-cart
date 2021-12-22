<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Realations\OrderRelations;

class Order extends Model
{
    use HasFactory,OrderRelations;

    protected $fillable=[
        'price',
        'address',
        'status',
        't_id',
        'ref_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
