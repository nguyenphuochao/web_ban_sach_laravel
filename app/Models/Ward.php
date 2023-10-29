<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ward extends Model
{
    protected $table = 'wards';
    function order()
    {
        return $this->hasMany(Order::class, 'ward_id', 'id');
    }
    use HasFactory;
}
