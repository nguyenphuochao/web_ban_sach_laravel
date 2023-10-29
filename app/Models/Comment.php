<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['product_id', 'customer_id', 'desc', 'status'];
    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    use HasFactory;
}
