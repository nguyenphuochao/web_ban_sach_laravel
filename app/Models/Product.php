<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Product extends Model
{
    protected $table = 'products';
    function category()
    {
        return $this->belongsTo(category::class, 'category_id', 'id');
    }
    function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
    function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
    use HasFactory;
}
