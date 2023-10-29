<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    function order_detai()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id', 'wards_id');
    }
    function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'district_id');
    }
    function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
    use HasFactory;
}
