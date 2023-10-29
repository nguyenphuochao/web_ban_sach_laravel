<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    function order()
    {
        return $this->hasMany(Order::class, 'province_id', 'id ');
    }
    use HasFactory;
}
