<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    protected $table = 'customers';
    protected $fillable = ['name', 'email', 'address', 'password', 'phone', 'gender', 'status'];
    function order()
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }
    function comment()
    {
        return $this->hasMany(Comment::class, 'customer_id', 'id');
    }
    use HasFactory;
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
