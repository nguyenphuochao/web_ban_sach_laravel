<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    function order()
    {
        return $this->hasMany(Order::class, 'district_id', 'id ');
    }
    use HasFactory;
}
