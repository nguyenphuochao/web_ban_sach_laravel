<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    use HasFactory;
}
