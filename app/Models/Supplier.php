<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    function product()
    {
        return $this->hasMany(Product::class, 'supplier_id', 'id');
    }
    use HasFactory;
}
